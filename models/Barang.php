<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tb_m_barang".
 *
 * @property int $id_barang
 * @property string $kode_barang
 * @property string $nama_barang
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                 'value' => new Expression('NOW()'),
            ],
        ];
    }
    public static function tableName()
    {
        return 'tb_m_barang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_barang', 'nama_barang'], 'required'],
            [['kode_barang'], 'string', 'max' => 50],
            [['nama_barang'], 'string', 'max' => 100],
            [['kode_barang'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_barang' => Yii::t('app', 'Id Barang'),
            'kode_barang' => Yii::t('app', 'Kode Barang'),
            'nama_barang' => Yii::t('app', 'Nama Barang'),
        ];
    }
}
