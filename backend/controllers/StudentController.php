<?php

namespace backend\controllers;

use backend\models\Ocenka;
use backend\models\Predmet;
use Yii;
use backend\models\student;
use backend\models\StudentSearch;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile as WebUploadedFile;

/**
 * StudentController implements the CRUD actions for student model.
 */
class StudentController extends Controller
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
     * Lists all student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single student model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $allMarks = [];
        $predmet = [];
        $mean = 0;
        foreach ($model->ocenka as $oc) {
            if ($oc->mark > 0) {
                $allMarks[] = [
                    "Предмет" => $oc->predmet->name,
                    "Дата" => $oc->date,
                    "Оценка" => $oc->mark
                ];
                $predmet[
                $oc->predmet_id
                ] = 0;
            }
        }

        $allMarksProvider = new ArrayDataProvider([
            'allModels' => $allMarks,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => ['Дата'],
            ],
        ]);

        $allMeanMarks = [];
        foreach ($predmet as $predmetId=>$value) {
            $allMeanMarks[] = [
                "Предмет"=>Predmet::findOne(['id'=>$predmetId])->name,
                "Средняя оценка" => round($model->getMeanMark($predmetId),2)
            ];
            $mean += $model->getMeanMark($predmetId);
        }

        $allMarksMeanProvider = new ArrayDataProvider([
            'allModels' => $allMeanMarks,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => ['Предмет'],
            ],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'allMarksProvider' => $allMarksProvider,
            'allMeanMarksProvider' => $allMarksMeanProvider,
            'mean'=>  count($allMeanMarks) > 0 ? round($mean/count($allMeanMarks), 2) :0
        ]);
    }

    /**
     * Creates a new student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new student();

        $file = WebUploadedFile::getInstance($model, 'photo');
        if ($model->load(Yii::$app->request->post())) {
            if ($file) {
                $photoname= uniqid($model->name) . $file->baseName . '.' . $file->extension;
                $file->saveAs(Yii::getAlias('@backend/web') . '/uploads/' . $photoname);
                $model->photo = $photoname;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing student model.
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
     * Finds the student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}