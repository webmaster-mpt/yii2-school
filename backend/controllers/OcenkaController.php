<?php

namespace backend\controllers;

use backend\models\Group;
use backend\models\GroupSearch;
use Yii;
use backend\models\ocenka;
use backend\models\OcenkaSearch;
use backend\models\Predmet;
use backend\models\Prepod;
use backend\models\Student;
use Codeception\Util\Stub;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * OcenkaController implements the CRUD actions for ocenka model.
 */
class OcenkaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ocenka models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OcenkaSearch();
        $model = new Ocenka();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $group = $model->getFilterColumnToGroup();
        $student = $model->getFilterColumnToStudent();
        $prepod = $model->getFilterColumnToPrepod();
        $predmet = $model->getFilterColumnToPredmet();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'group' => $group,
            'student' => $student,
            'prepod ' => $prepod ,
            'predmet' => $predmet
        ]);
    }

    /**
     * Displays a single ocenka model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ocenka model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ocenka();

        $groups = ArrayHelper::map(Group::find()->all(), 'id', 'name');
        $prepods = ArrayHelper::map(Prepod::find()->all(), 'id', 'fullName');
        $predmets = Predmet::find()->select(['name','id'])->indexBy('id')->column();
        $items = ['0' => '-','1' => 'НБ','2'=>'2 - БЫВАЕТ','3'=> '3 - НАМАНА','4'=>'4 - ХАРОЩО','5'=>'5 - КРАСИВО'];
        $studs = Student::findBySql("SELECT concat(student.fname, ' ', student.name) AS fullname, id FROM `Student`")->indexBy('id')->column();
        $model->date = date('Y-m-d');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'groups' => $groups,
            'prepods' => $prepods,
            'predmets' => $predmets,
            'studs' => $studs,
            'items' => $items,
        ]);
    }

    public function actionLists($group_id)
    {
        $model = new Ocenka();
        $prepods = $model->getStudentGroupLists($group_id);

        if(sizeof($prepods) >0){
            echo "<option>Выбрать студента</option>";
            foreach($prepods as $model){
                echo "<option value='".$model['id']."'>".$model['fname']. ' ' .$model['name']. ' ' .$model['sname']."</option>";
            }
        }
        else{
            echo "<option>Выбрать студента</option><option></option>";
        }
    }

    public function actionPredmets($prepod_id)
    {
        $model = new Ocenka();
        $predmets = $model->getPrepodPredemetLists($prepod_id);

        if(sizeof($predmets) >0){
            echo "<option>Выбрать преподавателя</option>";
            foreach($predmets as $model){
                echo "<option value='".$model['id']."'>".$model['fname']. ' ' .$model['name']. ' ' .$model['sname']."</option>";
            }
        }
        else{
            echo "<option>Выбрать преподавателя</option><option></option>";
        }
    }

    /**
     * Updates an existing ocenka model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $groups = ArrayHelper::map(Group::find()->all(), 'id', 'name');
        $prepods = ArrayHelper::map(Prepod::find()->all(), 'id', 'fullName');
        $predmets = Predmet::find()->select(['name','id'])->indexBy('id')->column();
        $items = ['0' => '-','1' => 'НБ','2'=>'2 - БЫВАЕТ','3'=> '3 - НАМАНА','4'=>'4 - ХАРОЩО','5'=>'5 - КРАСИВО'];
        $studs = Student::findBySql("SELECT concat(student.fname, ' ', student.name) AS fullname, id FROM `Student`")->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'groups' => $groups,
            'predmets' => $predmets,
            'prepods' => $prepods,
            'studs' => $studs,
            'items' => $items,
        ]);
    }

    /**
     * Deletes an existing ocenka model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ocenka model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ocenka the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ocenka::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}