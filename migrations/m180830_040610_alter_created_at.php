<?php

use yii\db\Migration;

/**
 * Class m180830_040610_alter_created_at.
 */
class m180830_040610_alter_created_at extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_m_lokasi', 'created_at', $this->dateTime());
        $this->alterColumn('tb_m_lokasi', 'updated_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180830_040610_alter_created_at cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180830_040610_alter_created_at cannot be reverted.\n";

        return false;
    }
    */
}
