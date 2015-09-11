<?php

abstract class BaseRestModel extends Model implements DataAccessInterface {
	
	//trebaju nam eventi i nešto što će vodit računa o dirty parametrima (možda)
	//svakako treba nešto što će znat da li je model new record ili je učitani record
	
	/**
	* The base url for your api
	* @return string
	*/
	public abstract function baseUrl();
	
	public function save($runValidation = true, $attributeNames = null) {
		if ($this->isNewRecord()) {
			$this->insert(runValidation, attributeNames);
		}
		else {
			$this->update(runValidation, attributeNames);
		}
	}
	
	public function insert($runValidation = true, $attributeNames = null) {
		$endpoint = $this->insertEndpoint();
		$url = $this->createUrl($this->baseUrl(), $endpoint->path);
		$requestBody = $this->serialize();
		$http->request($endpoint->method, $url, $requestBody);
	}
	
	public function update($runValidation = true, $attributeNames = null) {
		$endpoint = $this->updatetEndpoint();
		$url = $this->createUrl($this->baseUrl(), $endpoint->path);
		$requestBody = $this->serialize(); //vidimo pattern ponavljanja - izvuci u metodu
		$http->request($endpoint->method, $url, $requestBody);
	}	
	
	public function delete() {
		if ($this->isNewRecord()) {
			//vidi kako yii hendla ovo? isto i za update/insert - dal baciš exception ili svejedno probaš okinut brisanje itd ili samo ako je definiran $id odnosno deleteEndpoint
		}
		$endpoint = $this->deleteEndpoint();
		$url = $this->createUrl($this->baseUrl(), $endpoint->path);
		$http->request($endpoint->method, $url, $requestBody);
	}		
		
	public function findOne($condition) {
		return $this->find($condition)->one();
	}
	
	public function findAll($condition) {
		return $this->find($condition)->all();
	}
	
	private function isNewRecord() {
		throw new Exception('Not yet implemented');
	}
	
	private function createUrl($baseUrl, $path) {
		$url = $baseUrl + $path //ali pazi ako u base path fali trailing slash
		return $url;
	}
	
	protected abstract function insertEndpoint();
	protected abstract function updateEndpoint();
	protected abstract function deleteEndpoint();
	
	
	//todo implement strategy, jsonSerializer, xmlSerializer, itd
	private function serialize() {
		$attributes = $this->getAttributes();
		$json = Json::encode($attributes);
	}
}