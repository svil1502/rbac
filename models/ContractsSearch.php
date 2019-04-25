<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contracts;

/**
 * ContractsSearch represents the model behind the search form of `app\models\Contracts`.
 */
class ContractsSearch extends Contracts
{
    public $companiesName;
    public $requisitesName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_company', 'id_requisites', 'number', 'date'], 'integer'],
            [['companiesName'], 'safe'],
            [['requisitesName'], 'safe'],
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
        $query = Contracts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([
            'attributes' => [
                'id',

                'companiesName' => [
                    'asc' => ['companies.name' => SORT_ASC],
                    'desc' => ['companies.name' => SORT_DESC],
                    'label' => 'Компания'
                ],
                'requisitesName' => [
                    'asc' => ['requisites.req' => SORT_ASC],
                    'desc' => ['requisites.req' => SORT_DESC],
                    'label' => 'Реквизиты'
                ],
                'number',
                'date',
            ]
        ]);


        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['companies']);
            $query->joinWith(['requisites']);
            return $dataProvider;

        }




        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_company' => $this->id_company,
            'id_requisites' => $this->id_requisites,
            'date' => $this->date,
        ]);
        $query->andFilterWhere(['like', 'number', $this->number]);
        $query->joinWith(['companies' => function ($q) {
            $q->where('companies.name LIKE "%' . $this->companiesName . '%"');
        }]);
        $query->joinWith(['requisites' => function ($q_r) {
            $q_r->where('requisites.req LIKE "%' . $this->requisitesName . '%"');
        }]);
        return $dataProvider;
    }
}
