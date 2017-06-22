<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attributes;

/**
 * AttributesSearch represents the model behind the search form about `app\models\Attributes`.
 */
class AttributesSearch extends Attributes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'attr_group', 'product_id'], 'safe'],
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
        $query = Attributes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith('attributeGroups');
        $query->joinWith('products');


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'attr_group' => $this->attr_group,
//            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'attributes.name', $this->name])
            ->andFilterWhere(['or', ['like', 'attribute_groups.name', $this->attr_group], ['=', 'attr_group', $this->attr_group]])
            ->andFilterWhere(['or', ['like', 'product.name', $this->product_id], ['=', 'product_id', $this->product_id]]);

        return $dataProvider;
    }
}
