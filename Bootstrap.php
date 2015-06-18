<?php namespace Shnhrrsn\LaravelSupport;

use Illuminate\Contracts\Foundation\Application as IlluminateApplication;

class Bootstrap {

	public static function start(IlluminateApplication $app) {
		$app->singleton(
			\Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
			\Shnhrrsn\LaravelSupport\Bootstrap\LoadConfiguration::class
		);
	}

}
