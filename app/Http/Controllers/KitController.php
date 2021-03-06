<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Kit;
use App\Models\KitElement;
use App\Models\MomentKits;
use Illuminate\Http\Request;

/**
 * Class KitController
 * @package App\Http\Controllers
 */
class KitController extends Controller
{

    /**
     * @param Request $request
     * @param $kit_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showKitDetail(Request $request, $kit_id)
    {
        $kit = Kit::find($kit_id);
        if($kit) {
            $homeDirectory = 'images/designerAdmin/';
            $directory = env('ADMIN_DESIGN_PATH') . '/' . str_replace($homeDirectory,'',$kit->url_slider_images);
            if ( file_exists($directory)) {
                $scanned_directory = array_diff(scandir($directory), array('.'));
                $files = [];
                foreach($scanned_directory as $filename) {
                    if(strpos($filename, '.png') || strpos($filename, '.jpg')  ||  strpos($filename, '.jpge')  )    {
                        array_push(  $files , $filename);
                    }  
                }
            }
            return view('elementsKits.getKit', [ 'kit' => $kit ,'directory'=>$kit->url_slider_images,'files'=> $files]);
        }
        else {
            return view('page404',['message'=>'Implemento de laboratorio no encontrado']);
        }
    }

    //
    /**
     * @param Request $request
     * @return Kit[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get_kits(Request $request)
    {

        return Kit::all();

    }

    /**
     * @param Request $request
     */
    public function create_or_update_kit(Request $request,$action)
    {
        if($action == 'Crear'){
            $data = $request->all();
            $kit = new Kit();
            $kit->name = $data['name'];
            $kit->description = $data['description'];
            $kit->url_image = $data['url_image'];
            $kit->price = $data['price'];
            $kit->url_slider_images = $data['url_slider_images'];
            $kit->quantity = $data['quantity'];
            if ( $data['end_date'] == 'null' || $data['end_date'] == null ) {
                $kit->end_date = null;
            }
            else {
                $kit->end_date = $data['end_date'];
            }
            $kit->save();
            
            if(isset($data['elements']) && $data['elements'] != null && $data['elements'] != 'null') {
                $elements = @json_decode($data['elements']);
                foreach ($elements as $element_id){
                    $kit_element_n = new KitElement();
                    $kit_element_n->kit_id = $kit->id;
                    $kit_element_n->element_id = $element_id;
                    $kit_element_n->save();
                }
            }
            if(isset($data['arraySequenceMoment']) && $data['arraySequenceMoment'] != null && $data['arraySequenceMoment'] != 'null') {
                $element_json = @json_decode($data['arraySequenceMoment']);
                foreach ($element_json as $sequenceMoment){
                    foreach ($sequenceMoment->moments as $moment){
                        $momentKits = new MomentKits();
                        $momentKits->kit_id = $kit->id;
                        $momentKits->sequence_moment_id = $moment->id;
                        $momentKits->save();
                    }
                }
            }
            return response()->json([
                'status' => 'successfull',
                'message' => 'El kit ha sido creado'
            ]);
        }else{
            $data = $request->all();
            $kit = Kit::find($data['id']);
            $kit->name = $data['name'];
            $kit->description = $data['description'];
            $kit->url_image = $data['url_image'];
            $kit->price = $data['price'];
            $kit->url_slider_images = $data['url_slider_images'];
            $kit->quantity = $data['quantity'];
            if ( $data['end_date'] == 'null' || $data['end_date'] == null ) {
                $kit->end_date = null;
            }
            else {
                $kit->end_date = $data['end_date'];
            }
            $kit->save();
            KitElement::where('kit_id',$kit->id)->delete();
            if(isset($data['elements']) && $data['elements'] != null && $data['elements'] != 'null') {
                $elements = @json_decode($data['elements']);
                foreach ($elements as $element_id){
                    $kit_element_n = new KitElement();
                    $kit_element_n->kit_id = $kit->id;
                    $kit_element_n->element_id = $element_id;
                    $kit_element_n->save();
                }
            }
            if(isset($data['arraySequenceMoment']) && $data['arraySequenceMoment'] != null && $data['arraySequenceMoment'] != 'null') {
                $element_json = @json_decode($data['arraySequenceMoment']);
                foreach ($element_json as $sequenceMoment){
                    foreach ($sequenceMoment->moments as $moment){
                        $momentKits = new MomentKits();
                        $momentKits->kit_id = $kit->id;
                        $momentKits->sequence_moment_id = $moment->id;
                        $momentKits->save();
                    }
                }
            }
            return response()->json([
                'status' => 'successfull',
                'message' => 'El kit ha sido actualizado'
            ]);
        }


    }

    public function get_kit (Request $request,$id) {

        $element = Kit::with(['moment_kits' => function ($query){
            $query->has('moment')->with(['moment' => function ($query){
                $query->with(['sequence'=>function($query){
                    $query->select('id','name');
                }])->select('id','name','sequence_company_id');
            }]);
        },'kit_elements' => function($query){
            $query->with('element');
        }])->find($id);
        return response()->json([
            'status' => 'successfull',
            'message' => 'El elemento ha sido consultado',
            'data' => $element
        ]);
    }

}
