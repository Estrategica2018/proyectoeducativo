<?php

namespace App\Http\Controllers;

use App\Models\MomentExperience;
use Illuminate\Http\Request;

/**
 * Class ExperienceController
 * @package App\Http\Controllers
 */
class ExperienceController extends Controller
{
    //
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $data = $request->all();

        $experience = MomentExperience::findOrFail($request->get('id'));

        if (isset($data['title']))
            $experience->name = $data['title'];
        if (isset($data['description']))
            $experience->description = $data['description'];
        if (isset($data['objectives']))
            $experience->objectives = $data['objectives'];
        $experience->save();

        return response()->json([
            'moment_id' => $experience->id,
            'message' => 'experiencia modificada correctamente'
        ], 200);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_experience_section(Request $request)
    {

        $data = $request->all();

        $moment = MomentExperience::findOrFail($request->get('id'));
        $test = @json_decode($data['data_section']);
        if ($test) {
            switch (intval(($data['section_number']))) {
                case 1:
                    $moment->section_1 = $data['data_section'];
                    break;
                case 2:
                    $moment->section_2 = $data['data_section'];
                    break;
                case 3:
                    $moment->section_3 = $data['data_section'];
                    break;
                case 4:
                    $moment->section_4 = $data['data_section'];
                    break;
                default:
                    return response()->json([
                        'message' => 'La sección no existe'
                    ], 400);
            }
            $moment->save();
        } else {
            return response()->json([
                'message' => 'El formato para guardar los datos de la sección no es el correcto, no se pudo modificar la sección '
            ], 400);
        }

        return response()->json([
            'experience_id' => $moment->id,
            'experience_section_number' => $data['section_number'],
            'message' => 'experiencia modificada correctamente'
        ], 200);


    }
}
