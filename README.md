# P4 - Brent Lanier - CSCI S-15 (Summer 2014)

## PROD URL
<http://p4.cscis15.lanier.us/>

## P4 Description

<b>Domo</b> - A new way to find (and sell) your home.

The purpose of P4 was to apply the lessons of the semester into a comprehensive & dynamic web application.

My goal for <b>Domo</b> was to create a site that allow users to list their homes for sale and give potential buyers a way to search for these (listed) homes.

Some of the features of the site include:
<ul>
    <li>Site registration and user authentication</li>
    <li>Saving of search criteria and home listings per user</li>
    <li>Add new Listings</li>
    <li>Search listings with any combination of search criteria</li>
    <li>Form validation (via Javascript) for required search criteria</li>
    <li>Guest access for home searches using basic criteria</li>
    <li>Site optimized with parallax scrolling</li>
    <li>Fill AJAX processing with dynamic reloading of site elements</li>
</ul>



## Details for Instructor(s)

I decided to explore some really advanced topics with this assignment and surprised myself with how far I got.  I decided to use AJAX for all forms and POST/GET calls to allow my page data to be updated without reposting the page.  I was able to dynamically update dropdown lists of forms when different labels were added as an admin.  In addition, I tried to incorporate the smooth scrolling characteristics of parallax into my site to get a feel for that technology.  All backend DB manipulation and authentication is done via POST/GET calls to PHP.

The site will dynamically adjust content depending on the login status of the user.  If a <b>guest</b> is browsing the page, the user can only search for homes with two search criteria (city & state).  If a <b>user</b> is logged on, they can search using other search criteria as well as list a home.  If an <b>admin</b> is logged on, they can also view and add labels that are used in the dropdown lists of the forms.

All in all, I am very happy with the outcome and looking forward to applying these technologies to future projects.

<b>Database Tables:</b>
<ul>
    <li>homes - Descriptive attributes of each home</li>
    <li>listings - Listing information for each home</li>
    <li>searches - Stores search strings in JSON format for each user</li>
    <li>users - User account info</li>
    <li>labels - Maintains drop-down values for forms (city, state, style, and status)</li>
</ul>

<b>Primary source files</b>
<ul>
    <li>app/routes.php - API logic for AJAX calls</li>
    <li>app/views/_master.blade.php - Master blade template for UI</li>
    <li>app/views/index.blade.php - Central view for site</li>
    <li>public/scripts/index.js - All Javascript <b>(A lot here!)</b></li>
    <li>app/controllers/P4Logic.php - Controller for DB logic</li>
    <li>app/controllers/P4Security.php - Controller for security/authentication logic</li>
    <li>app/controllers/P4Utils.php - Controller for debug/testing/seeding logic</li>
    <li>public/css/index.css - Main stylesheet for site</li>
</ul>

<b>User Accounts of seed data</b>
<ul>
    <li>admin/password (Admin of system - No listings as seed data)</li>
    <li>test/password (Multiple listings in seed data)</li>
</ul>

<b><u>NOTE:</u></b> There is more code in my repository than what is above but the working code is encompassed in these files.  I originally wrote the skeleton of the logic using views/forms and then late in the process decided to move most of the processing to AJAX and try and incorporate parallax into the UI.  You'll see the remnants of the old code in the OLD folder of '/app/views/'.  All of my UI and Javascript is in 'index.blade.php" and 'index.js' respectively.


## Project To-Do (Things I still want to figure out)

There are three areas that I will want to focus on after the course has completed:

1. Currently, listing information is stored in a separate table than the home information (of each listing).  The DB query that pulls home descriptions (i.e., when a user does a property search) doesn't have the corresponding listing so I can't reference the listing ID.  I need to rewrite the query to do a join between 'homes' and 'listings' to reference this additional information.  The usability of the tool would be better if the user knows the listing number alongside the home data.

2. Give admins the ability to make other users admins of the system.

3. I'm trying to use a Bootstrap modal to display the details of each home.  I can trigger the modal event and do the appropriate AJAX call to pull the home details by home_id but I haven't figured out how to use this data in the modal dynamically.  More to come there.....


## Steps to Deploy

<b><u>NOTE</u></b> - These steps where carried out on a Dreamhost account.

1. Create a new 'vanilla' Laravel application:

    `composer create-project laravel/laravel P4 --prefer-dist`

2. Verify application availability with a browser - You should receive the Laravel splash page

3. Move into P4 directory and initialize GIT

    `git init`

4. Add GitHub repository

    `git remote add github git@github.com:lanierbl/CSCI-S15_P4.git`

5. Pull project from GitHub

    `git pull github master`

6. Edit DB configuration file

7. Migrate schema to create DB structure

    `php artisan migrate`

8. Seed DB with data

    `http://<URL of Application>/refreshDB`

9. Login into system!

    `username = test, password = password`

## Outside code
* jQuery:  http://jquery.com
* Laravel:  http://laravel.com
* Bootstrap:  http://getbootstrap.com/
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
