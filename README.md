# Simple-Company-Profile-CMS

This application is for simple company profile with already have content
management system. This application running with Laravel 7.

## Feature
- Landing Page
- Admin Page
  - Dashboard
  - News
    - Category
    - Tag
  - Gallery
  - Slideshow
  - Static Page
  - Advertisement
  - Annoucement
  - Message
  - Users
  - General Setting
  - Dynamic Menu Navigation for landing page



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
$ php artisan key:generate
```

To run it in the browser, you can use valet like `portal.test`, or if you don't have valet installed, you run development serve like so
```
$ php artisan serve
```

Before access the installer, purge the all configuration
```
$ php artisan optimize:clear
```

Access the installer 
```
http://127.0.0.0:8000/install
```

Access the Admin Panel
```
http://127.0.0.0:8000/install
```

## Note
- This application using some javascript package include axios from cdn, so you
  need some internet to using it.
- This application still using Indonesian Language, for the future I will update
  all to English