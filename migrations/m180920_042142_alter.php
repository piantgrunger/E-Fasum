<?php

use yii\db\Migration;

/**
 * Class m180920_042142_alter.
 */
class m180920_042142_alter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_d_lokasi', 'koordinat', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180920_042142_alter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180920_042142_alter cannot be reverted.\n";

        return false;
    }
    */
}
