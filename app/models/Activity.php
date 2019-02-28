<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\validators\DateValidator;
use yii\validators\Validator;


class Activity extends ActivityBase
{

    public $email;

	/**
	* проверка email
	*
	* @var email 
	*/
	public $email_repeat;

	/**
	* картинка
	*
	* @var UploadedFile[]
	*/
	public $images;

	

	public function beforeValidate()
	{
		if(!empty($this->startDay)){
			$this->startDay=\DateTime::createFromFormat('d.m.Y', $this->startDay);
			if($this->startDay){
				$this->startDay=$this->startDay->format('Y-m-d');
			}
		}

		if(!empty($this->endDay)){
			$this->endDay=\DateTime::createFromFormat('d.m.Y', $this->endDay);
			if($this->endDay){
				$this->endDay=$this->endDay->format('Y-m-d');
			}
		}
		
		return parent::beforeValidate();
	}

	function rules()
	{
		return array_merge([
			['title', 'string', 'max' => 150, 'min' =>2],
			['startDay', 'date', 'format' => 'php:Y-m-d'],
			['endDay', 'date', 'format' => 'php:Y-m-d'],
			[['title', 'startDay', 'endDay', 'body'], 'required'],
			[['is_blocked', 'use_notification', 'is_repeated'], 'boolean'],
			['email', 'email'],
			['email', 'required', 'when' => function($model){
				return $model->use_notification ?true:false;
			}],
			['email_repeat', 'compare', 'compareAttribute'=>'email'],
			[['images'], 'file', 'extensions' => ['jpg', 'png'], 'maxFiles'=>3]

		],parent::rules());
	}

	public function attributeLabels()
{
    return [
        'title' =>'Название события',
        'startDay' => 'Начало',
        'endDay' => 'Окончание',
        'body' => 'Описание',
        'is_blocked' => 'Блокирующее',
        'is_repeated' =>'Повторение события',
        'use_notification' =>'Получать уведомления на email',
        'image' => 'Прикрепить файлы (максимальное кол-во 3 шт.)'
    ];
}
}