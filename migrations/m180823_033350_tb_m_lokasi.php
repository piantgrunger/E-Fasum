<?php

use yii\db\Migration;
use yii\db\Schema;

class m180823_033350_tb_m_lokasi extends Migration
{
    public function safeUp()
    {
        $this->createTable('tb_m_lokasi', [
         'id_lokasi' => Schema::TYPE_PK,
        'id_propinsi' => $this->integer()->notNull(),
         'id_kota' => $this->integer()->notNull(),
        'id_kecamatan' => $this->integer(),
        'id_kelurahan' => $this->bigInteger(),
        'no_sertifikat' => $this->string()->notNull(),
        'luas_tanah' => $this->decimal(10, 2)->notNull(),
        'nib' => Schema::TYPE_STRING.' NULL',
        'nama_sertifikat' => Schema::TYPE_STRING.' NOT NULL',
        'tanggal_sertifikat' => $this->date()->null(),
        'hak' => $this->string()->null(),
         'alamat_lokasi' => Schema::TYPE_STRING.' NOT NULL',
         'nama_perumahan' => Schema::TYPE_STRING.' NOT NULL',
        'alamat_perumahan' => Schema::TYPE_STRING.' NOT NULL',
        'nilai_satuan' => $this->decimal(16, 2)->notNull(),
       'total_nilai' => $this->decimal(16, 2)->notNull(),
     'asal_usul' => Schema::TYPE_STRING.' NULL',
     'pencatatan' => Schema::TYPE_STRING.' NULL',

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
