<?php

use yii\db\Migration;
use yii\db\Schema;

class m180823_033350_tb_m_lokasi extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        $this->createTable('tb_m_lokasi', [
            'id_lokasi' => Schema::TYPE_PK,
            'nama_lokasi' => Schema::TYPE_STRING.' NOT NULL',
            'jenis_lokasi' => Schema::TYPE_STRING.' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
            'google_place_id' => Schema::TYPE_STRING.' NOT NULL', // e.g. google places id
            'gps' => 'POINT NOT NULL',
             'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        echo "m180823_033350_tb_m_lokasi cannot be reverted.\n";

        return false;
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
