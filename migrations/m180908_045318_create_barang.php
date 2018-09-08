<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180908_045318_create_barang.
 */
class m180908_045318_create_barang extends Migration
{
    const TABLE_NAME = 'tb_m_barang';

    public function up()
    {
        $this->createTable(self::TABLE_NAME, [
        'id_barang' => $this->primaryKey(),
        'kode_barang' => $this->string(50)->notNull()->unique(),

        'nama_barang' => $this->string(100)->notNull(),
    ]);

        // path tempat file csv berada
        $barang = Yii::getAlias('@app/migrations/barang.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($barang);
        // insert data provinsi kedalam tabel provinsi
        foreach ($reader as $index => $row) {
            $this->insert('tb_m_barang', [
        'kode_barang' => $row[0],
        'nama_barang' => $row[1],
    ]);
        }
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}

/*
// Use safeUp/safeDown to run migration code within a transaction
public function safeUp()
*/
