<?php

namespace app\extensions\restmodel\rest;

use yii\base\Object;

/**
 * Class RestEndpoint
 *
 * @property string $method
 * @property string $path
 * @package app\extensions\restmodel\core
 */
class RestEndpoint extends Object {

	private $method;
	private $path;

	public function __construct($method, $path) {
		$this->method = $method;
		$this->path = $path;
	}

	public function getMethod() {
		return $this->method;
	}

	public function getPath() {
		return $this->path;
	}

}