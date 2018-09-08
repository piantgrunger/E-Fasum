<?php

use yii\db\Migration;

/**
 * Class m180908_050351_alter_lokasi.
 */
class m180908_050351_alter_lokasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_lokasi', 'id_barang', $this->string()->notNull());
        $this->addColumn('tb_m_lokasi', 'dokumen_kepemilikan', $this->string()->notNull());
        $this->addColumn('tb_m_lokasi', 'penggunaan_tanah', $this->text()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180908_050351_alter_lokasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180908_050351_alter_lokasi cannot be reverted.\n";

        return false;
    }
    */
}
