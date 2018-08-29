<?php

use yii\db\Migration;

/**
 * Class m180829_103706_alter_lokasi.
 */
class m180829_103706_alter_lokasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_lokasi', 'gambar', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180829_103706_alter_lokasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180829_103706_alter_lokasi cannot be reverted.\n";

        return false;
    }
    */
}
