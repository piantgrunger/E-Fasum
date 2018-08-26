<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "tb_m_kecamatan".
 *
 * @property int $id_kecamatan
 * @property int $id_kota
 * @property string $nama_kecamatan
 *
 * @property TbMKota $kota
 * @property TbMKelurahan[] $tbMKelurahans
 * @property TbMtResi[] $tbMtResis
 * @property TbMtResi[] $tbMtResis0
 */
class Kecamatan extends \yii\db\ActiveRecord
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
        return 'tb_m_kecamatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kota', 'nama_kecamatan'], 'required'],
            [['id_kota'], 'integer'],
            [['nama_kecamatan'], 'string', 'max' => 50],
            [['id_kota'], 'exist', 'skipOnError' => true, 'targetClass' => Kota::className(), 'targetAttribute' => ['id_kota' => 'id_kota']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kecamatan' => 'Id Kecamatan',
            'id_kota' => 'Id Kota',
            'nama_kecamatan' => 'Nama Kecamatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKota()
    {
        return $this->hasOne(Kota::className(), ['id_kota' => 'id_kota']);
    }
    
    public static function getDataBrowseKecamatan($id_kota)
    {        
        $data=Kecamatan::find()
            ->select([
           'id'=>'id_kecamatan','name'=>'nama_kecamatan'
           ])
           ->where(['id_kota'=>$id_kota])
           ->asArray()      
           ->all();

     foreach ($data as $i => $list) 
     {
        $out[] = ['id' => $list['id'], 'name' => $list['name']];
      }
      return $out;  
    }
 
}
