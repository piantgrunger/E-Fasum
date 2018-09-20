<?php

use yii\db\Migration;

/**
 * Class m180920_042427_alterlokasi.
 */
class m180920_042427_alterlokasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_m_lokasi', 'alamat_perumahan', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180920_042427_alterlokasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180920_042427_alterlokasi cannot be reverted.\n";

        return false;
    }
    */
}
