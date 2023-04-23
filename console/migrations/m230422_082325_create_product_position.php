<?php

use yii\db\Migration;

/**
 * Class m230422_082325_create_product_position
 */
class m230422_082325_create_product_position extends Migration
{
    /**
     * {@inheritdoc}
     */
    public const TABLE_NAME = '{{%product_position}}';

    public function up()
    {

        $tableOptions = null;

        if ('mysql' === $this->db->driverName) {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->null()->comment('Наименование'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }

}
