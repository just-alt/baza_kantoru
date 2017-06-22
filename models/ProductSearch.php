<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year', 'count', 'shelf', 'available'], 'integer'],
            [['name', 'category', 'serial_number', 'note'], 'safe'],
            [['price_buy', 'price_internet', 'price_sell'], 'number'],
            [['manufacturer'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->where('available>0');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('categories');
        $query->joinWith('manufacturers');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'product.id' => $this->id,
            'year' => $this->year,
            'price_buy' => $this->price_buy,
            'price_internet' => $this->price_internet,
            'price_sell' => $this->price_sell,
            'count' => $this->count,
            'shelf' => $this->shelf,
            'available' => $this->available,
        ]);

        $query->andFilterWhere(['like', 'product.name', $this->name])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['or', ['like', 'categories.name', $this->category], ['=', 'category', $this->category]])
            ->andFilterWhere(['or', ['like', 'manufacturers.name', $this->manufacturer], ['=', 'manufacturer', $this->manufacturer]]);

        return $dataProvider;
    }
}
