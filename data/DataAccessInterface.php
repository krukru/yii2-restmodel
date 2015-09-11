<?php

namespace app\extensions\restmodel\models;

use app\extensions\restmodel\data\DataAccessInterface;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Json;

abstract class BaseRestModel extends Model implements DataAccessInterface
{

    //trebaju nam eventi i nešto što će vodit računa o dirty parametrima (možda)
    //svakako treba nešto što će znat da li je model new record ili je učitani record

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->isNewRecord()) {
            $this->insert($runValidation, $attributeNames);
        } else {
            $this->update($runValidation, $attributeNames);
        }
    }

    /**
     * Not yet implemented
     *
     * @return bool
     */
    private function isNewRecord()
    {
        return true;
    }

    public function insert($runValidation = true, $attributeNames = null)
    {
        $endpoint = $this->insertEndpoint();
        $url = $this->createUrl($this->baseUrl(), $endpoint->path);
        $requestBody = $this->serialize();
        $this->request($endpoint->method, $url, $requestBody);
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

    private function request($method, $url, $body = null)
    {
        dump(sprintf('Request Method: %s', $method));
        dump(sprintf('Request Url: %s', $url));
        dump(sprintf('Request Body: %s', $body));
    }

    public function update($runValidation = true, $attributeNames = null)
    {
        $endpoint = $this->updateEndpoint();
        $url = $this->createUrl($this->baseUrl(), $endpoint->path);
        $requestBody = $this->serialize();
        $this->request($endpoint->method, $url, $requestBody);
    }

    protected abstract function updateEndpoint();

    public function delete()
    {
        if ($this->isNewRecord()) {
            //vidi kako yii hendla ovo? isto i za update/insert - dal baciš exception ili svejedno probaš okinut brisanje itd ili samo ako je definiran $id odnosno deleteEndpoint
        }
        $endpoint = $this->deleteEndpoint();
        $url = $this->createUrl($this->baseUrl(), $endpoint->path);
        $this->request($endpoint->method, $url);
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