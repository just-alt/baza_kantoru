<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category
 * @property integer $manufacturer
 * @property integer $year
 * @property string $name
 * @property double $price_buy
 * @property double $price_internet
 * @property double $price_sell
 * @property integer $count
 * @property string $serial_number
 * @property integer $shelf
 * @property string $note
 * @property mixed $categories
 * @property mixed $manufacturers
 * @property integer $available
 */
class Product extends ActiveRecord
{

    public $categoryName;
    public $manuf;
    public $attribute;
    public $problem;
    public $equipment;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'manufacturer', 'name'], 'required'],
            [['category', 'manufacturer', 'year', 'count', 'shelf', 'available'], 'integer'],
            [['price_buy', 'price_internet', 'price_sell'], 'number'],
            [['note'], 'string'],
            [['name', 'serial_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'year' => Yii::t('app', 'Year'),
            'name' => Yii::t('app', 'Name'),
            'price_buy' => Yii::t('app', 'Price Buy'),
            'price_internet' => Yii::t('app', 'Price Internet'),
            'price_sell' => Yii::t('app', 'Price Sell'),
            'count' => Yii::t('app', 'Count'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'shelf' => Yii::t('app', 'Shelf'),
            'note' => Yii::t('app', 'Note'),
            'available' => Yii::t('app', 'Available'),
        ];
    }

    public function getManufacturers()
    {
        return $this->hasMany(Manufacturers::className(), ['id' => 'manufacturer']);
    }

    public function getCategories(){
        return $this->hasMany(Categories::className(), ['id'=>'category']);
    }

    public function getShelfs(){
        return $this->hasMany(Shelfs::className(), ['id'=>'shelf']);
    }

    public function getProductAttributes(){
        return $this->hasMany(Attributes::className(), ['product_id'=>'id']);
    }

    public function getProductProblems(){
        return $this->hasMany(Problems::className(), ['product_id'=>'id']);
    }

    public function init()
    {
        if (!$this instanceof ProductSearch) {
            $this->count = 1;
            $this->available = 1;
        }
        parent::init();
    }

    /**
     * Gets manufacturer's name by id for views/product/view.php
     * @param $id
     *
     * @return string
     */
    public function getManufacturer($id){
        return Manufacturers::findOne($id)->name;
    }

    public function getAllAttributes($id){
        return Attributes::find()->where(['product_id'=>$id]);
    }

    public function getAllProblems($id){
        return Problems::find()->where(['product_id'=>$id]);
    }

    public function getAllEquipment($id){
        return Equipment::find()->where(['product_id'=>$id])->andWhere('availability=0');
    }

}
