<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use app\models\dataBase\Users;
use app\models\forms\TransferForm;

/**
 * UserTransfer is the model behind the contact form.
 */
class UserTransfer extends Model
{


    public static function transferBalance(TransferForm $model)
    {
        if (!$model instanceof TransferForm) {
            throw new Exception('"$model" It is not an instance of the class "ShortUrlForm"');
        }

        $oGetUserFrom = Users::find()->where(['id' => $model->userFrom])->one();
        $oGetUserTo = Users::find()->where(['id' => $model->userTo])->one();
        $oGetUserFrom->balance = $oGetUserFrom->balance - $model->sum;


        if ($oGetUserFrom->update()) {
            $oGetUserTo->balance = $oGetUserTo->balance + $model->sum;
            if ($oGetUserTo->update()) {
                Yii::$app->getSession()->setFlash('success', $oGetUserFrom->name . ' has been successfully transferred an amount of ' . $model->sum . ' from the ' . $oGetUserTo->name);
                return true;
            }
        }
        throw new Exception('Error');
    }


}
