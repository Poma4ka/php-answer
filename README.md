# php-answer

Небольшой класс, предназначенный для API ответа.

## Использование:

Инициализация ответа (предпочтительно не использовать инициализацию):
```php
$answer = answer::new(); 
```


### Пример отправки успешного ответа
```php
answer::new()->data($result)->code(200)->success()->send();
```

### Пример отправки ошибки
```php
answer::new()->error("Something not found")->code(404)->send();
```

##Разбор параметров



> ```php
> answer::new()->send();
>```
>Отправляет итоговый результат, используется в конце конструктора

> ```php
> answer::new()->code(404)->send();
>```
>Устанавливает код ответа (код устанавливается только в тело ответа, в заголовках всегда передается код 200)

> ```php
> answer::new()->data($result)->send();
>```
>Устанавливает тело ответа

> ```php
> answer::new()->success()->send();
>```
>Устанавливает успешный результат ответа


> ```php
> answer::new()->error($error)->send();
>```
>Устанавливает ошибку ответа


> ```php
> answer::new()->meta(meta)->send();
>```
>Устанавливает meta дату ответа


> ```php
> answer::new()->headers("Accept: application/json","Content-type: application/json")->send();
>```
>Устанавливает хедеры ответа


> ```php
> answer::new()->cookie(string $name,string $value,int $validity,string $path,string $domain,bool $ssl)->send();
>```
>Устанавливает куки ответа

> ```php
> answer::new()->file($path);
>```
>Отправляет файл, при отсутствии файла или ошибки продолжает выполнение операций.

> ```php
> answer::new()->location("/");
>```
>Редиректит пользователя на переданный путь, если путь соответствует текущему пути, то продолжает выполнение операций.

> ```php
> answer::new()->folder($path,$indexFile,$userPath = null);
>```
>Читает файлы их папки $path, учитывая путь пользователя в браузере, или $userPath. Если файл не найден, пытается прочитать $indexFile, если и он не найден, продолжает выполнение операций.
