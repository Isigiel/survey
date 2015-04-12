<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//routes

Route::get('view', function () {
    return view('set.index');
});

Route::get('/', 'WelcomeController@index');

Route::get('data', function () {
    return response()->download(storage_path().'/database.sqlite');
});

Route::get('env', function () {
    return app()->environment();
});

Route::get('login', 'WelcomeController@login');

Route::post('login', 'WelcomeController@authenticate');

Route::get('logout', 'WelcomeController@logout');

Route::resource('customer', 'CustomerController');

Route::resource('customer.user', 'CustomerUserController', ['only' => ['index', 'store', 'update', 'destroy']]);

Route::resource('customer.survey', 'CustomerSurveyController');

Route::get('customer/{customer}/survey/{survey}/send-welcome', ['as' => 'customer.survey.sendWelcome', 'uses' => 'CustomerSurveyController@sendWelcome']);

Route::get('customer/{customer}/survey/{survey}/analyze/{result}', ['as' => 'customer.survey.analyze', 'uses' => 'CustomerSurveyController@analyze']);

Route::get('customer/{customer}/survey/{survey}/result/standard/{result}', ['as' => 'customer.survey.result.standard', 'uses' => 'CustomerSurveyResultController@standard']);

Route::get('customer/{customer}/survey/{survey}/result/excel/{result}', ['as' => 'customer.survey.result.table', 'uses' => 'CustomerSurveyResultController@excel']);

Route::resource('customer.questionnaire', 'CustomerQuestionnaireController', ['except' => 'show']);

Route::get('customer/{customer}/questionnaire/{questionnaire}/duplicate', ['as' => 'customer.questionnaire.duplicate', 'uses' => 'CustomerQuestionnaireController@duplicate']);

Route::resource('customer.questionnaire.section', 'CustomerQuestionnaireSectionController', ['except' => 'show']);

Route::resource('customer.questionnaire.section.questiongroup', 'CustomerQuestionnaireSectionQuestiongroupController', ['except' => 'show']);

Route::post('customer/{customer}/questionnaire/{questionnaire}/section/{section}/questiongroup/order', ['as' => 'customer.questionnaire.section.questiongroup.order', 'uses' => 'CustomerQuestionnaireSectionQuestiongroupController@order']);

Route::resource('customer.set', 'CustomerSetController', ['only' => ['index', 'store', 'update', 'destroy']]);

Route::resource('customer.set.facility', 'CustomerSetFacilityController', ['except' => 'show']);
/*
Route::resource('customer.set.facility.group', 'CustomerSetFacilityGroupController', ['except' => 'show']);

Route::resource('customer.set.facility.group.child', 'CustomerSetFacilityGroupChildController', ['except' => 'show']);

Route::get('customer/{customer}/set/{set}/facility/{facility}/group/{group}/multi', ['as' => 'customer.set.facility.group.child.multi', 'uses' => 'CustomerSetFacilityGroupChildController@multi']);

Route::post('customer/{customer}/set/{set}/facility/{facility}/group/{group}/storemany', ['as' => 'customer.set.facility.group.child.storemany', 'uses' => 'CustomerSetFacilityGroupChildController@storemany']);
*/
Route::resource('mail', 'MailController');

Route::get('/survey/{survey}/token/{key}', ['as' => 'survey.token.key', 'uses' => 'TokenController@key']);

Route::post('/survey/{survey}/token/{token}', ['as' => 'survey.token.answer', 'uses' => 'TokenController@answer']);
