<?php
/**
 * Created by PhpStorm.
 * User: alt
 * Date: 07.06.2017
 * Time: 15:36
 */

namespace app\models;


use yii\data\ActiveDataProvider;

class GlobalSearch
{
    /**
     * Searching product in every useful column
     *
     * @param $query
     *
     * @return ActiveDataProvider
     */
    public function searchProduct($query)
    {
        $q = Product::find()->where('available>0');
        $d = Disassemble::find();

        $q->select([
            'product.id',
            'product.name',
            'problems.note as problem',
            'manufacturers.name as manuf',
            'categories.name as categoryName',
            'attributes.name as attribute'
        ]);

        $q->joinWith('manufacturers');
        $q->joinWith('shelfs');
        $q->joinWith('categories');
        $q->joinWith('productAttributes');
        $q->joinWith('productProblems');

        $q->andFilterWhere(['or',
            ['=', 'product.id', $query],
            ['like', 'product.name', $query],
            ['like', 'manufacturer', $query],
            ['like', 'shelf', $query],
            ['like', 'manufacturers.name', $query],
            ['like', 'shelfs.name', $query],
            ['like', 'categories.name', $query],
            ['like', 'attributes.name', $query],
            ['like', 'problems.note', $query],
            ]);


        $dataProvider = new ActiveDataProvider([
            'query' => $q,
        ]);

        return $dataProvider;
    }

    public function searchDisassemble($query){
        $q = Attributes::find();

    }
}