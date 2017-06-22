<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.04.2017
 * Time: 1:35
 */

namespace app\models;


use yii\base\Model;
use yii\db\Expression;

class Export extends Model
{
    public $categories;
    public $id;
    public $manufacturer;
    public $category;
    public $model;
    public $attributes;
    public $problems;
    public $equipment;
    public $price;
    public $note;

    public function rules()
    {
        return [
            [['categories'], 'required']
        ];
    }

    /**
     * Returns array of categories
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategories()
    {
        return Categories::find()->all();
    }

    /**
     * Returns array with product info/attributes/problems/equipment
     *
     * @param $categories array of categories
     *
     * @return array
     */
    public function getProductsByCategory($categories)
    {
        $products = [];
        foreach ($categories as $category) {
            $categoryName = Categories::findOne($category)->name;

            $products[$categoryName] = Product::findBySql(
                'SELECT p.id, p.name, m.name as manuf,
(SELECT GROUP_CONCAT(ag.name, ": ", a.name SEPARATOR ";\n") FROM attributes a JOIN attribute_groups ag ON ag.id=a.attr_group WHERE a.product_id=p.id) AS attribute,
(SELECT GROUP_CONCAT(pg.name, ": ", pr.note SEPARATOR ";\n") FROM problems pr JOIN problems_groups pg ON pg.id=pr.problem_group WHERE pr.product_id=p.id) AS problem,
(SELECT GROUP_CONCAT(eg.name SEPARATOR ";\n") FROM equipment eq JOIN equipment_groups eg ON eg.id=eq.eq_group WHERE eq.product_id=p.id) AS equipment
FROM product p JOIN manufacturers m ON m.id=p.manufacturer 
WHERE category='.$category.' AND available>0'
            )->all();
        }

        return $products;
    }

    /**
     * Get all motherboards from disassemble
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getMotherboards()
    {
        $query = Disassemble::find()->select('d.id, m.name as manufacturer, d.model, d.note, dg.name as dis_group')
            ->from('disassemble d')
            ->leftJoin('manufacturers m', 'm.id=d.manuf_id')
            ->leftJoin('disassemble_groups dg', 'dg.id=d.dis_group')
            ->where('d.dis_group in (1,20)')
            ->orderBy('dis_group')
            ->asArray()
            ->all();

        return $query;
    }


    public function attributeLabels()
    {
        return [
            'categories'=>\Yii::t('app', "Categories")
        ];
    }
}