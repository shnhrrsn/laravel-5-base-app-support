<?php namespace Shnhrrsn\LaravelSupport\View;

use Illuminate\View\ViewServiceProvider as ServiceProvider;

class ViewServiceProvider extends ServiceProvider {

	public function registerBladeEngine($resolver) {
		parent::registerBladeEngine($resolver);

		$this->app->singleton('blade.compiler', function($app) {
			return $app->make(BladeCompiler::class);
		});
	}

}
