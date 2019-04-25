<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Requisites;

/**
 * RequisitesSearch represents the model behind the search form of `app\models\Requisites`.
 */
class RequisitesSearch extends Requisites
{
    public $companiesName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_company', 'requisites_default'], 'integer'],
            [['req'], 'safe'],
            [['companiesName'], 'safe'],
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
        $query = Requisites::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([
            'attributes' => [
                'id',
                'req',
                'requisites_default',
                'companiesName' => [
                    'asc' => ['companies.name' => SORT_ASC],
                    'desc' => ['companies.name' => SORT_DESC],
                    'label' => 'Компания'
                ],

            ]
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['companies']);
            return $dataProvider;

        }





        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_company' => $this->id_company,
            'requisites_default' => $this->requisites_default,
        ]);

        $query->andFilterWhere(['like', 'req', $this->req]);
        $query->joinWith(['companies' => function ($q) {
            $q->where('companies.name LIKE "%' . $this->companiesName . '%"');
        }]);
        return $dataProvider;
    }
}
