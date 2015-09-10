<?php

abstract class BaseEgnyteRestModel extends BaseRestModel {
	
	public function baseUrl() {
		return sprintf('https://%s.egnyte.com/', ConfigHelper::engyteDomain());
	}
	
}