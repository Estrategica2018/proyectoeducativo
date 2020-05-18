<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function register_update_answer (Request $request){

        if(@json_decode($request->options) && @json_decode($request->review)){
            $question = Question::updateOrCreate(
                ['sequence_id' => $request->sequence_id, 'moment_id' => $request->moment_id,'experience_id'=>$request->experience_id],
                ['options' =>$request->options , 'review' => $request->review,'type_answer' => $request->type_answer]
            );
        }else{
            if(!@json_decode($request->options))
                return response()->json(['data'=>'','message','El formato para registrar o actualizar los datos de preguntas no es el correcto'],200);
            return response()->json(['data'=>'','message','El formato para registrar o actualizar los datos de respuestas no es el correcto'],200);
        }
        return response()->json(['data'=>$question,'message','Pregunta registrada o actualizada'],200);

    }

    public function get_questions (Request $request){

        $question = Question::where([
            ['sequence_id' => $request->sequence_id],
            ['moment_id' => $request->moment_id],
            ['experience_id'=>$request->experience_id],
        ]);
        return response()->json(['data'=>$question],200);

    }

}
