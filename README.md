CMS, основанная на фреймворке Yii2
============================

Возможности
------------
Простая контентная cms:
- Категории
- Записи
- Страницы
- Шаблоны
- Сео теги: title, description,keywords,breadcrumbs


Установка
------------

1. Склонировать репозиторий
2. Создать файлы:
  config/common-local.php
  config/console-local.php
  config/params-local.php
  config/web-local.php

со след. содежанием:
```php
<?php
return [];
```

3. Выполнить ./yii migrate
4. Выполнить composer install
5. Выполнить ./yii users/create