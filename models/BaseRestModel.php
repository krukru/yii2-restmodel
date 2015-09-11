<?php

namespace app\extensions\restmodel\models;

use app\extensions\restmodel\data\DataAccessInterface;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\Response;

abstract class BaseRestModel extends Model implements DataAccessInterface
{

    //trebaju nam eventi i nešto što će vodit računa o dirty parametrima (možda)

    private $isNewRecord = true;


    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->isNewRecord()) {
            $this->insert($runValidation, $attributeNames);
        } else {
            $this->update($runValidation, $attributeNames);
        }
    }


    /**
     * @return bool
     */
    private function isNewRecord()
    {
        return $this->isNewRecord;
    }

    public function insert($runValidation = true, $attributeNames = null)
    {
        if ($runValidation) {
            $isValidModel = $this->validate($attributeNames);
        } else {
            $isValidModel = true;
        }
        if ($isValidModel) {
            $endpoint = $this->insertEndpoint();
            $url = $this->createUrl($this->baseUrl(), $endpoint->path);
            $requestBody = $this->serialize();
            $response = $this->request($endpoint->method, $url, $requestBody);
            return $response->isSuccessful;
        } else {
            return false;
        }
    }

    protected abstract function insertEndpoint();

    private function createUrl($baseUrl, $path)
    {
        $url = sprintf('%s/%s', rtrim($baseUrl, '/'), ltrim($path, '/'));
        return $url;
    }

    /**
     * The base url for your api
     *
     * @return string
     */
    public abstract function baseUrl();

    /**
     * @todo implement strategy, jsonSerializer, xmlSerializer, itd
     */
    private function serialize()
    {
        $attributes = $this->getAttributes();
        $json = Json::encode($attributes);
        return $json;
    }

    /**
     * @param      $method
     * @param      $url
     * @param null $body
     *
     * @returns Response
     */
    private function request($method, $url, $body = null)
    {
        dump(sprintf('Request Method: %s%sRequest Url: %s%sRequest Body: %s', $method, PHP_EOL, $url, PHP_EOL, $body));
        $fakeResponse = new Response();
        $fakeResponse->statusCode = 200;
        return $fakeResponse;
    }

    public function update($runValidation = true, $attributeNames = null)
    {
        if ($runValidation) {
            $isValidModel = $this->validate($attributeNames);
        } else {
            $isValidModel = true;
        }
        if ($isValidModel) {
            $endpoint = $this->updateEndpoint();
            $url = $this->createUrl($this->baseUrl(), $endpoint->path);
            $requestBody = $this->serialize();
            $response = $this->request($endpoint->method, $url, $requestBody);
            return $response->isSuccessful;
        } else {
            return false;
        }
    }

    protected abstract function updateEndpoint();

    public function delete()
    {
        $endpoint = $this->deleteEndpoint();
        $url = $this->createUrl($this->baseUrl(), $endpoint->path);
        $response = $this->request($endpoint->method, $url);
        return $response->isSuccessful;
    }

    protected abstract function deleteEndpoint();

    public function findOne($condition = null)
    {
        return $this->find($condition)->one();
    }

    public function findAll($condition = null)
    {
        return $this->find($condition)->all();
    }
}