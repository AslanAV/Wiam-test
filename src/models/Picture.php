<?php

namespace app\models;

use yii\base\Model;

/**
 * This is the model class for table "pictures".
 *
 * @property int $id
 * @property int $picture_id
 * @property string|null $decision
 * @property string|null $created_at
 * @property string|null $update_at
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pictures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['picture_id', 'decision'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picture_id' => 'PictureId',
            'decision' => 'Decision',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }
}
