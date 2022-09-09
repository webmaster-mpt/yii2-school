<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string|null $name
 */
class Subject extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Studclasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudclasses()
    {
        return $this->hasMany(Studclass::className(), ['id_subject' => 'id']);
    }
}
