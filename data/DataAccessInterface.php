<?php

namespace app\extensions\restmodel\data;

use app\extensions\restmodel\models\BaseRestModel;
use yii\db\QueryInterface;

interface DataAccessInterface {

    /**
     * @return QueryInterface
     */
    public function find();

    /**
     * @return BaseRestModel
     */
    public function findOne();

    /**
     * @return BaseRestModel
     */
    public function findAll();

    /**
     * @param bool|true $runValidation
     * @param null      $attributeNames
     *
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null);

    /**
     * @param bool|true $runValidation
     * @param null      $attributeNames
     *
     * @return bool
     */
    public function insert($runValidation = true, $attributeNames = null);

    /**
     * @param bool|true $runValidation
     * @param null      $attributeNames
     *
     * @return bool
     */
    public function update($runValidation = true, $attributeNames = null);

    /**
     * @return bool
     */
    public function delete();
}