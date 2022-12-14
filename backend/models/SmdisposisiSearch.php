<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Smdisposisi;

/**
 * SmdisposisiSearch represents the model behind the search form of `backend\models\Smdisposisi`.
 */
class SmdisposisiSearch extends Smdisposisi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sm_disposisi', 'id_sm', 'id_pengirim', 'id_penerima'], 'integer'],
            [['isi', 'kirim_at', 'status'], 'safe'],
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
        $query = Smdisposisi::find();

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
            'id_sm_disposisi' => $this->id_sm_disposisi,
            'id_sm' => $this->id_sm,
            'id_pengirim' => $this->id_pengirim,
            'kirim_at' => $this->kirim_at,
            'id_penerima' => $this->id_penerima,
        ]);

        $query->andFilterWhere(['like', 'isi', $this->isi])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
