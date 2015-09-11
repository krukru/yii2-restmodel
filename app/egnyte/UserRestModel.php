<?php

class UserRestModel extends BaseProjectARestModel {
	
	//čitava ova klasa bi mogla bit BaseUserRestModel
	
	public $id; #pk, bigint
	public $username; #required, string
	public $email; #required, string
	public $role; #optional, string (but has special validation rules, can only be 'default' or role that exists)
	
	//here we define validation rules

	protected function deleteEndpoint() {
		return new RestEndpoint(RestMethod.DELETE, sprintf('/pubapi/v2/users/%s', $this->id);
	}
	
	protected function insertEndpoint() {
		return new RestEndpoint(RestMethod.POST, '/pubapi/v2/users');
	}
	
	protected function updateEndpoint() {
		return new RestEndpoint(RestMethod.PATCH, sprintf('/pubapi/v2/users/%s', $this->id);
	}
	
}