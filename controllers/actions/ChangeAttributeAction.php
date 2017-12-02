<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/12/2
 * Time: 5:27
 */

namespace app\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

/**
 * 调用modelClass::findOne方法找到模型
 * 调用modelClass的方法active完成操作
 * 重定向到index方法
 * ```
 * [
 *      'class' => ChangeStatusAction::className(),
 *      'modelClass' => 'app\models\Document',
 *      'callback' => 'active',
 *      'return' => function(){
 *          return $this->>redirect(['index']);
 *      }
 * ]
 * ```
 *
 * 通过回调方法查找模型
 * 通过操作字段值完成操作
 * 返回字符串
 * ```
 * [
 *      'class' => ChangeStatusAction::className(),
 *      'findCallback' => function($condition){
 *          return User::findOne($condition);
 *      }',
 *      'findValue' => Yii::$app->request->get('id'),
 *      'status' => ['status' => 2],
 *      'return' => 'change status success',
 * ]
 * ```
 * ```
 * ```
 *
 * Class ChangeStatusAction
 * @package app\controllers\actions
 */
class ChangeAttributeAction extends Action
{
    /**
     * @var string
     */
    public $findCallback;
    /**
     * @var mixed
     */
    public $findValue;

    /**
     * @var array
     */
    public $status;

    public $modelClass;

    /**
     * 调用modelClass的哪个方法
     * @var string
     */
    public $callback;

    /**
     * @var mixed
     */
    public $return;

    public function run()
    {
        if ($this->findCallback) {
            $model = call_user_func($this->findCallback, $this->findValue);
        } else {
            $modelClass = $this->modelClass;
            $model = $modelClass::findOne(Yii::$app->request->get());
            if ($model == null) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        if ($this->callback) {
            call_user_func([$model, $this->callback]);
        } else {
            foreach ($this->status as $attribute => $value) {
                $model->$attribute = $value;
            }
            $model->save();
        }

        if ($this->return instanceof \Closure) {
            $result = call_user_func($this->return);
        } else {
            $result = $this->return ?: $this->controller->redirect(['index']);
        }

        return $result;
    }
}