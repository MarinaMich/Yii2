<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="row">
	<p>Вы ввели следующую информацию</p>

	<ul>
		<li><label>Название события</label><?= Html::encode($activity ->title)?></li>
		<li><label>Описание</label><?= Html::encode($activity ->body)?></li>
		<li><label>Актуально С</label><?= Html::encode($activity ->startDay)?></li>
		<li><label>Актуально ДО</label><?= Html::encode($activity ->endDay)?></li>
		<li><label>Email для уведомления</label><?= Html::encode($activity ->email)?></li>
		<li><label>Блокирующее</label><?= Html::encode($activity ->is_blocked?'Да': 'Нет')?></li>
		<li><label>Повторяющееся</label><?= Html::encode($activity ->is_repeated?'Да': 'Нет')?></li>
	</ul>

	<?= Html::a('Создать новое событие', ['/activity/create'], ['class'=>'btb btn-default']);?>
</div>