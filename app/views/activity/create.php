<?php
/**
* @var $activity \app\models\Activity
*/

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;



?>

<div class="row">
	<div class="col-md-6">
		<h2>Создание нового события</h2>
		<?php $form=ActiveForm::begin();?>
		<?=$form->field($activity, 'title');?>
		<?=$form->field($activity, 'startDay')->textInput(['type' => 'date']); ?>
		<?=$form->field($activity, 'endDay')->textInput(['type' => 'date']); ?>
		<?=$form->field($activity, 'body') ->textarea();?>
		<?=$form->field($activity, 'use_notification') ->checkbox();?>
		<?=$form->field($activity, 'email', [
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>false
		]);?>
		<?=$form->field($activity, 'email_repeat');?>
		<?=$form->field($activity, 'is_blocked') ->checkbox();?>
		<?=$form->field($activity, 'is_repeated') ->checkbox();?>
		<?=$form->field($activity, 'image') ->fileInput();?>


		<div class="form-group">
			<button type="submit" class="btn btn-default">Отправить</button>

			
		</div>


		<?php ActiveForm::end();?>



	</div>	
</div>