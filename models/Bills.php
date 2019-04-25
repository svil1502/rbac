<?php

namespace app\models;

use Yii;
//use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "bills".
 *
 * @property int $id
 * @property int $id_contract
 * @property int $id_act
 * @property int $number
 * @property int $date
 *
 * @property Contracts $contract
 * @property Acts $act
 */
class Bills extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'id';

//    public function behaviors()
//    {
//        return [
//            'timestamp' => [
//                'class' => TimestampBehavior::className(),
//                'attributes' => [
//                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'date',
//                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'date',
//                ],
//                'value' => function() { return date('U');   // unix timestamp
//                   },
//                    ],
//                    ];
//
//    }


    public static function tableName()
    {
        return 'bills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
         //   [['date'], 'date', 'format' => 'php:d.m.yy'],
         //   [['date'], 'date', 'format' => 'php:d-m-Y', 'timestampAttribute' => 'date'],
            [['id_contract', 'id_act', 'number', 'date'], 'required'],
            [['id_contract', 'id_act', 'number'], 'integer'],
            [['id_contract'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::className(), 'targetAttribute' => ['id_contract' => 'id']],
            [['id_act'], 'exist', 'skipOnError' => true, 'targetClass' => Acts::className(), 'targetAttribute' => ['id_act' => 'id']],
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
            'id_act' => 'Номер акта',
            'actsName' => 'Номер акта',
            'number' => 'Номер счета',
            'date' => 'Дата счета',
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
    public function getActs()
    {
        return $this->hasOne(Acts::className(), ['id' => 'id_act']);
    }

    /* Геттер для наименования договора */
    public function getContractsName() {
        return $this->Contracts->number;
    }
    /* Геттер для наименования акта */
    public function getActsName() {
        return $this->Acts->number;
    }
}
