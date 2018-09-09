<?php

use yii\db\Migration;

/**
 * Class m180909_153017_create_dt_dok
 */
class m180909_153017_create_dt_dok extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_lokasi', 'foto_dokumen', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180909_153017_create_dt_dok cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180909_153017_create_dt_dok cannot be reverted.\n";

        return false;
    }
    */
}
