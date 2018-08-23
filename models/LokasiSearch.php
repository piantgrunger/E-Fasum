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
            [['id_lokasi', 'status', 'created_at', 'updated_at'], 'integer'],
            [['nama_lokasi', 'jenis_lokasi', 'google_place_id', 'gps'], 'safe'],
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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_lokasi', $this->nama_lokasi])
            ->andFilterWhere(['like', 'jenis_lokasi', $this->jenis_lokasi])
            ->andFilterWhere(['like', 'google_place_id', $this->google_place_id])
            ->andFilterWhere(['like', 'gps', $this->gps]);

        return $dataProvider;
    }
}
