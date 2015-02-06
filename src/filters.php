<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Auth filter.
 * This filter is configurable in the config file.
 *
 * @see https://github.com/krafthaus/bauhaus/wiki/Authentication
 */
Route::filter('bauhaus.auth', function () {
	$filter = Config::get('bauhaus::admin.auth.permission');

	if ($filter() === false) {
		return Redirect::guest(Config::get('bauhaus::admin.auth.login_path'));
	}
});

Route::filter('hasRead',function() {
	$model = Route::input('model');
	$model = str_replace('.','-',$model);
	$user = Sentry::getUser();

	if (!$user->hasAnyAccess([$model,$model.'.read']) || !$user->isSuperUser()) {
		Session::flash('message.error', trans('bauhaususer::messages.error.messages.permission.no-index'));
		return Redirect::route('admin.dashboard');
	}
});

Route::filter('hasCreate',function() {
	$model = Route::input('model');
	$model = str_replace('.','-',$model);
	$user = Sentry::getUser();

	if (!$user->hasAnyAccess([$model,$model.'.create']) || !$user->isSuperUser()) {
		Session::flash('message.error', trans('bauhaususer::messages.error.messages.permission.no-create'));
		return Redirect::route('admin.dashboard');
	}
});

Route::filter('hasUpdate',function() {
	$model = Route::input('model');
	$model = str_replace('.','-',$model);
	$user = Sentry::getUser();

	if (!$user->hasAnyAccess([$model,$model.'.update']) || !$user->isSuperUser()) {
		Session::flash('message.error', trans('bauhaususer::messages.error.messages.permission.no-update'));
		return Redirect::route('admin.dashboard');
	}
});

Route::filter('hasDelete',function() {
	$model = Route::input('model');
	$model = str_replace('.','-',$model);
	$user = Sentry::getUser();

	if (!$user->hasAnyAccess([$model,$model.'.delete']) || !$user->isSuperUser()) {
		Session::flash('message.error', trans('bauhaususer::messages.error.messages.permission.no-delete'));
		return Redirect::route('admin.dashboard');
	}
});
