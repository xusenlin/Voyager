<p align="center"><a href="https://the-control-group.github.io/voyager/" target="_blank"><img width="400" src="https://s3.amazonaws.com/thecontrolgroup/voyager.png"></a></p>

<p align="center">
<a href="https://travis-ci.org/the-control-group/voyager"><img src="https://travis-ci.org/the-control-group/voyager.svg?branch=master" alt="Build Status"></a>
<a href="https://styleci.io/repos/72069409/shield?style=flat"><img src="https://styleci.io/repos/72069409/shield?style=flat" alt="Build Status"></a>
<a href="https://packagist.org/packages/tcg/voyager"><img src="https://poser.pugx.org/tcg/voyager/downloads.svg?format=flat" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/tcg/voyager"><img src="https://poser.pugx.org/tcg/voyager/v/stable.svg?format=flat" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/tcg/voyager"><img src="https://poser.pugx.org/tcg/voyager/license.svg?format=flat" alt="License"></a>
<a href="https://github.com/larapack/awesome-voyager"><img src="https://cdn.rawgit.com/sindresorhus/awesome/d7305f38d29fed78fa85652e3a63e154dd8e8829/media/badge.svg" alt="Awesome Voyager"></a>
</p>

# **V**oyager - 一个laravel的后台管理
Made with ❤️ by [The Control Group](https://www.thecontrolgroup.com)

![Voyager-zh Screenshot](http://xusenlin.com/usr/uploads/2017/05/3411382474.jpg)

站点 & 文档: https://the-control-group.github.io/voyager/

视频演示: https://devdojo.com/series/laravel-voyager-010/

加入我们的聊天: https://voyager-slack-invitation.herokuapp.com/

查看 Voyager 提示: https://voyager-cheatsheet.ulties.com/

Voyager最近的视频: https://larachat.co/live

<hr>
Voyager 是一个非常棒的后台管理，但是原作者并没有打算将他翻译为中文，这个是由我翻译的中文，可能有的地方翻译不准确（英文太渣--），希望大家加入进来给我提意见，如果你喜欢，欢迎star.

#如何安装

1、拉取tcg/voyager,这个翻译的版本是v0.11.10，其他版本可能会出错。
```bash
composer require tcg/voyager
```


2、下载这个翻译文件覆盖掉tcg/voyager的所有文件


3、修改你的.env 文件里面的数据库配置:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

4、然后在.env 文件里面配置 `APP_URL` ，否则会导致默认头像显示不了之类的:

```
APP_URL=http://localhost:8000
```

5、添加 Voyager 服务到 `config/app.php` 文件 的`providers` 数组里:

```php
'providers' => [
    // Laravel Framework Service Providers...
    //...
    
    // Package Service Providers
    TCG\Voyager\VoyagerServiceProvider::class,
    // ...
    
    // Application Service Providers
    // ...
],
```

6、安装voyager，他会复制一些迁移文件和模拟数据文件（seed）等到我们的工作目录并将它迁移到数据库。

```bash
php artisan voyager:install
```


7、填充网站的一些设置

```bash
php artisan db:seed --class=SettingsTableSeeder
```

8、现在模拟一个admin用户以便于我们登录后台，（注意：我已经修改了密码，邮箱：admin@admin.com 密码：123456）

```bash
php artisan db:seed --class=UsersTableSeeder
```


>**email:** `admin@admin.com`   
>**password:** `123456`

