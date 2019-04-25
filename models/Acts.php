<?php

namespace app\models;

use Faker\Provider\Company;
use Yii;
use app\models\Companies;
use app\models\Contracts;
/**
 * This is the model class for table "acts".
 *
 * @property int $id
 * @property int $id_contract
 * @property int $number
 * @property int $date
 *
 * @property Contracts $contract
 * @property Bills[] $bills
 */
class Acts extends \yii\db\ActiveRecord
{
    protected $primaryKey = 'id';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_contract', 'number', 'date'], 'required'],
            [['id_contract', 'number', 'date'], 'integer'],
            [['id_contract'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::className(), 'targetAttribute' => ['id_contract' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_contract' => 'Номер договора',
            'contractsName' => 'Номер договора',
            'number' => 'Номер акта',
            'date' => 'Дата акта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasOne(Contracts::className(), ['id' => 'id_contract'])->with(['companies']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bills::className(), ['id_act' => 'id']);
    }




    /* Геттер для наименования договора */
    public function getContractsName() {
        return $this->Contracts->number;
    }


}

