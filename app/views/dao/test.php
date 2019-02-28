<?php

/* @var $this \yii\web\View */
?>
<div class="row">
    <div class="col-md-6">
        <pre>
            <?=print_r($users);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($activityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($firstActivity)?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
        <?='Кол-во активностей с уведомлениями: '.$count_notif;?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($allActivityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
        <?php foreach ($activityReader as $item):?>
        <?=print_r($item)?>
        <?php endforeach;?>
            </pre>
    </div>

</div>
