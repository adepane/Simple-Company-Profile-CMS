# Simple-Company-Profile-CMS

This application is for simple company profile with already have content
management system. This application running with Laravel 7.

## Requirement
- php 7.3
- composer

## Start Using
First, git clode this repo

```
$ git clone https://github.com/adepane/Simple-Company-Profile-CMS.git
```

Enter to directory that you clonned, the create environment your database. Then, copy config from .env.example to .env, in your command line.
```
$ cp .env.sample .env
```

install all vendor
```
$ composer install
```

After you done with it, now please create new key
```
$ php artisan key:migrate
```

To run it in the browser, you can use valet like `portal.test`, or if you don't have valet installed, you run development serve like so
```
$ php artisan serve
```

Access the installer 
```
http://127.0.0.0:8000/install
```


