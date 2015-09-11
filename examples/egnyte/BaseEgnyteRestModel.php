<?php

namespace app\extensions\restmodel\examples\egnyte;

use app\extensions\restmodel\core\BaseRestModel;

abstract class BaseEgnyteRestModel extends BaseRestModel {

	public function baseUrl() {
		return sprintf('https://%s.egnyte.com/', ConfigHelper::egnyteDomain());
	}

}

class ConfigHelper {
	public static function egnyteDomain() {
		return 'foo';
	}
}