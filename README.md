# P4 - Brent Lanier - CSCI S-15 (Summer 2014)

## PROD URL
<http://p4.cscis15.lanier.us/>

## P4 Description



## Details for Instructor(s)

## Steps to Deploy

1) Create a new 'vanilla' Laravel application:
composer create-project laravel/laravel P4 --prefer-dist

2) Verify application availability with a browser - You should receive the Laravel splash page

3) Move into P4 directory and initialize git
git init

4) Add GIT repository
git remote add github git@github.com:lanierbl/CSCI-S15_P4.git

5) Pull Project
git pull github master

6) Edit Database configuration file

7) Migrate Schema to create DB structure
php artisan migrate

8) Seed DB with data
http://<URL of Application>/refreshDB

9) Login to system!  username = test, password = password

## Outside code
* jQuery:  http://jquery.com
* Laravel:  http://laravel.com
* Stack Overflow:  http://www.stackoverflow.com

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

**All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.**

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
