<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Events;

/**
 * EventsSearch represents the model behind the search form of `app\models\Events`.
 */
class EventsSearch extends Events
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'person_type', 'event_type', 'orther', 'result', 'note', 'backup_to', 'backup_type', 'reporter', 'created_by', 'updated_by'], 'integer'],
            [['ref', 'data_json', 'fname', 'lname', 'fullname', 'department', 'address', 'phone', 'event_date', 'event_location_note', 'lat', 'lng', 'work_img', 'docs', 'worker', 'updated_at', 'created_at'], 'safe'],
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
        $query = Events::find();

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
            'person_type' => $this->person_type,
            'event_date' => $this->event_date,
            'event_type' => $this->event_type,
            'orther' => $this->orther,
            'result' => $this->result,
            'note' => $this->note,
            'backup_to' => $this->backup_to,
            'backup_type' => $this->backup_type,
            'reporter' => $this->reporter,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'data_json', $this->data_json])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'event_location_note', $this->event_location_note])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lng', $this->lng])
            ->andFilterWhere(['like', 'work_img', $this->work_img])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'worker', $this->worker]);

        return $dataProvider;
    }
}
