<?php

namespace app\extensions\restmodel\core;

use yii\db\QueryInterface;

interface DataAccessInterface {

    /**
     * @param string $condition
     *
     * @return QueryInterface
     */
    public function find($condition = null);

    /**
     * @param null $condition
     *
     * @return BaseRestModel
     */
    public function findOne($condition = null);

    /**
     * @param null $condition
     *
     * @return BaseRestModel
     */
    public function findAll($condition = null);

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