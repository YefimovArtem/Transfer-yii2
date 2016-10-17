<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use app\models\dataBase\Users;

/**
 * TransferForm is the model behind the contact form.
 */
class TransferForm extends Model
{
    public $userFrom;
    public $userTo;
    public $sum;
    public $aErrorMessage = [];


    /**
     * @return array the validation rules.
     */
    public function rules()
    {

        return [
            [['userFrom', 'userTo', 'sum'], 'required'],
            [['sum'], 'match', 'pattern' => '/^[0-9]{1,12}(\.[0-9]{0,2})?$/']
        ];
    }


    public function checkValidate()
    {
        $oGetUserFrom = Users::find()->where(['id' => $this->userFrom])->one();
        $oGetUserTo = Users::find()->where(['id' => $this->userTo])->one();
        if (is_null($oGetUserFrom) && is_null($oGetUserTo)) {

            throw new Exception('The user is not found in the database');
        }

        if ($oGetUserFrom->balance < $this->sum) {
            Yii::$app->getSession()->setFlash('danger', 'Insufficient funds for transaction');
            return false;
        }

        return true;

    }


}
