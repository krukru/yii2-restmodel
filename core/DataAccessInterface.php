<?php

interface DataAccessInterface {
	
	//return QueryInterface
	public function find($condition = null);
	
	//return BaseRestModel
    public function findOne($condition = null);

	//return BaseRestModel
    public function findAll($condition = null);

	//return boolean
    public function save($runValidation = true, $attributeNames = null);

	//return boolean
    public function insert($runValidation = true, $attributes = null);

	//return boolean
    public function update($runValidation = true, $attributeNames = null);

	//return boolean
    public function delete();
}