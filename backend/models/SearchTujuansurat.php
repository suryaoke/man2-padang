<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tujuansurat;

/**
 * SearchTujuansurat represents the model behind the search form of `backend\models\Tujuansurat`.
 */
class SearchTujuansurat extends Tujuansurat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_informasi_surat', 'status'], 'integer'],
            [['id_user'], 'safe'],
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
        $query = Tujuansurat::find();

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
            'id_informasi_surat' => $this->id_informasi_surat,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'id_user', $this->id_user]);

        return $dataProvider;
    }
}
