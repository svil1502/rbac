<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contracts".
 *
 * @property int $id
 * @property int $id_company
 * @property int $id_requisites
 * @property int $number
 * @property int $date
 *
 * @property Acts[] $acts
 * @property Bills[] $bills
 * @property Requisites $requisites
 * @property Companies $company
 */
class Contracts extends \yii\db\ActiveRecord
{
    protected $primaryKey = 'id';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_company', 'id_requisites', 'number', 'date'], 'required'],
            [['id_company', 'id_requisites', 'number', 'date'], 'integer'],
            [['id_requisites'], 'exist', 'skipOnError' => true, 'targetClass' => Requisites::className(), 'targetAttribute' => ['id_requisites' => 'id']],
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
            'id_requisites' => 'Реквизиты',
            'requisitesName' => 'Реквизиты',
            'number' => 'Номер',
            'date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActs()
    {
        return $this->hasMany(Acts::className(), ['id_contract' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bills::className(), ['id_contract' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequisites()
    {
        return $this->hasOne(Requisites::className(), ['id' => 'id_requisites']);
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

    /* Геттер для наименования реквизитов req */
    public function getRequisitesName() {
        return $this->Requisites->req;
    }



}
