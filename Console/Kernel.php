<?php namespace Shnhrrsn\LaravelSupport\Console;

class Kernel extends \Illuminate\Foundation\Console\Kernel {

	public function bootstrap() {
		parent::bootstrap();

		$this->app->singleton('command.key.generate', KeyGenerateCommand::class);
	}

}
