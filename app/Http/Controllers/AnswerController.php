<?php

namespace App\Http\Controllers;

use App\Mail\SendReportAnswerTutor;
use App\Models\AdvanceLine;
use App\Models\AfiliadoEmpresa;
use App\Models\Answer;
use App\Models\CompanySequence;
use App\Models\SequenceMoment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class AnswerController
 * @package App\Http\Controllers
 */
class AnswerController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register_update_answer(Request $request)
    {
        if (true) {//@json_decode($request->questions_answers)) {
            $questions_answers = $request->questions_answers;
            $student = $request->user('afiliadoempresa');

            //$questions_answers = $request->questions_answers;
            foreach ($questions_answers as $question_answer) {
                //if(@json_decode($question_answer->answer)){
                //return response()->json(['data' => $question_answer['question_id'], 'message' => 'Respuestas registradas o actualizadas, se ha notificado al familiar las respuestas'], 200);
                Answer::updateOrCreate(
                    [
                        'student_affiliated_company_id' => $student->id,
                        'company_id' => $request->company_id,
                        'affiliated_account_service_id' => $request->affiliated_account_service_id,
                        'question_id' => $question_answer['question_id'],
                    ]
                    ,
                    [
                        'answer' => $question_answer['answer'],
                        //'feedback' => $request->feedback, v2
                        //'teacher_affiliated_company_id' => $request->teacher_affiliated_company_id, v2
                        'date_evaluation' => Carbon::now()
                    ]
                );
                //}
            }

            $tutor = AfiliadoEmpresa::whereHas('affiliated_company', function ($query) use ($request, $student) {
                $query->whereHas('conection_tutor', function ($query) use ($student, $request) {
                    $query->where('student_company_id', $student->affiliated_company->where('rol_id', 1)->where('company_id', $request->company_id)->first()->id);
                })->where([
                    ['rol_id', 3],
                    ['company_id', $request->company_id]
                ]);
            })->first();
            $advanceLine = AdvanceLine::where([
                ['affiliated_company_id',$student->id],
                ['affiliated_account_service_id',$request->affiliated_account_service_id],
                ['sequence_id',$request->sequence_id],
                ['moment_order',$request->moment_id]
            ])->orderBy('moment_order', 'ASC')->orderBy('moment_section_id', 'ASC')->get();
            $place_advance_line = "";
            foreach ($advanceLine as $advanceLineSection){
                $sequenceMoment = SequenceMoment::where([
                    ['sequence_company_id',$request->sequence_id],
                    ['order',$request->moment_id]
                ])->first();
                switch ($advanceLineSection->moment_section_id){
                    case 1:
                        $section = json_decode($sequenceMoment->section_1, true);
                        $place_advance_line = $section['section']['name'].', ';
                        break;
                    case 2:
                        $section = json_decode($sequenceMoment->section_2, true);
                        $place_advance_line = $place_advance_line.' '.$section['section']['name'].',';
                        break;
                    case 3:
                        $section = json_decode($sequenceMoment->section_3, true);
                        $place_advance_line = $place_advance_line.' '.$section['section']['name'].',';
                        break;
                    case 4:
                        $section = json_decode($sequenceMoment->section_4, true);
                        $place_advance_line = $place_advance_line.' '.$section['section']['name'].',';
                        break;
                }

            }
            if( substr($place_advance_line, -1) === ',' )
                    $place_advance_line = substr($place_advance_line, 0, -1);

            $reportAnswers = $this->get_answers($request);
            $performance = (collect($reportAnswers)->sum('review_student') / count($reportAnswers));
            $sequence = CompanySequence::select('name')->where('id', $request->sequence_id)->first();
            $moment = SequenceMoment::select('name','performances')->where('id', $request->moment_id)->first();
            $performance_comment_array = explode('|',$moment->performances) ;
            switch ($performance) {
                case ($performance >= 90):
                    $color_performance = 'green';
                    $performance_comment = $performance_comment_array[0];
                    $level = "nivel superior (S) 90 – 100%.";
                    $qualification = '(S)';
                break;
                case ($performance >= 70 && $performance <= 89):
                    $color_performance = 'green';
                    $performance_comment = $performance_comment_array[1];
                    $level = "nivel alto (A) 70 – 89%.";
                    $qualification = '(A)';
                break;
                case ($performance >= 60 && $performance <= 69):
                    $color_performance = '#FFF824';
                    $performance_comment = $performance_comment_array[2];
                    $level = "nivel básico (B) 60 – 69%.";
                    $qualification = '(B)';
                break;
                case ($performance >= 40 && $performance <= 59):
                    $color_performance = 'red';
                    $performance_comment = $performance_comment_array[2];
                    $level = "nivel bajo (B) 40 – 59%.";
                    $qualification = '(B)';
                break;
                case ($performance < 40):
                    $color_performance = 'red';
                    $performance_comment = $performance_comment_array[2];
                    $level = "nivel bajo (B) 0 – 39%.";
                    $qualification = '(B)';
                    break;
            }

            Mail::to($tutor->email)->send(new SendReportAnswerTutor($tutor, $student, $reportAnswers, $sequence, $moment, $level, $performance_comment,$color_performance,$performance,$place_advance_line));
            return response()->json(['data' => ['performance' => $performance, 'performance_comment' => $performance_comment, 'level' => $level, 'qualification' => $qualification], 'message' => 'Respuestas registradas o actualizadas, se ha notificado al familiar las respuestas'], 200);
        }
        return response()->json(['data' => '', 'message' => 'El formato para registrar o actualizar los datos de respuesta no es el correcto'], 401);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function get_answers(Request $request)
    {
        $student = $request->user('afiliadoempresa');

        $answers = Answer::with('question')->whereHas('question', function ($query) use ($request) {
            $query->where([
                ['sequence_id', '=', $request->sequence_id],
                ['moment_id', '=', $request->moment_id],
                ['experience_id', '=', $request->experience_id]
            ]);
        })->where([
            ['student_affiliated_company_id', $student->id],
            ['company_id', $request->company_id]
        ])->get();
        $questions = [];
        foreach ($answers as $answer) {
            $data = $this->get_answer_student($answer->answer, $answer->question->options, $answer->question->review);
            $data['title'] = $answer->question->title;
            $data['struct_concept'] = 'La respuesta esperada es: '.$data['type_numeral'].':'.$data['answer_question'].' Porque: '.$answer->question->concept;
            $data['objective'] = $answer->question->objective;
            $data['concept'] = $answer->question->concept;
            array_push($questions, $data);
            Answer::where('id', $answer->id)->update([
                'feedback' => $data['review_student'],
                'date_evaluation' => Carbon::now(),
                'concept' => $data['struct_concept']
            ]);

        }
        return $questions;
    }

    /**
     * @param $option_id
     * @param $options
     * @param $reviews
     * @return array
     */
    public function get_answer_student($option_id, $options, $reviews)
    {

        $data = [];
        $options = collect(@json_decode($options));
        $reviews = collect(@json_decode($reviews));
        $data['answer_student'] = $options->firstWhere('id', $option_id)->option;
        $data['review_student'] = $reviews->firstWhere('id', $option_id)->review;
        $data['answer_question'] = $options->firstWhere('id', $reviews->firstWhere('review', '100')->id)->option;
        $data['type_numeral'] = $reviews->firstWhere('review', '100')->id;
        $option_id == $reviews->firstWhere('review', '100')->id ? $data['is_correct'] = true : $data['is_correct'] = false;

        return $data;
    }

}
