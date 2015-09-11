<?php

namespace app\models\base;

use app\extensions\restmodel\rest\RestEndpoint;
use app\extensions\restmodel\rest\RestMethod;
use app\models\UserRestModel;

/**
 * Class BaseUserRestModel
 *
 * @property int    $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 *
 * @package app\extensions\restmodel\examples\egnyte
 */
class BaseUserRestModel extends BaseEgnyteRestModel
{

    public $id;
    public $firstname;
    public $lastname;
    public $email;

    /**
     *
     * Here we define the model rules
     *
     * @return array
     */
    public function rules()
    {
        return array();
    }

    public function find()
    {
        return new UserRestModel();
    }

    protected function deleteEndpoint()
    {
        return new RestEndpoint(RestMethod::DELETE, sprintf('/pubapi/v2/users/%s', $this->id));
    }

    protected function insertEndpoint()
    {
        return new RestEndpoint(RestMethod::POST, '/pubapi/v2/users');
    }

    protected function updateEndpoint()
    {
        return new RestEndpoint(RestMethod::PATCH, sprintf('/pubapi/v2/users/%s', $this->id));
    }
}