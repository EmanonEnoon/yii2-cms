## Yii2-CMS

重复造轮子，我这个轮子，又大又圆

### 使用

配置 `config/db.php`
```
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```
如果数据库不存在需要手动创建数据库

初始化数据库
```
yii app/init
```

```
username:admin
password:123456
```


## TO DO


 - 在新建文章页编辑时，可以定时保存
 - 在新建文章页编辑时，可以保存草稿
 - 安装数据库时，默认导入路由、用户角色、分配权限
 
 - 数据库
    - 可以配置备份数据库的路径
    - 数据表可以单个备份、单个优化
    - 数据表批量备份、批量优化
    
 - 数据库备份
    - 可以恢复指定的备份文件

 - 中文（项目所有Gii生成的英文改成中文）
 - 后台侧边栏菜单可以显示不同icon