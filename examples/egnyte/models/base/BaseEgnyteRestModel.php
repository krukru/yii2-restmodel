<?php

namespace app\models\base;

use app\extensions\restmodel\models\BaseRestModel;

abstract class BaseEgnyteRestModel extends BaseRestModel
{

    public function baseUrl()
    {
        return sprintf('https://%s.egnyte.com/', ConfigHelper::egnyteDomain());
    }

}

class ConfigHelper
{
    public static function egnyteDomain()
    {
        return 'foo';
    }
}