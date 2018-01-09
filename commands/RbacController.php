<?php

namespace app\commands;

use mdm\admin\models\Route;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * 为系RBAC创建默认数据
     */
    public function actionInit()
    {
        $this->assignAllRoutes();
        $this->createRoleAdmin();
        $this->assignAdminPermission();
    }

    /**
     * 分配全站所有路由
     */
    protected function assignAllRoutes()
    {
        $model = new Route();
        $routes = $model->getRoutes();
        var_dump($routes);
        $routes = array_filter($routes, function ($element) {
            if (strncmp($element, '/admin', 6))
                return true;
            if (strncmp($element, '/rbac', 6))
                return true;
            return false;
        });
        var_dump($routes);
        $model = new Route();
        $model->addNew($routes);
    }

    /**
     * 创建管理员并分配全部权限
     */
    protected function createRoleAdmin()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        //todo 分配 '/*' 权限
    }

    /**
     * 分配管理员权限
     */
    protected function assignAdminPermission()
    {

    }
}