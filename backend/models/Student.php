<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $fname
 * @property string $name
 * @property string|null $sname
 * @property int $group_id
 * @property string $photo
 *
 * @property Ocenka[] $ocenka
 * @property Group $group
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @var mixed|null
     */

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'name', 'group_id','photo'], 'required'],
            [['group_id'], 'integer'],
            [['fname', 'name', 'sname'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 250],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
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
            'group_id' => 'Группа',
            'photo' => 'Фото'
        ];
    }

    /**
     * Gets query for [[Ocenkas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOcenka()
    {
        return $this->hasMany(Ocenka::className(), ['student_id' => 'id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getMeanMark($predmetId) {
        $mean = 0;
        $count = 0;
        foreach ($this->ocenka as $oc) {
            if($oc->predmet_id == $predmetId){
                if ($oc->mark > 0) {
                    $mean += $oc->mark;
                    $count++;
                }

            }
        }
        if($count > 0){
            return $mean / $count;
        } else {
            return 0;
        }
        return $mean / $count;
    }

    public function getStudentLists($group_id){
        $query = Student::find()->where(['group_id' => $group_id])->all();
        return $query;
    }

    public function getFullName(){
        $fullName = $this->fname . ' ' . $this->name . ' ' . $this->sname;
        return $fullName;
    }
}