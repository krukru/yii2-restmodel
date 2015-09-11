<?php

namespace app\extensions\restmodel\examples\egnyte;

use app\extensions\restmodel\core\RestEndpoint;
use app\extensions\restmodel\core\RestMethod;

class UserRestModel extends BaseEgnyteRestModel {

	//čitava ova klasa bi mogla bit BaseUserRestModel

	public $id;
	public $username;
	public $email;
	public $role;

	//here we define validation rules
	protected function deleteEndpoint() {
		return new RestEndpoint(RestMethod::DELETE, sprintf('/pubapi/v2/users/%s', $this->id));
	}

	protected function insertEndpoint() {
		return new RestEndpoint(RestMethod::POST, '/pubapi/v2/users');
	}

	protected function updateEndpoint() {
		return new RestEndpoint(RestMethod::PATCH, sprintf('/pubapi/v2/users/%s', $this->id));
	}

	public function find($condition = null) {
		// TODO: Implement find() method.
	}
}