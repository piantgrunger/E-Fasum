<?php

use yii\db\Migration;
use yii\db\Schema;

class m180823_033350_tb_m_lokasi extends Migration
{
    public function safeUp()
    {
        $this->createTable('tb_m_lokasi', [
            'id_lokasi' => Schema::TYPE_PK,
            'nama_lokasi' => Schema::TYPE_STRING.' NOT NULL',
            'alamat_lokasi' => Schema::TYPE_STRING.' NOT NULL',
            'latitude' => 'DECIMAL(11, 8) NULL',
            'longitude' => 'DECIMAL(11, 8) NULL',

             'created_at' => Schema::TYPE_INTEGER.'  NULL',
            'updated_at' => Schema::TYPE_INTEGER.'  NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tb_m_lokasi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180823_033350_tb_m_lokasi cannot be reverted.\n";

        return false;
    }
    */
}
