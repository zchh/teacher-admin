<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		//'App\Http\Middleware\VerifyCsrfToken',
		'App\Http\Middleware\PostCheck',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
		"LoginAdminCheck" =>"App\Http\Middleware\LoginAdminCheck",
		"LoginUserCheck" =>"App\Http\Middleware\LoginUserCheck",
        "TLoginAdminCheck" => "App\Http\Middleware\TLoginAdminCheck",
        "TLoginTeacherCheck" => "App\Http\Middleware\TLoginTeacherCheck"
	];

}
