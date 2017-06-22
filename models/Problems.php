<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "problems".
 *
 * @property integer $id
 * @property integer $problem_group
 * @property integer $product_id
 * @property string $note
 */
class Problems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'problems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['problem_group', 'product_id', 'note'], 'required'],
            [['problem_group', 'product_id'], 'integer'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'problem_group' => Yii::t('app', 'Problem Group'),
            'product_id' => Yii::t('app', 'Product ID'),
            'note' => Yii::t('app', 'Note'),
        ];
    }

    public function getProblemsGroups(){
        return $this->hasMany(ProblemsGroups::className(), ['id'=>'problem_group']);
    }
}
