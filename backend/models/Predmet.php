<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "predmet".
 *
 * @property int $id
 * @property string $name
 *
 * @property Ocenka[] $ocenkas
 * @property Prepod[] $prepods
 */
class Predmet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'predmet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
     * Gets query for [[Ocenkas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOcenkas()
    {
        return $this->hasMany(Ocenka::className(), ['predmet_id' => 'id']);
    }

    /**
     * Gets query for [[Prepods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrepods()
    {
        return $this->hasMany(Prepod::className(), ['predmet_id' => 'id']);
    }

    public function getPrepodLists($predmet_id)
    {
        $query = Prepod::find()->where(['predmet_id' => $predmet_id])->all();
        return $query;
    }
}