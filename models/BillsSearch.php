<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bills;

/**
 * BillsSearch represents the model behind the search form of `app\models\Bills`.
 */
class BillsSearch extends Bills
{
    /**
     * {@inheritdoc}
     */
    public $actsName;
    public $contractsName;

    public function rules()
    {
        return [
            [['id', 'id_contract', 'id_act', 'number', 'date'], 'integer'],
            [['contractsName'], 'safe'],
            [['actsName'], 'safe'],
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
        $query = Bills::find();

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
                'actsName' => [
                    'asc' => ['acts.number' => SORT_ASC],
                    'desc' => ['acts.number' => SORT_DESC],
                    'label' => 'Номер Акта'
                ],


            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['contracts']);
            $query->joinWith(['acts']);
            return $dataProvider;
        }



        // grid filtering conditions
        $query->andFilterWhere([
            'bills.id' => $this->id,
            'bills.id_contract' => $this->id_contract,
            'bills.id_act' => $this->id_act,
            'bills.number' => $this->number,
            'bills.date' => $this->date,
        ]);

        $query->andFilterWhere([
            'or',
            ['like', 'bills.number', $this->number],
            ['like', 'bills.date', $this->date],
        ]);

        $query->joinWith(['contracts' => function ($q) {
            $q->where('contracts.number LIKE "%' . $this->contractsName . '%"');
        }]);

        $query->joinWith(['acts' => function ($q) {
            $q->where('acts.number LIKE "%' . $this->actsName . '%"');
        }]);


        return $dataProvider;
    }
}
