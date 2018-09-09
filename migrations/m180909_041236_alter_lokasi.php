<?php

use yii\db\Migration;

/**
 * Class m180909_041236_alter_lokasi
 */
class m180909_041236_alter_lokasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_lokasi', 'pagar', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'pondasi', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'patok', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'papan_nama', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'gambar_pagar', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'gambar_pondasi', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'gambar_patok', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'gambar_papan_nama', $this->string()->null());
        $this->addColumn('tb_m_lokasi', 'no_brankas', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_m_lokasi', 'pagar');
        $this->dropColumn('tb_m_lokasi', 'pondasi');
        $this->dropColumn('tb_m_lokasi', 'patok');
        $this->dropColumn('tb_m_lokasi', 'papan_nama');
        $this->dropColumn('tb_m_lokasi', 'gambar_pagar');
        $this->dropColumn('tb_m_lokasi', 'gambar_pondasi');
        $this->dropColumn('tb_m_lokasi', 'gambar_patok');
        $this->dropColumn('tb_m_lokasi', 'gambar_papan_nama');
        $this->dropColumn('tb_m_lokasi', 'no_brankas');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180909_041236_alter_lokasi cannot be reverted.\n";

        return false;
    }
    */
}
