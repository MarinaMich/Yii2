<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\validators\DateValidator;
use yii\validators\Validator;


class Activity extends Model
{
	/**
	* Название события
	*
	* @var string 
	*/
	public $title;
	
	/**
	* День начала события. Хранится в Unix timestamp
	*
	* @var int 
	*/
	public $startDay;
	
	/**
	* День завершения события. Хранится в Unix timestamp
	*
	* @var int 
	*/
	public $endDay;
	
	/**
	* ID автора, создавшего события
	*
	* @var int 
	*/
    public $idAuthor;
    
	/**
	* Описание события
	*
	* @var string 
	*/
	public $body;

	/**
	* Чекбокс
	*
	* @var boolean 
	*/
	public $is_blocked;

	/**
	* Чекбокс повтор события
	*
	* @var boolean 
	*/
	public $is_repeated;

	/**
	* Чекбокс согласия на оповещение
	*
	* @var boolean 
	*/
	public $use_notification;

	/**
	* email
	*
	* @var email 
	*/
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
	* @var file
	*/
	public $image;

	

	/*public function beforeValidate()
	{
		if(!empty($this->startDay)){
			$this->startDay=\DateTime::createFromFormat('d-m-y', $this->startDay);
			if($this->startDay){
				$this->startDay=$this->startDay->format('Y-m-d');
			}
		}

		if(!empty($this->endDay)){
			$this->endDay=\DateTime::createFromFormat('d-m-y', $this->endDay);
			if($this->endDay){
				$this->endDay=$this->endDay->format('Y-m-d');
			}
		}
		
		return parent::beforeValidate();
	}
*/

	function rules()
	{
		return [
			['title', 'string', 'max' => 150, 'min' =>2],
			['startDay', 'date', 'format' => 'y-m-d'],
			['endDay', 'date', 'format' => 'y-m-d'],
			[['title', 'startDay', 'endDay', 'idAuthor', 'body'], 'required'],
			[['is_blocked', 'use_notification', 'is_repeated'], 'boolean'],
			['email', 'email'],
			['email', 'required', 'when' => function($model){
				return $model->use_notification ?true:false;
			}],
			['email_repeat', 'compare', 'compareAttribute'=>'email'],
			[['image'], 'file', 'extensions' => ['jpg', 'png'], 'maxFiles'=>3]

		];
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