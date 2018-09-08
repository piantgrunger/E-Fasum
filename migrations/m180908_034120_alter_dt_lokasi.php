<?php

use yii\db\Migration;

/**
 * Class m180908_034120_alter_dt_lokasi.
 */
class m180908_034120_alter_dt_lokasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_d_lokasi', 'posisi', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180908_034120_alter_dt_lokasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180908_034120_alter_dt_lokasi cannot be reverted.\n";

        return false;
    }
    */
}
