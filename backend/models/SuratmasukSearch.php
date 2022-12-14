<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Suratmasuk;

/**
 * SuratmasukSearch represents the model behind the search form of `backend\models\Suratmasuk`.
 */
class SuratmasukSearch extends Suratmasuk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sm'], 'integer'],
            [['asal_surat', 'perihal', 'tanggal_surat', 'nama', 'no_surat', 'file', 'tujuan', 'status', 'kirim_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Suratmasuk::find();

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
            'id_sm' => $this->id_sm,
            'tanggal_surat' => $this->tanggal_surat,
            'kirim_at' => $this->kirim_at,
        ]);

        $query->andFilterWhere(['like', 'asal_surat', $this->asal_surat])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
