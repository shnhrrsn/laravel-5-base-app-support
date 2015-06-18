<?php namespace Shnhrrsn\LaravelSupport\Routing;

class Router extends \Illuminate\Routing\Router {

	private function packAction($action, $as) {
		if(is_string($action)) {
			$action = [ 'uses' => $action ];
		}

		if(is_array($action) && !isset($action['as']) && !empty($as)) {
			$action['as'] = $as;
		}

		return $action;
	}

	public function get($uri, $action, $as = null) {
		return parent::get($uri, $this->packAction($action, $as));
	}

	public function post($uri, $action, $as = null) {
		return parent::post($uri, $this->packAction($action, $as));
	}

	public function put($uri, $action, $as = null) {
		return parent::put($uri, $this->packAction($action, $as));
	}

	public function patch($uri, $action, $as = null) {
		return parent::patch($uri, $this->packAction($action, $as));
	}

	public function delete($uri, $action, $as = null) {
		return parent::delete($uri, $this->packAction($action, $as));
	}

	public function options($uri, $action, $as = null) {
		return parent::options($uri, $this->packAction($action, $as));
	}

	public function any($uri, $action, $as = null) {
		return parent::any($uri, $this->packAction($action, $as));
	}

}
