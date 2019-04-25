<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acts;

/**
 * ActsSearch represents the model behind the search form of `app\models\Acts`.
 */
class ActsSearch extends Acts
{
    /**
     * {@inheritdoc}
     */
    public $contractsName;

    public function rules()
    {
        return [
            [['id', 'id_contract', 'number', 'date'], 'integer'],
            [['number'], 'safe'],
            [['date'], 'safe'],
            [['contractsName'], 'safe'],
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
        $query = Acts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'number',
                'date',
                'contractsName' => [
                    'asc' => ['contracts.number' => SORT_ASC],
                    'desc' => ['contracts.number' => SORT_DESC],
                    'label' => 'Номер Договора'
                ],


            ]
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['contracts']);
            return $dataProvider;
        }





        // grid filtering conditions
        $query->andFilterWhere([
            'acts.id' => $this->id,
            'acts.id_contract' => $this->id_contract,
            'acts.date' => $this->date,
            'acts.number' => $this->number,

        ]);


        $query->andFilterWhere([
            'or',
            ['like', 'acts.number', $this->number],
            ['like', 'acts.date', $this->date],
        ]);

        $query->joinWith(['contracts' => function ($q) {
            $q->where('contracts.number LIKE "%' . $this->contractsName . '%"');
        }]);

        return $dataProvider;
    }
}
