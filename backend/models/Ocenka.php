<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ocenka".
 *
 * @property int $id
 * @property int $group_id
 * @property int $student_id
 * @property int $prepod_id
 * @property int $predmet_id
 * @property string $date
 * @property int $mark
 *
 * @property Student $group
 * @property Predmet $predmet
 * @property Prepod $prepod
 * @property Student $student
 */
class Ocenka extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ocenka';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'student_id', 'prepod_id', 'predmet_id', 'date', 'mark'], 'required'],
            [['group_id', 'student_id', 'prepod_id', 'predmet_id', 'mark'], 'integer'],
            [['date'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['predmet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Predmet::className(), 'targetAttribute' => ['predmet_id' => 'id']],
            [['prepod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prepod::className(), 'targetAttribute' => ['prepod_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'student_id' => 'Студент',
            'prepod_id' => 'Преподователь',
            'predmet_id' => 'Предмет',
            'date' => 'Дата',
            'mark' => 'Оценка/Присутствие',
        ];
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

    /**
     * Gets query for [[Predmet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPredmet()
    {
        return $this->hasOne(Predmet::className(), ['id' => 'predmet_id']);
    }

    /**
     * Gets query for [[Prepod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrepod()
    {
        return $this->hasOne(Prepod::className(), ['id' => 'prepod_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    public function getGroupLists($id){
        $query = Ocenka::find()->where(['group_id' => $id])->all();
        return $query;
    }

    public function getStudentGroupLists($id){
        $query = Student::find()->where(['group_id' => $id])->asArray()->all();
        return $query;
    }

    public function getPrepodPredemetLists($id){
        $query = Predmet::find()->where(['id' => $id])->asArray()->all();
        return $query;
    }

    /**
     * ocenka/index Gridview.filter.group
     * @return array
     */
    public function getFilterColumnToGroup(){
        $query = Group::find()->indexBy('id')->column();
        return $query;
    }

    /**
     * ocenka/index Gridview.filter.student
     * @return array
     */
    public function getFilterColumnToStudent(){
        $query = Student::find()->indexBy('id')->column();
        return $query;
    }

    /**
     * ocenka/index Gridview.filter.prepod
     * @return array
     */
    public function getFilterColumnToPrepod(){
        $query = Prepod::find()->indexBy('id')->column();
        return $query;
    }

    /**
     * ocenka/index Gridview.filter.predmet
     * @return array
     */
    public function getFilterColumnToPredmet(){
        $query = Predmet::find()->indexBy('id')->column();
        return $query;
    }
}