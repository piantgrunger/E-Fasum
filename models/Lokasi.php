<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tb_m_lokasi".
 *
 * @property int    $id_lokasi
 * @property string $nama_lokasi
 * @property string $jenis_lokasi
 * @property int    $status
 * @property string $google_place_id
 * @property string $gps
 * @property int    $created_at
 * @property int    $updated_at
 */
class Lokasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $lat;
    public $lng;

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
            [['nama_lokasi', 'google_place_id', 'gps', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['gps'], 'string'],
            [['nama_lokasi', 'jenis_lokasi', 'google_place_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lokasi' => Yii::t('app', 'Id Lokasi'),
            'nama_lokasi' => Yii::t('app', 'Nama Lokasi'),
            'jenis_lokasi' => Yii::t('app', 'Jenis Lokasi'),
            'status' => Yii::t('app', 'Status'),
            'google_place_id' => Yii::t('app', 'Google Place ID'),
            'gps' => Yii::t('app', 'Gps'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
