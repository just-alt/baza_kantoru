<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $img_group
 * @property string $img_name
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'img_group', 'img_name'], 'required'],
            [['product_id'], 'integer'],
            [['img_group'], 'string', 'max' => 15],
            [['img_name'], 'string', 'max' => 255],
        ];
    }
}
