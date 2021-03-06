<?php namespace Shnhrrsn\LaravelSupport;

class Application extends \Illuminate\Foundation\Application {

	public function environmentFile() {
		throw new \Exception('DotEnv is not supported in this application.');
	}

	public function environment() {
		$env = $this['env'];

		if(count(func_get_args()) > 0) {
			if(strpos($env, '.') !== false) {
				$args = func_get_args();
				$envs = explode('.', $env);

				$env = null;

				foreach($envs as $e) {
					if($env === null) {
						$env = $e;
					} else {
						$env .= '.' . $e;
					}

					if(in_array($env, func_get_args())) {
						return true;
					}
				}

				return false;
			} else {
				return in_array($env, func_get_args());
			}
		}

		return $env;
	}

	public function getCachedConfigPath() {
		return $this->basePath() . '/bootstrap/cache/config.' . $this->environment() . '.php';
	}

	public function getCachedRoutesPath() {
		return $this->basePath() . '/bootstrap/cache/routes.' . $this->environment() . '.php';
	}

	public function getCachedServicesPath() {
		return $this->basePath() . '/bootstrap/cache/services.' . $this->environment() . '.json';
	}

}
