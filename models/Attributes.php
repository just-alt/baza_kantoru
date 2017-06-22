<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "attributes".
 *
 * @property integer $id
 * @property integer $attr_group
 * @property string $name
 * @property integer $product_id
 */
class Attributes extends \yii\db\ActiveRecord
{

    public $attrGroup;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_group', 'name', 'product_id'], 'required'],
            [['attr_group', 'product_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'attr_group' => Yii::t('app', 'Attr Group'),
            'name' => Yii::t('app', 'Name'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    public function getAttributeGroups(){
        return $this->hasMany(AttributeGroups::className(),['id'=>'attr_group']);
    }

    public function getProducts(){
        return $this->hasMany(Product::className(), ['id'=>'product_id']);
    }
}
