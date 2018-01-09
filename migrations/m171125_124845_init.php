<?php

use yii\db\Migration;

/**
 * Handles the creation of table `model`.
 */
class m171125_124845_init extends Migration
{
    public $tables = [
        'config' => '{{%config}}',
        'menu' => '{{%menu}}',
        'user' => '{{%user}}',
        'file' => '{{%file}}',
        'model' => '{{%model}}',
        'channel' => '{{%channel}}',
        'category' => '{{%category}}',
        'document' => '{{%document}}',
        'document_article' => '{{%document_article}}',
        'document_download' => '{{%document_download}}',
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }

        $this->createTable($this->tables['config'], [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('配置名称'),
            'type' => $this->smallInteger()->notNull()->defaultValue(0)->comment('配置类型'),
            'title' => $this->string()->comment('配置说明'),
            'group' => $this->smallInteger()->notNull()->comment('配置分组'),
            'extra' => $this->string()->comment('可选配置值'),
            'value' => $this->text()->comment('配置值'),
            'comment' => $this->string()->comment('配置说明'),
            'order' => $this->integer()->notNull()->defaultValue(0)->comment('排序'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
        ], $tableOptions);
        $this->createTable($this->tables['menu'], [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull()->comment('菜单名'),
            'parent_id' => $this->integer()->comment('上级菜单'),
            'route' => $this->string()->comment('路由'),
            'order' => $this->integer()->comment('排序'),
            'data' => $this->binary(),
            'level' => $this->smallInteger()->defaultValue(1)->comment('层级'),
        ], $tableOptions);
        $this->createTable($this->tables['user'], [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique()->comment('Email'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('状态'),
            'created_at' => $this->integer()->comment('注册时间'),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->createTable($this->tables['file'], [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('原始文件名'),
            'path' => $this->string()->notNull()->comment('文件保存路径'),
            'ext' => $this->string()->comment('文件后缀'),
            'mime' => $this->string()->comment('文件mime类型'),
            'size' => $this->string()->comment('文件大小'),
            'md5' => $this->string()->unique()->comment('文件MD5'),
            'sha1' => $this->string()->unique()->comment('文件SHA1'),
            'location' => $this->string()->comment('文件保存位置'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->createTable($this->tables['model'], [
            'id' => $this->primaryKey()->comment('模型id'),
            'name' => $this->string()->notNull()->comment('模型标识'),
            'title' => $this->string()->notNull()->comment('模型名字'),
            'model_class' => $this->string()->notNull()->comment('命名空间'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->createTable($this->tables['channel'], [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->comment('上级频道'),
            'title' => $this->string()->notNull()->comment('频道标题'),
            'url' => $this->string()->comment('频道标题'),
            'order' => $this->integer()->comment('排序'),
            'target' => $this->string()->comment('是否新窗口打开'),
        ], $tableOptions);
        $this->createTable($this->tables['category'], [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('标识'),
            'title' => $this->string()->notNull()->comment('标题'),
            'parent_id' => $this->integer()->comment('上级分类'),
            'level' => $this->smallInteger()->defaultValue(1)->comment('层级'),
            'order' => $this->integer()->defaultValue(0)->comment('排序'),
            'meta_title' => $this->string()->comment('SEO的网页标题'),
            'keywords' => $this->string()->comment('SEO的关键字'),
            'description' => $this->string()->comment('描述'),
            'model' => $this->string()->comment('关联模型'),
            'type' => $this->string()->comment('允许发布的内容类型'),
            'link_id' => $this->integer()->comment('外链'),
            'allow_publish' => $this->smallInteger(3)->defaultValue(1)->comment('是否允许发布内容'),
            'display' => $this->smallInteger(1)->defaultValue(1)->comment('可见性'),
            'reply' => $this->smallInteger(1)->defaultValue(1)->comment('是否允许回复'),
            'check' => $this->smallInteger(1)->defaultValue(0)->comment('发布的文章是否需要审核'),
            'reply_model' => $this->string()->comment('回复模型'),
            'extend' => $this->string()->comment('扩展设置'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->string()->comment('数据状态'),
            'icon_id' => $this->integer()->comment('分类图标'),
        ], $tableOptions);
        $this->createTable($this->tables['document'], [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('标识'),
            'title' => $this->string()->notNull()->comment('标题'),
            'category_id' => $this->integer()->notNull()->comment('所属分类'),
            'description' => $this->string()->comment('描述'),
            'root' => $this->integer()->comment('根节点'),
            'pid' => $this->integer()->comment('所属ID'),
            'model_id' => $this->integer()->notNull()->comment('内容模型ID'),
            'type' => $this->string()->notNull()->defaultValue(2)->comment('内容类型'),
            'position' => $this->smallInteger()->comment('推荐位'),
            'link_id' => $this->integer()->comment('外链'),
            'cover_id' => $this->integer()->comment('封面'),
            'display' => $this->integer()->notNull()->defaultValue(1)->comment('可见性'),
            'deadline' => $this->integer()->comment('截至时间'),
            'attach' => $this->integer()->notNull()->defaultValue(0)->comment('附件数量'),
            'view' => $this->integer()->notNull()->defaultValue(0)->comment('浏览量'),
            'comment' => $this->integer()->notNull()->defaultValue(0)->comment('评论数'),
            'extend' => $this->integer()->comment('扩展统计字段'),
            'level' => $this->integer()->notNull()->defaultValue(0)->comment('优先级'),
            'status' => $this->integer()->notNull()->defaultValue(1)->comment('数据状态'),
            'created_at' => $this->integer()->comment('发布时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
            'created_by' => $this->integer()->comment('作者'),
            'updated_by' => $this->integer()->comment('最后编辑'),
        ], $tableOptions);
        $this->createTable($this->tables['document_article'], [
            'document_id' => $this->integer(),
            'parse' => $this->integer()->notNull()->defaultValue(0)->comment('内容解析类型'),
            'content' => $this->text()->notNull()->comment('文章内容'),
            'bookmark' => $this->integer()->notNull()->defaultValue(0)->comment('收藏数'),
        ], $tableOptions);
        $this->createTable($this->tables['document_download'], [
            'document_id' => $this->integer(),
            'parse' => $this->string()->comment('内容解析类型'),
            'content' => $this->string()->comment('下载详细描述'),
            'file_id' => $this->integer()->comment('文件ID'),
            'download' => $this->integer()->notNull()->defaultValue(0)->comment('下载次数'),
            'size' => $this->string()->comment('文件大小'),
        ], $tableOptions);

        $this->addPrimaryKey('', $this->tables['document_article'], 'document_id');
        $this->addPrimaryKey('', $this->tables['document_download'], 'document_id');

        $this->insertData();

        $this->addForeignKey('category_ibfk_1', $this->tables['category'], 'parent_id', $this->tables['category'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_ibfk_1', $this->tables['document'], 'created_by', $this->tables['user'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_ibfk_2', $this->tables['document'], 'updated_by', $this->tables['user'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_ibfk_3', $this->tables['document'], 'category_id', $this->tables['category'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_article_ibfk_1', $this->tables['document_article'], 'document_id', $this->tables['document'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_download_ibfk_2', $this->tables['document_download'], 'document_id', $this->tables['document'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('category_ibfk_1', $this->tables['category'], 'parent_id', $this->tables['category'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('channel_ibfk_1', $this->tables['channel'], 'parent_id', $this->tables['channel'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_download_ibfk_1', $this->tables['document_download'], 'file_id', $this->tables['file'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('document_download_ibfk_2', $this->tables['document'], 'model_id', $this->tables['model'], 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('menu_ibfk_1', $this->tables['menu'], 'parent_id', $this->tables['menu'], 'id', 'CASCADE', 'CASCADE');

    }

    public function insertData()
    {
        $this->insert($this->tables['config'], ['name' => 'WEB_SITE_TITLE', 'type' => '1', 'title' => '网站标题', 'group' => '1', 'extra' => '', 'comment' => '网站标题前台显示标题', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => 'OneThink内容管理框架', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'WEB_SITE_DESCRIPTION', 'type' => '2', 'title' => '网站描述', 'group' => '1', 'extra' => '', 'comment' => '网站搜索引擎描述', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => 'OneThink内容管理框架', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'WEB_SITE_KEYWORD', 'type' => '2', 'title' => '网站关键字', 'group' => '1', 'extra' => '', 'comment' => '网站搜索引擎关键字', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => 'ThinkPHP,OneThink', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'WEB_SITE_CLOSE', 'type' => '4', 'title' => '关闭站点', 'group' => '1', 'extra' => '0:关闭,1:开启', 'comment' => '站点关闭后其他用户不能访问，管理员可以正常访问', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'CONFIG_TYPE_LIST', 'type' => '3', 'title' => '配置类型列表', 'group' => '4', 'extra' => '', 'comment' => '主要用于数据解析和页面表单的生成', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '0:数字
1:字符
2:文本
3:数组
4:枚举', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'WEB_SITE_ICP', 'type' => '1', 'title' => '网站备案号', 'group' => '1', 'extra' => '', 'comment' => '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DOCUMENT_POSITION', 'type' => '3', 'title' => '文档推荐位', 'group' => '2', 'extra' => '', 'comment' => '文档推荐位，推荐到多个位置KEY值相加即可', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1:列表页推荐
2:频道页推荐
4:网站首页推荐', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DOCUMENT_DISPLAY', 'type' => '3', 'title' => '文档可见性', 'group' => '2', 'extra' => '', 'comment' => '文章可见性仅影响前台显示，后台不收影响', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '0:所有人可见
1:仅注册会员可见
2:仅管理员可见', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'COLOR_STYLE', 'type' => '4', 'title' => '后台色系', 'group' => '1', 'extra' => 'default_color:默认
blue_color:紫罗兰', 'comment' => '后台颜色风格', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => 'default_color', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'CONFIG_GROUP_LIST', 'type' => '3', 'title' => '配置分组', 'group' => '4', 'extra' => 'blue_color:紫罗兰', 'comment' => '配置分组', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1:基本
2:内容
3:用户
4:系统', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'HOOKS_TYPE', 'type' => '3', 'title' => '钩子的类型', 'group' => '4', 'extra' => '', 'comment' => '类型 1-用于扩展显示内容，2-用于扩展业务处理', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1:视图
2:控制器', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'AUTH_CONFIG', 'type' => '3', 'title' => 'Auth配置', 'group' => '4', 'extra' => '', 'comment' => '自定义Auth.class.php类配置', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => 'AUTH_ON:1
AUTH_TYPE:2', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'OPEN_DRAFTBOX', 'type' => '4', 'title' => '是否开启草稿功能', 'group' => '2', 'extra' => '0:关闭草稿功能
1:开启草稿功能
', 'comment' => '新增文章时的草稿功能配置', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DRAFT_AOTOSAVE_INTERVAL', 'type' => '0', 'title' => '自动保存草稿时间', 'group' => '2', 'extra' => '0:关闭草稿功能', 'comment' => '自动保存草稿的时间间隔，单位：秒', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '60', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'LIST_ROWS', 'type' => '0', 'title' => '后台每页记录数', 'group' => '2', 'extra' => '1:开启草稿功能', 'comment' => '后台数据每页显示记录数', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '10', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'USER_ALLOW_REGISTER', 'type' => '4', 'title' => '是否允许用户注册', 'group' => '3', 'extra' => '0:关闭注册
1:允许注册', 'comment' => '是否开放用户注册', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'CODEMIRROR_THEME', 'type' => '4', 'title' => '预览插件的CodeMirror主题', 'group' => '4', 'extra' => '3024-day:3024 day
3024-night:3024 night
ambiance:ambiance
base16-dark:base16 dark
base16-light:base16 light
blackboard:blackboard
cobalt:cobalt
eclipse:eclipse
elegant:elegant
erlang-dark:erlang-dark
lesser-dark:lesser-dark
midnight:midnight', 'comment' => '详情见CodeMirror官网', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => 'ambiance', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DATA_BACKUP_PATH', 'type' => '1', 'title' => '数据库备份根路径', 'group' => '4', 'extra' => '', 'comment' => '路径必须以 / 结尾', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => './Data/', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DATA_BACKUP_PART_SIZE', 'type' => '0', 'title' => '数据库备份卷大小', 'group' => '4', 'extra' => '0:关闭注册', 'comment' => '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '20971520', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DATA_BACKUP_COMPRESS', 'type' => '4', 'title' => '数据库备份文件是否启用压缩', 'group' => '4', 'extra' => '0:不压缩
1:启用压缩', 'comment' => '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DATA_BACKUP_COMPRESS_LEVEL', 'type' => '4', 'title' => '数据库备份文件压缩级别', 'group' => '4', 'extra' => '1:普通
4:一般
9:最高', 'comment' => '数据库备份文件的压缩级别，该配置在开启压缩时生效', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DEVELOP_MODE', 'type' => '4', 'title' => '开启开发者模式', 'group' => '4', 'extra' => '0:关闭
1:开启', 'comment' => '是否开启开发者模式', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '9', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'ALLOW_VISIT', 'type' => '3', 'title' => '不受限控制器方法', 'group' => '0', 'extra' => 'ambiance:ambiance', 'comment' => '', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '1', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'DENY_VISIT', 'type' => '3', 'title' => '超管专限控制器方法', 'group' => '0', 'extra' => '', 'comment' => '仅超级管理员可访问的控制器方法', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '0:Addons/addhook
1:Addons/edithook
2:Addons/delhook
3:Addons/updateHook
4:Admin/getMenus
5:Admin/recordList
6:AuthManager/updateRules
7:AuthManager/tree', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'REPLY_LIST_ROWS', 'type' => '0', 'title' => '回复列表每页条数', 'group' => '2', 'extra' => '', 'comment' => '', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '10', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'ADMIN_ALLOW_IP', 'type' => '2', 'title' => '后台允许访问IP', 'group' => '4', 'extra' => '', 'comment' => '多个用逗号分隔，如果不配置表示不限制IP访问', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '0', 'order' => '0']);
        $this->insert($this->tables['config'], ['name' => 'SHOW_PAGE_TRACE', 'type' => '4', 'title' => '是否显示页面Trace', 'group' => '4', 'extra' => '0:关闭
1:开启', 'comment' => '是否显示页面Trace信息', 'created_at' => time(), 'updated_at' => time(), 'status' => 1, 'value' => '0', 'order' => '0']);
        $this->insert($this->tables['user'], [
            'id' => '1',
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'email' => 'admin@admin.com',
            'status' => \app\models\User::STATUS_ACTIVE,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->batchInsert($this->tables['model'], ['id', 'name', 'title', 'model_class', 'created_at', 'updated_at'], [
            ['1', 'article', '文章', 'app\models\Article', time(), time(),],
            ['2', 'download', '下载', 'app\models\Download', time(), time(),],
        ]);
        $this->insert($this->tables['category'], [
            'id' => '1',
            'name' => 'blog',
            'title' => '博客',
            'model' => '1',
            'type' => '2,1,3',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert($this->tables['document'], [
            'id' => 1,
            'type' => '1',
            'name' => 'zao-lun-zi',
            'title' => '造轮子',
            'description' => '方轮子',
            'category_id' => '1',
            'model_id' => '1',
            'view' => 11,
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        $this->insert($this->tables['document_article'], [
            'document_id' => '1',
            'content' => '轮子',
        ]);

        $this->batchInsert($this->tables['menu'], ['id', 'name', 'parent_id', 'route', 'level', 'order'], [
            ['1', '个人中心', null, null, 1, 1],
            ['2', '我的文档', 1, '/admin/document/my', 2, 0],
            ['3', '草稿箱', 1, '/admin/document/recycle-bin', 2, 0],
            ['4', '待审核', 1, '/admin/document/examine', 2, 0],
            ['5', '回收站', null, '/admin/document/recycle-bin', 1, 2],
            ['6', '用户管理', null, null, 1, 3],
            ['7', '用户信息', '6', '/admin/user/index', 2, 1],
            ['8', '权限管理', '6', '/admin/user/permission', 2, 1],
            ['9', '行为日志', null, '/to-do', 1, 4],
            ['10', '系统设置', null, null, 1, 5],
            ['11', '网站设置', '10', '/admin/config/group', 2, 0],
            ['12', '分类管理', '10', '/admin/category/index', 2, 0],
            ['13', '模型管理', '10', '/admin/model/index', 2, 0],
            ['14', '配置管理', '10', '/admin/config/index', 2, 0],
            ['15', '菜单管理', '10', '/admin/menu/index', 2, 0],
            ['16', '导航管理', '10', '/admin/to-do', 2, 0],
            ['17', '数据备份', null, null, 1, 6],
            ['18', '备份数据库', '17', '/admin/database/index-export', 2, 0],
            ['19', '还原数据库', '17', '/admin/database/index-import', 2, 0],
        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        foreach (array_reverse($this->tables) as $table) {
            $this->dropTable($table);
        }
    }
}
