<?php

namespace App\Http\Controllers;

use App\Mail\SendChangeDateExpirationContent;
use App\Models\AffiliatedAccountService;
use App\Models\AfiliadoEmpresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    //

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $request->user('afiliadoempresa')->authorizeRoles(['admin']);

        return view('roles.admin.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_users_contracted_products_view(Request $request)
    {

        return view('roles.admin.listUsersAccountServices');

    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get_users_contracted_products_dt(Request $request)
    {

        $companyAffiliateds = AfiliadoEmpresa::whereHas('affiliated_account_services', function ($query) {
            $query->where([
                ['init_date', '<=', Carbon::now()],
                ['end_date', '>=', Carbon::now()]
            ]);
        })->get();

        return DataTables::of($companyAffiliateds)
            ->addColumn('avatar', function ($companyAffiliated) {
                return '<div class="avatar avatar-m">
                        <img class="rounded-circle" src="' . asset($companyAffiliated->url_image) . '" alt="" />
                       </div>';
            })
            ->addColumn('name', function ($companyAffiliated) {
                return $companyAffiliated->name;
            })
            ->addColumn('last_name', function ($companyAffiliated) {
                return $companyAffiliated->last_name;
            })
            ->addColumn('email', function ($companyAffiliated) {
                return $companyAffiliated->email;
            })
            ->addColumn('phone', function ($companyAffiliated) {
                return $companyAffiliated->phone;
            })
            ->addColumn('content', function ($companyAffiliated) {
                return '<button class="btn btn-primary btn-sm mr-1 mb-1 viewContens" type="button" style="padding: 0.1875rem 1.75rem;font-size: 0.67rem;">Ver</button>';
            })
            ->rawColumns(['content', 'avatar'])
            ->make(true);

    }

    /**
     * @param Request $request
     * @param null $affiliatedId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_user_contracted_products_view(Request $request, $affiliatedId = null)
    {

        if ($affiliatedId !== null) {
            $companyAffiliated = AfiliadoEmpresa::find($affiliatedId);
            return view('roles.admin.listUserAccountServices')->with('companyAffiliated', $companyAffiliated);
        }

    }

    /**
     * @param Request $request
     * @param $affiliatedId
     * @return mixed
     * @throws \Exception
     */
    public function get_user_contracted_products_dt(Request $request, $affiliatedId)
    {
        $affiliatedAccountService = AffiliatedAccountService::with(['rating_plan.type_plan', 'affiliated_content_account_service' => function ($query) {
            $query->with('sequence')->select('id', 'sequence_id', 'affiliated_account_service_id')->groupBy('affiliated_account_service_id', 'sequence_id');
        }])->where([
            ['company_affiliated_id', $affiliatedId],
            ['init_date', '<=', Carbon::now()],
            ['end_date', '>=', Carbon::now()]
        ])->get();
        return DataTables::of($affiliatedAccountService)
            ->addColumn('plan', function ($affiliatedAccountService) {
                return $affiliatedAccountService->rating_plan->name . ' (' . $affiliatedAccountService->rating_plan->type_plan->name . ')';
            })
            ->addColumn('init_date', function ($affiliatedAccountService) {
                return $affiliatedAccountService->init_date;
            })
            ->addColumn('end_date', function ($affiliatedAccountService) {
                return $affiliatedAccountService->end_date;
            })
            ->addColumn('edit_date', function ($affiliatedAccountService) {
                return '<button class="btn btn-warning btn-sm mr-1 mb-1 edit_date" type="button" style="padding: 0.1875rem 1.75rem;font-size: 0.67rem;">Editar</button>';
            })
            ->rawColumns(['view_content', 'edit_date'])
            ->make(true);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_date_expiration_content_user(Request $request)
    {

        $update = AffiliatedAccountService::where([
            ['id', $request->get('accountServiceId')],
        ])->update(array('end_date' => $request->get('end_date')));

        Mail::to($request->get('email'))->send(new SendChangeDateExpirationContent(
            $request->get('originalEndDate'),
            $request->get('end_date'),
            $request->get('plan'),
            $request->get('full_name')
        ));
        if ($update) {
            return response()->json(['validation' => true, 'message' => 'Se ha actualizado la fecha de expiración'], 200);
        } else {
            return response()->json(['validation' => false, 'message' => 'Algo salio mal, intente de nuevo'], 400);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function plans_view()
    {

        return view('roles.admin.plans');

    }

}
