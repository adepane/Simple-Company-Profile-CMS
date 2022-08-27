# Simple Company Profile CMS

This application is for simple company profile with already have content
management system. This application running with Laravel 9 that update from 7.

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
  - Agenda with Calendar Style
  - Advertisement
  - Annoucement
  - Message
  - Users
  - General Setting
  - Dynamic Menu Navigation for landing page

## Requirement
- php >= 8.0.2
- composer

## Start Config
First, git clode this repo

```
$ git clone https://github.com/adepane/Simple-Company-Profile-CMS.git "yourdirname"
```

Enter to directory that you clonned, then create environment your database with
copy config from .env.example to .env, in your command line.
```
$ cd yourdirname
```
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

Before access the installer, purge the all configuration
```
$ php artisan optimize:clear
```

To run it in the browser, you can use valet like `yourdirname.test`, or if you don't have valet installed, you run development serve like so
```
$ php artisan serve
```

## Start Using

Access the installer 
```
http://127.0.0.0:8000/install
```

Access the Admin Panel
```
http://127.0.0.0:8000/panelroom
```

## Create Admin Account
I have make a simple console for create admin account, running from your cli.
```
$ php artisan create:admin
```

Your will get some input, after that you can login.


## Note
- This application using some javascript package include axios from cdn, so you
  need some internet to using it.
- This application still using Indonesian Language, for the future I will update
  all to English