<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisites".
 *
 * @property int $id
 * @property int $id_company
 * @property string $req
 * @property int $requisites_default
 *
 * @property Contracts[] $contracts
 * @property Companies $company
 */
class Requisites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'id';

    public static function tableName()
    {
        return 'requisites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_company'], 'required'],
            [['id_company', 'requisites_default'], 'integer'],
            [['req'], 'string'],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['id_company' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_company' => 'Компания',
            'companiesName' => 'Компания',

            'req' => 'Реквизиты',
            'requisites_default' => 'Использовать по умолчанию',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['id_requisites' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['id' => 'id_company']);
    }

    /* Геттер для наименования компании */
    public function getCompaniesName() {
        return $this->Companies->name;
    }


}
