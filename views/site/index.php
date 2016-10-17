<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Transfer';

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>


            <?= $form->field($model, 'userFrom')->dropDownList($users,
                ['prompt' => '---Select User---',
                    'onchange' => '
                $.post( "' . Yii::$app->urlManager->createUrl('get-user-lists') . '"+"/"+$(this).val(), function( data ) {
                $( "select#transferform-userto" ).html( data );
                });
                ']); ?>



            <?= $form->field($model, 'userTo')->dropDownList([]) ?>
            <?= $form->field($model, 'sum')->textInput([
                'type' => 'number',
                'min' => '0',
                'step' => '0.01',
            ]);

            ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>


</div>
