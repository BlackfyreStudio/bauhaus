<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['prefix' => Config::get('bauhaus::admin.uri')], function () {

	Route::group(['before' => 'bauhaus.auth'], function () {

		View::share('currentUser',Sentry::getUser());

		Route::get('/', [
			'as'   => 'admin.dashboard',
			'uses' => 'KraftHaus\Bauhaus\DashboardController@index'
		]);

		Route::get('model/{model}', [
			'as'   => 'admin.model.index',
			'uses' => 'KraftHaus\Bauhaus\ModelController@index',
			'before' => 'hasRead'
		]);

		Route::get('model/{model}/create', [
			'as'   => 'admin.model.create',
			'uses' => 'KraftHaus\Bauhaus\ModelController@create',
			'before' => 'hasCreate'
		]);

		Route::post('model/{model}', [
			'as'   => 'admin.model.store',
			'uses' => 'KraftHaus\Bauhaus\ModelController@store',
			'before' => 'hasCreate'
		]);

		Route::get('model/{model}/{id}', [
			'as'   => 'admin.model.edit',
			'uses' => 'KraftHaus\Bauhaus\ModelController@edit',
			'before' => 'hasUpdate'
		]);

		Route::put('model/{model}/{id}', [
			'as'   => 'admin.model.update',
			'uses' => 'KraftHaus\Bauhaus\ModelController@update',
			'before' => 'hasUpdate'
		]);

		Route::delete('model/{model}/{id}', [
			'as'   => 'admin.model.destroy',
			'uses' => 'KraftHaus\Bauhaus\ModelController@destroy',
			'before' => 'hasDelete'
		]);

		Route::post('model/{model}/multi-destroy', [
			'as'   => 'admin.model.multi-destroy',
			'uses' => 'KraftHaus\Bauhaus\ModelController@multiDestroy',
			'before' => 'hasDelete'
		]);

		Route::get('model/{model}/export/{type}', [
			'as'   => 'admin.model.export',
			'uses' => 'KraftHaus\Bauhaus\ModelController@export'
		])->where('type', 'json|xml|csv|xls');

		Route::post('slugger',[
			'as'=>'admin.slugger',
			function() {
				return Response::json(['response'=>Str::slug(Input::get('toSlug'))]);
			}
		]);

		// extra route includes
		require_once __DIR__ . '/routes/modals.php';
	});

});
