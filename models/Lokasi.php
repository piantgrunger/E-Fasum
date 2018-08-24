<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tb_m_lokasi".
 *
 * @property int    $id_lokasi
 * @property string $nama_lokasi
 * @property string $alamat_lokasi
 * @property int    $status
 * @property float  $latitude
 * @property float  $longitude
 * @property int    $created_at
 * @property int    $updated_at
 */
class Lokasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        return 'tb_m_lokasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_lokasi', 'alamat_lokasi'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['nama_lokasi', 'alamat_lokasi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lokasi' => 'Id Lokasi',
            'nama_lokasi' => 'Nama Lokasi',
            'alamat_lokasi' => 'Alamat Lokasi',

            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
