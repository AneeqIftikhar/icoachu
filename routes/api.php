<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('quiz/{id}/student/{id}', 'ChapterController@getAllChapterOfSubject');





Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::group(['middleware' => ['jwt.auth']], function () {

Route::resource('student_grade','Student_GradeController');
Route::resource('student_subject','Student_SubjectController');
Route::resource('quiz','QuizController');
Route::get('quiz/{quiz_id}/{student_id}', 'QuizController@show');

Route::resource('question','QuestionController');

Route::resource('quiz_time_management','Quiz_Time_ManagementController');
Route::post('time','Quiz_Time_ManagementController@getTimeLeft');
Route::resource('topic','TopicController');
Route::get('compute_result/{quiz_id}/{student_id}', 'Student_Quiz_ResponseController@compute_result');

Route::get('generate_report/{student_id}/{subject_grade_id}', 'Student_Quiz_ResponseController@generate_report');


});





Route::resource('student_quiz_response','Student_Quiz_ResponseController');

 Route::resource('chapter','ChapterController');
        Route::resource('question_meta','Question_MetaController');
        Route::resource('user','UserController');
        Route::resource('student_response','Student_ResponseController');
        Route::resource('subject','SubjectController');
        Route::resource('subject_grade','Subject_GradeController');
        
        Route::resource('grade','GradeController');
       


Route::get('subject/{id}/chapter', 'ChapterController@getAllChapterOfSubject');
Route::get('subject/{id}/topic', 'TopicController@getAllTopicOfSubject');
Route::get('subject/{id}/question', 'QuestionController@getAllQuestionOfSubject');


Route::get('topic/{id}/question', 'QuestionController@getAllQuestionOfTopic');

Route::get('chapter/{id}/question', 'QuestionController@getAllQuestionOfChapter');