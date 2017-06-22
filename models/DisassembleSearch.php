<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Disassemble;

/**
 * DisassembleSearch represents the model behind the search form about `app\models\Disassemble`.
 */
class DisassembleSearch extends Disassemble
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dis_group', 'manuf_id'], 'integer'],
            [['model', 'note'], 'safe'],
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
        $query = Disassemble::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dis_group' => $this->dis_group,
            'manuf_id' => $this->manuf_id,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
