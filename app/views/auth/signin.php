<?php

/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.02.2019
 * Time: 19:49
 */

/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>
<div class="row">
    <div class="col-md-6">
        <h3>Авторизация</h3>
        <?php $form=\yii\bootstrap\ActiveForm::begin([
            'method' => 'POST'
        ]) ?>
        <?=$form->field($model,'email')?>
        <?=$form->field($model,'password')->passwordInput();?>

        <div class="form-group">
            <button type="submit">Войти</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
