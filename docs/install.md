## Install Guide

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

Now, you'll need to create the <code>.env.php</code> file. This file will contain sensitive information such as passwords. It is configured in the <code>.gitignore</code> file to not be tracked by Git. Your <code>.env.php</code> file should be in the root folder of your project. 

You can find documentation on <code>.env.php</code> [here](http://laravel.com/docs/4.2/configuration#protecting-sensitive-configuration). 

Here is an example of what your <code>.env.php</code> file should look like:

```php
<?php
    return [
        'db_username' => '<username>',
        'db_password' => '<password>'
    ];
```

Download OpenConf at [http://www.openconf.com/download/](http://www.openconf.com/download/). Follow the installation instructions for OpenConf [here](http://www.openconf.com/documentation/install.php).

Install instructions for C++ should go here.


