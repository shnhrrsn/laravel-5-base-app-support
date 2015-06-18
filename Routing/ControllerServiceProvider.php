<?php namespace Shnhrrsn\LaravelSupport\Routing;

class ControllerServiceProvider extends \Illuminate\Routing\ControllerServiceProvider {

	public function register() {
		$this->app->singleton('illuminate.route.dispatcher', function($app) {
			return new ControllerDispatcher($app['router'], $app);
		});
	}

}
