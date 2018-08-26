<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lokasi;

/**
 * LokasiSearch represents the model behind the search form of `app\models\Lokasi`.
 */
class LokasiSearch extends Lokasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lokasi', 'id_propinsi', 'id_kota', 'id_kecamatan', 'id_kelurahan', 'created_at', 'updated_at'], 'integer'],
            [['no_sertifikat', 'nib', 'nama_sertifikat', 'tanggal_sertifikat', 'hak', 'alamat_lokasi', 'nama_perumahan', 'alamat_perumahan', 'asal_usul', 'pencatatan'], 'safe'],
            [['luas_tanah', 'nilai_satuan', 'total_nilai', 'latitude', 'longitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Lokasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_lokasi' => $this->id_lokasi,
            'id_propinsi' => $this->id_propinsi,
            'id_kota' => $this->id_kota,
            'id_kecamatan' => $this->id_kecamatan,
            'id_kelurahan' => $this->id_kelurahan,
            'luas_tanah' => $this->luas_tanah,
            'tanggal_sertifikat' => $this->tanggal_sertifikat,
            'nilai_satuan' => $this->nilai_satuan,
            'total_nilai' => $this->total_nilai,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no_sertifikat', $this->no_sertifikat])
            ->andFilterWhere(['like', 'nib', $this->nib])
            ->andFilterWhere(['like', 'nama_sertifikat', $this->nama_sertifikat])
            ->andFilterWhere(['like', 'hak', $this->hak])
            ->andFilterWhere(['like', 'alamat_lokasi', $this->alamat_lokasi])
            ->andFilterWhere(['like', 'nama_perumahan', $this->nama_perumahan])
            ->andFilterWhere(['like', 'alamat_perumahan', $this->alamat_perumahan])
            ->andFilterWhere(['like', 'asal_usul', $this->asal_usul])
            ->andFilterWhere(['like', 'pencatatan', $this->pencatatan]);

        return $dataProvider;
    }
}
