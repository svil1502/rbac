<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 *
 * @property Contracts[] $contracts
 * @property Requisites[] $requisites
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['id_company' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequisites()
    {
        return $this->hasMany(Requisites::className(), ['id_company' => 'id']);
    }



    public function getActs() {

        return $this->hasMany(Acts::className(), ['id' => 'id_contract'])
            ->viaTable(
                'Contracts',
                ['id_company' => 'companies.id'],
                function ($query) {
                    $query->andWhere(['acts.id_contract' => 'contracts.id']);
                });
    }
}
