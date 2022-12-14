<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Informasisurat;

/**
 * InformasisuratSearch represents the model behind the search form of `backend\models\Informasisurat`.
 */
class InformasisuratSearch extends Informasisurat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_naskah_dinas'], 'integer'],
            [['tujuan_surat', 'perihal', 'nomor_agenda', 'tanggal_surat', 'no_surat', 'status'], 'safe'],
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
        $query = Informasisurat::find();

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
            'tanggal_surat' => $this->tanggal_surat,
        ]);

        $query->andFilterWhere(['like', 'tujuan_surat', $this->tujuan_surat])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'nomor_agenda', $this->nomor_agenda])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
