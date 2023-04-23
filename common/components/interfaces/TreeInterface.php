<?php

namespace common\components\interfaces;

use common\models\Tree;
use common\models\TreeApple;
use yii\db\ActiveRecord;

/**
 *
 */
interface TreeInterface
{

    /**
     * @return Array
     */
    public function getAll(): ActiveRecord;

    /**
     * @param integer $id
     * @return Tree
     */
    public function get(integer $id): Tree;

    /**
     * @return Tree
     */
    public function add(): Tree;

    /**
     * @param $tree_id
     * @param $apple_id
     * @return TreeApple
     */
    public function addApples($tree_id, $apple_id): TreeApple;

    /**
     * @param $tree_id
     * @param $apple_id
     */
    public function deleteApple($tree_id, $apple_id);

    /**
     * @param $tree_id
     * @param $apple_id
     */
    public function fellApple($tree_id, $apple_id);

    /**
     * @param integer $id
     * @return bool|Tree
     */
    public function remove(integer $id): bool;
}