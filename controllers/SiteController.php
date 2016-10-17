<?php

namespace app\controllers;

use app\models\UserTransfer;
use Yii;
use yii\web\Controller;
use app\models\forms\TransferForm;
use app\models\dataBase\Users;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

class SiteController extends Controller
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (Yii::$app->request->post()) {
            $modelTransferForm = new TransferForm();
            if ($modelTransferForm->load(Yii::$app->request->post())) {
                if ($modelTransferForm->checkValidate()) {
                    if (UserTransfer::transferBalance($modelTransferForm)) {
                        return $this->refresh();
                    }
                }

            }

        }
        $model = new TransferForm();
        $aUsers = ArrayHelper::map(Users::find()->all(), 'id', 'name');
        return $this->render('index', [
            'model' => $model, 'users' => $aUsers
        ]);
    }


    public function actionGetUserLists($id)
    {
        if (is_null(Users::find()->where(['id' => $id])->one())) {
            throw new Exception('The user is not found in the database');
        }

        $aUsers = Users::find()->where(['<>', 'id', $id])->all();
        if (!is_null($aUsers)) {
            foreach ($aUsers as $aUser) {
                echo "<option value='" . $aUser->id . "'>" . $aUser->name . "</option>";
            }
        } else {
            echo "<option> - </option>";
        }


    }

    public function actionTest()
    {
        $oGetUserFrom = Users::find()->where(['id' => 1])->one();


        echo $oGetUserFrom->balance;
    }
}
