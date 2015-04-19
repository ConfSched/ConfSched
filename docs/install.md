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
* [NodeJS with npm](https://nodejs.org)
* [Bower](http://bower.io/#install-bower)

You can follow [this guide](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-14-04) to get a LAMP stack consisting of Ubuntu 14.04, Apache, MySQL, and PHP. Development was done using a LAMP stack so this is the recommended setup.

You can follow [this guide](https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-an-ubuntu-14-04-server) to install NodeJS and npm on Ubuntu 14.04.

To install bower, we use npm. We recommend to install it globally. To do so, run the following:

<code>npm install -g bower</code>

After installing bower, you may run into an issue where you get the following error when running bower:

<code>/usr/bin/env: node: No such file or directory</code>

If you get this error, installing nodejs-legacy will provide a fix. On Ubuntu 14.04, we were able to solve this by running:

<code>sudo apt-get install nodejs-legacy</code>

Once you have all the dependencies isntalled, you can start the installation process.

Run the following:

<code>git clone https://github.com/ConfSched/ConfSched.git</code>

Switch to the newly cloned project.

<code>cd ConfSched</code>

Next, you need to run composer update to grab all the dependencies.

<code>composer update</code>

Depending on your composer installation, you might need to use composer.phar instead:

<code>composer.phar update</code>

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

Next step is to grab all the front end dependencies. For this, we use Grunt and Bower.

<code>npm install</code>

This installs Grunt which we use to automate the build process for our front end code.

<code>bower install</code>

This grabs all of our dependencies through bower.

<code>grunt copy</code>
<code>grunt sass</code>
<code>grunt concat</code>
<code>grunt uglify</code>

This will run our build process that combines all css and js into a single css and js file.

Install instructions for C++ should go here.
