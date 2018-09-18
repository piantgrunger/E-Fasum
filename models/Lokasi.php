<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "tb_m_lokasi".
 *
 * @property int    $id_lokasi
 * @property int    $id_propinsi
 * @property int    $id_kota
 * @property int    $id_kecamatan
 * @property string $id_kelurahan
 * @property string $no_sertifikat
 * @property string $luas_tanah
 * @property string $nib
 * @property string $nama_sertifikat
 * @property string $tanggal_sertifikat
 * @property string $hak
 * @property string $alamat_lokasi
 * @property string $nama_perumahan
 * @property string $alamat_perumahan
 * @property string $nilai_satuan
 * @property string $total_nilai
 * @property string $asal_usul
 * @property string $pencatatan
 * @property string $latitude
 * @property string $longitude
 * @property int    $created_at
 * @property int    $updated_at
 */
class Lokasi extends \yii\db\ActiveRecord
{
    /*
     * {@inheritdoc}
     */
    public $old_gambar;
    public $old_gambar_pagar;
    public $old_gambar_pondasi;
    public $old_gambar_patok;
    public $old_gambar_papan_nama;
    public $file_dokumen;
    public $old_foto_dokumen;

    use \mdm\behaviors\ar\RelationTrait;

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
            [
                'class' => 'mdm\autonumber\Behavior',
                'attribute' => 'no_brankas', // required
                'group' => $this->id_barang, // optional
                'value' => 'SA.'.date('Y-m-d').'.?', // format auto number. '?' will be replaced with generated number
                'digit' => 4, // optional, default to null.
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
            [['id_propinsi', 'id_kota',  'luas_tanah',  'alamat_lokasi',  'nilai_satuan',
             'total_nilai', 'id_barang', 'dokumen_kepemilikan', 'asal_usul', 'pagar', 'papan_nama', 'patok', 'pondasi', ], 'required'],
            [['nama_perumahan'], 'required', 'when' => function ($model) {
                return $model->id_barang === 7;
            }, 'enableClientValidation' => false],
            [['no_sertifikat','nama_sertifikat'], 'required', 'when' => function ($model) {
                return $model->dokumen_kepemilikan !== 'Tanpa Dokumen';
            }, 'enableClientValidation' => false],

            [['id_propinsi', 'id_kota', 'id_kecamatan', 'id_kelurahan'], 'integer'],
            [['luas_tanah', 'nilai_satuan', 'total_nilai', 'latitude', 'longitude'], 'number'],
            [['tanggal_sertifikat', 'gambar', 'foto_dokumen', 'no_brankas'], 'safe'],
            [['gambar', 'gambar_pagar', 'gambar_pondasi', 'gambar_papan_nama', 'gambar_patok'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,bmp,jpeg', 'maxSize' => 512000000],
            [['file_dokumen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,bmp,jpeg', 'maxFiles' => 10],
            [['alamat_lokasi'], 'getNumber'],

            [['no_sertifikat', 'nib', 'nama_sertifikat', 'hak', 'alamat_lokasi', 'nama_perumahan', 'alamat_perumahan', 'asal_usul', 'pencatatan', 'penggunaan_tanah'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getNumber($attribute, $params)
    {
        if (is_null($this->no_brankas)) {
            $last = Lokasi::find()
          ->where(['id_barang' => $this->id_barang])
          ->andWhere(['<>', 'id_lokasi', $this->id_lokasi])
          ->orderBy(['no_brankas' => SORT_DESC])
          ->one();

            if (!is_null($last)) {
                $no = explode($this->kode_barang.'.', $last->no_brankas);
                $lastNo = is_numeric($no) && !is_null($no) ? $no + 1 : 1;
            } else {
                $lastNo = 1;
            }

            $this->no_brankas = $this->kode_barang.'.'.str_pad($lastNo, 4, '0', STR_PAD_LEFT);
        }
    }

    public function attributeLabels()
    {
        return [
            'id_lokasi' => Yii::t('app', 'Id Lokasi'),
            'id_propinsi' => Yii::t('app', 'Id Propinsi'),
            'id_kota' => Yii::t('app', 'Id Kota'),
            'id_kecamatan' => Yii::t('app', 'Id Kecamatan'),
            'id_kelurahan' => Yii::t('app', 'Id Kelurahan'),
            'no_sertifikat' => Yii::t('app', 'No Dokumen Kepemilikan'),
            'luas_tanah' => Yii::t('app', 'Luas (M2)'),
            'nib' => Yii::t('app', 'Nib'),
            'nama_sertifikat' => Yii::t('app', 'Atas Nama Dokumen Kepemilikan'),
            'tanggal_sertifikat' => Yii::t('app', 'Tanggal Dokumen Kepemilikan'),
            'hak' => Yii::t('app', 'Status Kepemilikan'),
            'alamat_lokasi' => Yii::t('app', 'Alamat Lokasi'),
            'nama_perumahan' => Yii::t('app', 'Nama Perumahan'),
            'alamat_perumahan' => Yii::t('app', 'Alamat Perumahan'),
            'nilai_satuan' => Yii::t('app', 'Nilai Satuan'),
            'total_nilai' => Yii::t('app', 'Total Nilai'),
            'asal_usul' => Yii::t('app', 'Asal Perolehan'),
            'gambar' => Yii::t('app', 'Foto Lokasi'),

            'pencatatan' => Yii::t('app', 'Pencatatan'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /* @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kecamatan' => 'id_kecamatan']);
    }

    public function getNama_kecamatan()
    {
        return ($this->kecamatan === null) ? '' : $this->kecamatan->nama_kecamatan;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kelurahan' => 'id_kelurahan']);
    }

    public function getNama_kelurahan()
    {
        return ($this->kelurahan === null) ? '' : $this->kelurahan->nama_kelurahan;
    }

    public function getDetailLokasi()
    {
        return $this->hasMany(Detlokasi::className(), ['id_lokasi' => 'id_lokasi']);
    }

    public function setDetailLokasi($value)
    {
        return $this->loadRelated('detailLokasi', $value);
    }

    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id_barang' => 'id_barang']);
    }

    public function getKode_barang()
    {
        return (is_null($this->barang)) ? '' : $this->barang->kode_barang;
    }

    public function getNama_barang()
    {
        return (is_null($this->barang)) ? '' : $this->barang->nama_barang;
    }
    public function getRegister()
    {
        substr($this->no_brankas, -4);
    }

    public function uploadDokumen()
    {
        $images = UploadedFile::getInstances($this, 'file_dokumen');

        if (count($images) > 0) {
            $path = Yii::getAlias('@app').'/web/media/';
            FileHelper::unlink($path.'*-'.md5($this->id_lokasi).'*');
            $this->foto_dokumen = '';

            $i = 0;
            foreach ($images as $image) {
                ++$i;
                if (!empty($image) && $image->size !== 0) {
                    $fileNames = $i.'-'.md5($this->id_lokasi).'.'.$image->extension;
                    if ($image->saveAs($path.$fileNames)) {
                        $this->foto_dokumen = $this->foto_dokumen.$fileNames.'&&';
                    } else {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function upload($fieldName)
    {
        $path = Yii::getAlias('@app').'/web/media/';
        $image = UploadedFile::getInstance($this, $fieldName);
        if (!empty($image) && $image->size !== 0) {
            $fileNames = $fieldName.md5($this->alamat_lokasi).'.'.$image->extension;
            if ($image->saveAs($path.$fileNames)) {
                $this->attributes = array($fieldName => $fileNames);

                return true;
            } else {
                return false;
            }
        } else {
            if ($fieldName === 'gambar') {
                $this->attributes = array($fieldName => $this->old_gambar);
            }
            if ($fieldName === 'gambar_pagar') {
                $this->attributes = array($fieldName => $this->old_gambar_pagar);
            }
            if ($fieldName === 'gambar_pondasi') {
                $this->attributes = array($fieldName => $this->old_gambar_pondasi);
            }
            if ($fieldName === 'gambar_patok') {
                $this->attributes = array($fieldName => $this->old_gambar_patok);
            }
            if ($fieldName === 'gambar_papan_nama') {
                $this->attributes = array($fieldName => $this->old_gambar_papan_nama);
            }

            return true;
        }
    }
}
