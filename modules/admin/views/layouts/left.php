<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    [
                        'label' => '个人中心',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '我的文档', 'icon' => 'circle-o', 'url' => ['document/my'],],
                            ['label' => '草稿箱', 'icon' => 'circle-o', 'url' => ['document/draft'],],
                            ['label' => '待审核', 'icon' => 'circle-o', 'url' => ['document/examine'],],
                        ],
                    ],
                    \app\models\Category::menu(),
                    [
                        'label' => '文档回收站',
                        'icon' => 'circle-o',
                        'url' => ['document/recycle'],
                    ],
                    [
                        'label' => '用户管理',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户信息', 'icon' => 'circle-o', 'url' => ['user/index'],],
                            ['label' => '权限管理', 'icon' => 'circle-o', 'url' => ['role/index'],],
                        ],
                    ],
                    [
                        'label' => '用户行为',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '用户行为', 'icon' => 'circle-o', 'url' => '#',],
                            ['label' => '行为日志', 'icon' => 'circle-o', 'url' => '#',],
                        ],
                    ],
                    [
                        'label' => '系统设置',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '网站设置', 'icon' => 'circle-o', 'url' => ['config/group'],],
                            ['label' => '分类管理', 'icon' => 'circle-o', 'url' => ['category/index'],],
                            ['label' => '模型管理', 'icon' => 'circle-o', 'url' => ['model/index'],],
                            ['label' => '配置管理', 'icon' => 'circle-o', 'url' => ['config/index'],],
                            ['label' => '菜单管理', 'icon' => 'circle-o', 'url' => ['menu/index'],],
                            ['label' => '导航管理', 'icon' => 'circle-o', 'url' => ['nav/index'],],
                        ],
                    ],
                    [
                        'label' => '数据库',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => '备份数据库', 'icon' => 'circle-o', 'url' => 'database/index-import',],
                            ['label' => '还原数据库', 'icon' => 'circle-o', 'url' => 'database/index-import',],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
