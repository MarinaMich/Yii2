<?php
namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\log\Logger;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{	
	/**@var строковой класс сущности Activity */
	public $activity_class;
//экземпляр класса в компоненте создаётся через init
	//вызов родительской инициации должен идти в самом начале
	public function init()
	{
		parent::init();

		if(empty($this->activity_class)){
			throw new \Exception("Need attribute activity_class");
			
		}
	}

	/**
	* @return Activity
	**/
	public function getModel($params=null){
		$model= new $this->activity_class;
		if($params && is_array($params)){
			$model->load($params);
		}
		return $model;
	}

    /**
     * @param $id
     * @return Activity|array|\yii\db\ActiveRecord|null
     */

	public function getActivity($id){
	    return $this->getModel()::find()->andWhere(['id'=>$id])->one();
    }

    /**
     * @param $model Activity
     * @return bool
     */
	public function createActivity(&$model):bool{

        $model->images = UploadedFile::getInstances($model, 'images');
        $model->user_id=\Yii::$app->user->id;
		if ($model->validate() && $model->save()) {
            $this->saveImages($model);
            return true;
        }else{
		    \Yii::getLogger()->log($model->getErrors(),Logger::LEVEL_ERROR);
            $model->images='';
		    return false;
        }
    }

    private function saveImages(&$model){
        $path = $this->getPathSaveFile();
        if($model->images) {
            foreach ($model->images as $image) {
                $name = mt_rand(0, 9999) . time() . '.' . $image->getExtension();
                if (!$image->saveAs($path . $name)) {
                    $model->addError('images', 'Файл не удалось переместить');
                    return false;
                }
                $model->imagesNewNames[] = $name;
            }
            return true;
        }else{
            return true;
        }

    }

    private function getPathSaveFile()
    {
        FileHelper::createDirectory(\Yii::getAlias('@app/web/images'));
        return \Yii::getAlias('@app/web/images/');
    }
}