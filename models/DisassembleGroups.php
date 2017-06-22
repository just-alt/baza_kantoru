<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disassemble_groups".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Disassemble[] $disassembles
 */
class DisassembleGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disassemble_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisassembles()
    {
        return $this->hasMany(Disassemble::className(), ['dis_group' => 'id']);
    }
}
