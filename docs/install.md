## Install Guide

### About
This is a webapp that contains a combination of technologies. First is a Laravel 4.2 webapp. Second is an OpenConf webapp. You can find more information about Laravel 4.2 [here](http://laravel.com/docs/4.2). You can find more information about OpenConf [here](http://www.openconf.com/support/).

### Installation

You will need the following dependencies:

* [PHP 5.4 or later](https://php.net/)
* [MySQL](https://www.mysql.com/)
* [Apache](https://httpd.apache.org/)
* [Git](http://git-scm.com/downloads)
* [Composer](https://getcomposer.org/download/)
* [NodeJS](https://nodejs.org)
* [Ruby](https://www.ruby-lang.org/en/downloads/)
* [Bower](http://bower.io/#install-bower)

Run the following:

<code>git clone https://github.com/ConfSched/ConfSched.git</code>

Switch to the newly cloned project.

<code>cd ConfSched</code>

Next, you need to run composer update to grab all the dependencies.

<code>composer update</code>

Download OpenConf at [http://www.openconf.com/download/](http://www.openconf.com/download/). Follow the installation instructions for OpenConf [here](http://www.openconf.com/documentation/install.php).

Create the database for the ConfSched app. We named the database <code>confsched</code> but you may name it whatever you like.

Now we'll head back to the ConfSched app. You'll need to create the <code>.env.php</code> file. This file will contain sensitive information such as passwords. It is configured in the <code>.gitignore</code> file to not be tracked by Git. Your <code>.env.php</code> file should be in the root folder of your project. 

You can find documentation on <code>.env.php</code> [here](http://laravel.com/docs/4.2/configuration#protecting-sensitive-configuration). 

Here is an example of what your <code>.env.php</code> file should look like:

```php
<?php
    return [
        'db_username' => '<username>', // username for your db
        'db_password' => '<password>', // password for your db
        'db_name' => '<db_name>', // name for your db
        'db_openconf_username' => '<username>', // openconf's db username
        'db_openconf_password' => '<password>', // openconf's db password
        'db_openconf_name' => '<db_name>' // openconf's db name
    ];
?>
```

Now we need to create the tables. To do so, we'll use Laravel's Migrations. Run the following command:

<code>php artisan migrate</code>

We now need to configure Apache. The file structure of a Laravel application includes a public folder. That is the only folder we want publicly accessible. We don't want Apache to serve up the other folders. In order to achieve this, we take advantage of virtual hosts. We want to create a virtual host that will point to the path to our public folder. The actual implementation will vary from version to version in Apache.

[Here](http://ulyssesonline.com/2014/07/24/install-laravel-4-2-on-ubuntu-server-14-04-lts/) is a reference on setting up Larave 4.2 for an Apache server on Ubuntu Server 14.04 LTS.

Please note: you will need to have the <code>php-mcrypt</code> extension installed in order to use Laravel.

Please note: you may run into permission issues where you only get a white screen with Laravel. This is typically caused by the app/storage folder not being writeable by the web server. For more information on this error, see [this](http://stackoverflow.com/questions/20678360/laravel-blank-white-screen).




Install instructions for C++ should go here.
