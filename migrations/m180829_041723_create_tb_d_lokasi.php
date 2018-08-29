<?php

use yii\db\Migration;

/**
 * Class m180829_041723_create_tb_d_lokasi.
 */
class m180829_041723_create_tb_d_lokasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_d_lokasi', [
            'id_d_lokasi' => $this->primaryKey(),
            'id_lokasi' => $this->integer()->notNull(),

           'latitude' => 'DECIMAL(11, 8) NULL',
            'longitude' => 'DECIMAL(11, 8) NULL',
           ]);

        // add foreign key for table `provinsi`
        $this->addForeignKey(
            'fk-lokasi-id_lokasi',
            'tb_d_lokasi',
            'id_lokasi',
            'tb_m_lokasi',
            'id_lokasi',
            'CASCADE'
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('tb_d_lokasi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180829_041723_create_tb_d_lokasi cannot be reverted.\n";

        return false;
    }
    */
}
