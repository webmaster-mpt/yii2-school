<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prepod".
 *
 * @property int $id
 * @property string $fname
 * @property string $name
 * @property string|null $sname
 * @property int $predmet_id
 *
 * @property Ocenka[] $ocenkas
 * @property Predmet $predmet
 */
class Prepod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prepod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'name', 'predmet_id'], 'required'],
            [['predmet_id'], 'integer'],
            [['fname', 'name', 'sname'], 'string', 'max' => 255],
            [['predmet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Predmet::className(), 'targetAttribute' => ['predmet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Фамилия',
            'name' => 'Имя',
            'sname' => 'Отчество',
            'predmet_id' => 'Предмет',
        ];
    }

    /**
     * Gets query for [[Ocenkas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOcenkas()
    {
        return $this->hasMany(Ocenka::className(), ['prepod_id' => 'id']);
    }

    /**
     * Gets query for [[Predmet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPredmet()
    {
        return $this->hasOne(Predmet::className(), ['id' => 'predmet_id']);
    }

    public function getPredmets($id)
    {
        $query = Prepod::find()
            ->where(['id' => $id])
            ->groupBy('predmet_id')
            ->all();
        return $query;
    }

    public function getFullName(){
        $fullName = $this->fname . ' ' . $this->name . ' ' . $this->sname;
        return $fullName;
    }
}