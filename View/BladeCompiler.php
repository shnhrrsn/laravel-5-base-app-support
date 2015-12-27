<?php namespace Shnhrrsn\LaravelSupport\View;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Foundation\Application;

class BladeCompiler extends \Illuminate\View\Compilers\BladeCompiler {

	public function __construct(Filesystem $files, Application $app) {
		parent::__construct($files, $app['config']['view.compiled']);

		$this->addAssetExtension($app);
	}

	protected function addAssetExtension(Application $app) {
		$assets = new \stdClass;
		$assets->styles = [ ];
		$assets->scripts = [ ];

		$app['view']->share('_assets', $assets);
	}

	public function compileAsset($expression) {
		list($type, $asset) = explode(',', $this->sanitizeExpression($expression), 2);

		$type = trim($type);
		$asset = trim($asset);

		if(preg_match('/^[a-z\'\"]+$/', $type, $m)) {
			$type = trim(str_replace([ '"', '\'' ], '', $type));
			$var = null;

			if($type === 'css' || $type === 'scss') {
				$var = 'styles';
			} else if($type === 'coffee' || $type === 'js') {
				$var = 'scripts';
			}

			$path = null;
			if($var !== null) {
				if(preg_match('/^(\'|")([a-z0-9\-\_\/]+)\1$/i', $asset, $m)) {
					$path = 'asset_path(\'' . $type . '/' . ltrim($m[2], '/') . '.' . $type . '\')';
				} else {
					$path = sprintf('asset_path(\'%s/\' . ltrim(%s, \'/\') . \'.%s\')', $type, $asset, $type);
				}
			} else if($type === 'style' || $type === 'script') {
				$var = $type . 's';
			}

			if($path !== null) {
				return sprintf('<?php $_assets->%s[] = %s; ?>', $var, $path);
			} else {
				throw new \Exception('@asset does not support the type: "' . $type . '".');
			}
		} else {
			throw new \Exception('@asset does not support variables for the type parameter');
		}
	}

	public function compileUses($expression) {
		return '<?php use ' . $this->sanitizeExpression($expression) . '; ?>';
	}

	public function compileVar($expression) {
		list($var, $value) = explode(',', $this->sanitizeExpression($expression), 2);
		return sprintf('<?php %s = %s; ?>', trim($var), trim($value));
	}

	private function sanitizeExpression($expression) {
		$expression = trim($expression);

		if(starts_with($expression, '(')) {
			$expression = substr($expression, 1, -1);
		}

		return $expression;
	}

}
