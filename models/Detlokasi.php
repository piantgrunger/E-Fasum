<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_d_lokasi".
 *
 * @property int       $id_d_lokasi
 * @property int       $id_lokasi
 * @property string    $latitude
 * @property string    $longitude
 * @property TbMLokasi $lokasi
 */
class Detlokasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_d_lokasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['longitude', 'latitude'], 'required'],
            [['id_lokasi'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['lokasi'], 'string'],
            [['id_lokasi'], 'exist', 'skipOnError' => true, 'targetClass' => Lokasi::className(), 'targetAttribute' => ['id_lokasi' => 'id_lokasi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_d_lokasi' => Yii::t('app', 'Id D Lokasi'),
            'id_lokasi' => Yii::t('app', 'Id Lokasi'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasi()
    {
        return $this->hasOne(Lokasi::className(), ['id_lokasi' => 'id_lokasi']);
    }
}
