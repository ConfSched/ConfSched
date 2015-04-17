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

Next, you need to run composer update to grab all the dependencies:

<code>composer update</code>

Download OpenConf at [http://www.openconf.com/download/](http://www.openconf.com/download/). Follow the installation instructions for OpenConf [here](http://www.openconf.com/documentation/install.php).

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
```

Install instructions for C++ should go here.


