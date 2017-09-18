Yii2 filesystem Qiniu
=====================
[Qiniu](http://www.qiniu.com/) storage for Laravel based on [overtrue/flysystem-qiniu](https://github.com/overtrue/flysystem-qiniu).

Installation
------------

```
php composer.phar require --prefer-dist kriss/yii2-filesystem-qiniu -vvv
```

or add

```
"kriss/yii2-filesystem-qiniu": "*"
```

to the require section of your `composer.json` file.

Config
-----

in `web.php`(under Basic Template) or `main.php or main-local.php`(under Advanced Template)

```php
'components' => [
    ...
    'qiniu' => [
        'class' => \kriss\qiniu\QiNiuComponent::className(),
        'access_key' => 'xxx',
        'secret_key' => 'xxx',
        'bucket' => 'xxx',
        'domain' => 'xxx.xxx.com'
    ],
    ...
]
```

Usage
-----

```php
/** @var QiNiuComponent $qiniu */
$qiniu = Yii::$app->get(static::QI_NIU);
$disk = $qiniu->getDisk();

// create a file
$disk->put('avatars/1', $fileContents);

// check if a file exists
$exists = $disk->has('file.jpg');

// get timestamp
$time = $disk->lastModified('file1.jpg');
$time = $disk->getTimestamp('file1.jpg');

// copy a file
$disk->copy('old/file1.jpg', 'new/file1.jpg');

// move a file
$disk->move('old/file1.jpg', 'new/file1.jpg');

// get file contents
$contents = $disk->read('folder/my_file.txt');
```

[Full API documentation.](http://flysystem.thephpleague.com/api/)
