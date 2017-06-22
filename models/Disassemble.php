<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disassemble".
 *
 * @property integer $id
 * @property integer $manuf_id
 * @property string $model
 * @property string $note
 */
class Disassemble extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disassemble';
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $images = new ImagesUpload();
            $images->deleteImages(Yii::$app->controller->id, $this->id);
        }
        return parent::beforeDelete();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dis_group', 'manuf_id', 'model'], 'required'],
            [['dis_group', 'manuf_id'], 'integer'],
            [['note'], 'string'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'manuf_id' => Yii::t('app', 'Manuf ID'),
            'dis_group' => Yii::t('app', 'Dis Group'),
            'model' => Yii::t('app', 'Model'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
