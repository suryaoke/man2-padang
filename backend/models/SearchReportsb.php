<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Reportsb;

/**
 * SearchReportsb represents the model behind the search form of `backend\models\Reportsb`.
 */
class SearchReportsb extends Reportsb
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_naskah_dinas'], 'integer'],
            [['tujuan_surat', 'perihal', 'nomor_agenda', 'tanggal_surat', 'no_surat', 'status', 'kirim_at'], 'safe'],
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
        $query = Reportsb::find();

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
            'id' => $this->id,
            'id_naskah_dinas' => $this->id_naskah_dinas,
            'kirim_at' => $this->kirim_at,
        ]);

        $query->andFilterWhere(['like', 'tujuan_surat', $this->tujuan_surat])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'nomor_agenda', $this->nomor_agenda])
            ->andFilterWhere(['like', 'tanggal_surat', $this->tanggal_surat])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
