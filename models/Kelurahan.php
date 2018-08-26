<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "tb_m_kelurahan".
 *
 * @property string $id_kelurahan
 * @property int $id_Kelurahan
 * @property string $nama_kelurahan
 *
 * @property TbMKelurahan $Kelurahan
 * @property TbMtResi[] $tbMtResis
 * @property TbMtResi[] $tbMtResis0
 */
class Kelurahan extends \yii\db\ActiveRecord
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
        return 'tb_m_kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kelurahan', 'id_Kelurahan', 'nama_kelurahan'], 'required'],
            [['id_kelurahan', 'id_Kelurahan'], 'integer'],
            [['nama_kelurahan'], 'string', 'max' => 50],
            [['id_Kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['id_Kelurahan' => 'id_Kelurahan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kelurahan' => 'Id Kelurahan',
            'id_Kelurahan' => 'Id Kelurahan',
            'nama_kelurahan' => 'Nama Kelurahan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id_Kelurahan' => 'id_Kelurahan']);
    }

    public static function getDataBrowseKelurahan($id_kecamatan)
    {        
        $data=Kelurahan::find()
            ->select([
           'id'=>'id_kelurahan','name'=>'nama_kelurahan'
           ])
           ->where(['id_kecamatan'=>$id_kecamatan])
           ->asArray()      
           ->all();

     foreach ($data as $i => $list) 
     {
        $out[] = ['id' => $list['id'], 'name' => $list['name']];
      }
      return $out;  
    }
 }
