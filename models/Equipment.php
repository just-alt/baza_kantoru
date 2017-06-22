<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property integer $id
 * @property integer $eq_group
 * @property integer $availability
 * @property integer $product_id
 */
class Equipment extends \yii\db\ActiveRecord
{

    public $eqGroup;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eq_group', 'availability', 'product_id'], 'integer'],
            [['product_id'], 'required'],
        ];
    }

    public function init()
    {
        if (!$this instanceof EquipmentSearch){
            $this->availability=0;
        }
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'eq_group' => Yii::t('app', 'Eq Group'),
            'availability' => Yii::t('app', 'Availability'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id'=>'product_id']);
    }

    public function getEquipmentGroups(){
        return $this->hasMany(EquipmentGroups::className(), ['id'=>"eq_group"]);
    }
}
