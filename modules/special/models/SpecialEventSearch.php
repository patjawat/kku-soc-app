<?php

namespace app\modules\special\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\special\models\SpecialEvent;

/**
 * SpecialEventSearch represents the model behind the search form of `app\modules\special\models\SpecialEvent`.
 */
class SpecialEventSearch extends SpecialEvent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'special_event_id'], 'integer'],
            [['ref', 'data_json', 'special_date', 'location', 'title'], 'safe'],
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
        $query = SpecialEvent::find();

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
            'special_date' => $this->special_date,
            'special_event_id' => $this->special_event_id,
        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'data_json', $this->data_json])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
