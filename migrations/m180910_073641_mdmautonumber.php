<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180910_073641_mdmautonumber.
 */
class m180910_073641_mdmautonumber extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%auto_number}}', [
            'group' => Schema::TYPE_STRING.'(32) NOT NULL',
            'number' => Schema::TYPE_INTEGER,
            'optimistic_lock' => Schema::TYPE_INTEGER,
            'update_time' => Schema::TYPE_INTEGER,
            'PRIMARY KEY ([[group]])',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180910_073641_mdmautonumber cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180910_073641_mdmautonumber cannot be reverted.\n";

        return false;
    }
    */
}
