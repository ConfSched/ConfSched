# Admin Guide

## Install Guide

### About
This is a webapp that contains a combination of technologies. First is a Laravel 4.2 webapp. Second is an OpenConf webapp. You can find more information about Laravel 4.2 [here](http://laravel.com/docs/4.2). You can find more information about OpenConf [here](http://www.openconf.com/support/).

### Installation

You will need the following dependencies:

* [GCC](https://gcc.gnu.org/)
* [PHP 5.4 or later](https://php.net/)
* [MySQL](https://www.mysql.com/)
* [Apache](https://httpd.apache.org/)
* [Git](http://git-scm.com/downloads)
* [Composer](https://getcomposer.org/download/)
* [NodeJS with npm](https://nodejs.org)
* [Ruby](https://www.ruby-lang.org/en/downloads/)
* [Bower](http://bower.io/#install-bower)

You can follow [this guide](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-14-04) to get a LAMP stack consisting of Ubuntu 14.04, Apache, MySQL, and PHP. Development was done using a LAMP stack so this is the recommended setup.

Note: We edited the /etc/apache2/envvars file to set the group and user for apache to use.

You can follow [this guide](https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-an-ubuntu-14-04-server) to install NodeJS and npm on Ubuntu 14.04.

To install bower, we use npm. We recommend to install it globally. To do so, run the following:

<code>npm install -g bower</code>

After installing bower, you may run into an issue where you get the following error when running bower:

<code>/usr/bin/env: node: No such file or directory</code>

If you get this error, installing nodejs-legacy will provide a fix. On Ubuntu 14.04, we were able to solve this by running:

<code>sudo apt-get install nodejs-legacy</code>

Next, install sass.

<code>gem install sass</code>

Finally, install grunt.

<code>npm install -g grunt-cli</code>

Once you have all the dependencies installed, you can start the installation process.

Create the database for the ConfSched app. We named the database <code>confsched</code> but you may name it whatever you like.

First, start up mysql:

<code> mysql -u <username> -p</code>

Inside of mysql, run the following to create the database:
<code>create database confsched;</code>

After the database has been created, run the following in the root of your web folder (or whever you want it to go):

<code>git clone https://github.com/ConfSched/ConfSched.git</code>

Switch to the newly cloned project.

<code>cd ConfSched</code>

Note: From here on out, all file paths are assumed to be relative to the ConfSched directory unless otherwise noted.

You'll need to create the <code>.env.php</code> file. This file will contain sensitive information such as passwords. It is configured in the <code>.gitignore</code> file to not be tracked by Git. Your <code>.env.php</code> file should be in the root folder of your project. 

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

Next, you need to run composer update to grab all the dependencies. Run this in the root of your ConfSched folder.

<code>composer update</code>

Depending on your composer installation, you might need to use composer.phar instead:

<code>composer.phar update</code>

Now we'll create the tables for the database. To do so, we'll use Laravel's Migrations. Run the following command:

<code>php artisan migrate</code>

Download OpenConf at [http://www.openconf.com/download/](http://www.openconf.com/download/). Follow the installation instructions for OpenConf [here](http://www.openconf.com/documentation/install.php).

This step is optional. If you don't care about the public in the URL, you may skip this. We now need to configure Apache. The file structure of a Laravel application includes a public folder. That is the only folder we want publicly accessible. We don't want Apache to serve up the other folders. In order to achieve this, we take advantage of virtual hosts. We want to create a virtual host that will point to the path to our public folder. The actual implementation will vary from version to version in Apache.

[Here](http://ulyssesonline.com/2014/07/24/install-laravel-4-2-on-ubuntu-server-14-04-lts/) is a reference on setting up Larave 4.2 for an Apache server on Ubuntu Server 14.04 LTS.

Please note: you will need to have the <code>php-mcrypt</code> extension installed in order to use Laravel.

Next step is to grab all the front end dependencies. For this, we use Grunt and Bower. Run the following in your ConfSched directory:

<code>npm install</code>

This installs Grunt which we use to automate the build process for our front end code. Again, run this in your ConfSched directory:

<code>bower install boostrap-sass</code>

<code>bower install font-awesome</code>

<code>bower install jquery</code>

This is the build process. This grabs all of our dependencies through bower. So you'll need to run the following in your ConfSched directory:

<code>grunt copy</code>

<code>grunt sass</code>

<code>grunt concat</code>

<code>grunt uglify</code>

If you ever want to modify the Sass or Javascript, you can find these files in the <code>app/assets</code> folder. You'll need to rebuild the code using the above commands after every change. To make this easier, you can take advantage of Grunt and run the following for autobuild:

<code>grunt</code>

This will listen for any changes and rebuild upon a change.

Open up <code>app/config/site.php</code> and edit the following line to set the url to your OpenConf installation:

<code>'openconf_url' => 'http://path/to/openconf',</code>

To install the C++ back end, navigate to wherever you want to install it (can be anywhere) and run:

<code>git clone https://github.com/ConfSched/Scheduler.git</code>

Next go into the newly created folder,

<code>cd Scheduler</code>

Create a new file named <code>config.h</code> in the Scheduler directory and set the following constants:

```cpp
#ifndef INCLUDED_CONFIG
#define INCLUDED_CONFIG

#define serverAddress "localhost"
#define username "<username>"
#define password "<password>"
#define dbName "confsched"

#endif
```
You can change these values to fit whatever you made them when you set up the confsched database.

Next, run this in your Scheduler directory:

<code>make</code>

Last you need to edit <code>app/config/site.php</code> in your ConfSched directory to update the <code>Scheduler_cmd</code> constant to be the command to run the simulator program.

Now you're good to go!

Before deploying live, be sure to edit <code>app/config/app.php</code> (in your ConfSched directory) and set <code>'debug' => 'false'</code>.

Please note: you may run into permission issues where you only get a white screen with Laravel. This is typically caused by the app/storage folder not being writeable by the web server. For more information on this error, see [this](http://stackoverflow.com/questions/20678360/laravel-blank-white-screen).

## About ConfSched

ConfSched is an application that will help generate schedules for academic conferences. It can be broken up into three different technologies. First is OpenConf open source academic conference preplanning web application. Second is ConfSched web application. Third is a C++ application. These three technologies combine to create ConfSched.

### File Layout

The Webapp file layout is as follows:

ConfSched
    - app
        - assets (This is where development javascript and stylesheets go)
            - javascripts
            - stylesheets
        - config (This is where all configuration files go)
        - controllers (This is where all controllers will be)
        - database
        - models (All models go in here)
        - views (All views go here)
        - filters.php (This is where filters go)
        - routes.php (This is where routes go)
    - bower_components (Vendor folder for bower)
    - docs (All documentation is here)
    - node_modules (Vendor folder for node)
    - public (publicly facing files would go here)
    -vendor (all vendor files go here)

This follows the Laravel convention.

### Workflow

The workfow of the application can be broken down into 5 phases.

#### Installation

The installation phase involves installing the three components (OpenConf, ConfSched web app, and ConfSched C++ app). It also involves setting up the databases and setting some general setting such as basic conference information. The admin account is created for use in future phases.

#### Preplanning

The preplanning phase is the second phase. In this phase, the admin adds topics, adds committee members, and allows authors to submit papers for review. Committee members can review the papers. During this phase, papers will be marked as accepted. This phase utilizies OpenConf. All data is stored in the OpenConf database. 

In the conclusion of this step, the data is copied over to tables within ConfSched's web application. Authors with accepted papers get copied over into their own new table with a new id. There is also a table created that maps authors to their accepted papers using their new author id. Papers and topics do not get copied over and are referenced from OpenConf's tables inside of the web app. 

Emails will also go out during at the conclusion of this step alerting user's of their ability to create an account. This goes to committee members and authors with an accepted paper. Upon registration, these users get an entry added to the users table that notes if they are an author, committee member, or both. This information will be used to determine what they see on their dashboard upon registration.

#### Committee Sourcing
At the beginning of this phase, an email will go out to all committee members that have registered alerting them that they can participate in the committee sourcing phase. In this phase, committee members will be able to see all the accepted papers and categorize them. They can create as many categories as possible and put as many papers as they want into each category. The categories are stored in the <code>categories</code> table. Mappings of papers to categories is found in the <code>categories_papers</code> table.

#### Author Sourcing

At the beginning of this phase, an email will go out to all registred authors with an accepted paper alerting them that they can participate in the author sourcing phase. In this phase, authors will provide feedback on accepted papers with the same topic as their accepted paper(s). This feedback comes in the form of two questions:

1. Would you be interested in attending the session for this paper?
2. Is this paper relevant to your paper?

Response values are:

1. Yes - 1
2. No - 2
3. No Opinion - 3

If the author answers 'Yes' then 1 would be the value recorded. If they answered 'No', the value 2 would be recorded. If they answered "No Opinion", the value 3 would be recorded.

These values are stored in the <code>author_feedback</code> table.

The author sourcing component utilizes AngularJS for its implementation. You can find more information about AngularJS [here](https://angularjs.org/).

#### Scheduling

The last and final stage is scheduling. In this stage, admin can add rooms and session information. Room information is added using a CSV list and is stored in the <code>rooms</code> table.

Once the rooms have been setup, users can setup sessions. Sessions are stored in the <code>sessions</code> table.

Admins can also specify that certain authors are unavailable at certain sessions. This information is stored in the <code>authors_sessions_constraints</code> table.

Admins can also map author accounts to other author accounts. This is helpful because authors are identified by email. If a author used multiple emails during the preplanning phase, they will have multiple author accounts (one for each email). This is fine during the other steps but we becomes a problem when generating a schedule. So the admin can go in and map accounts together. This will go through and replace any reference ot the map account with the account marked as the master. This information is stored in the <code>author_map</code> table.

The actual schedule is generated by making a call to the C++ program. The web app will execute the C++ program and wait until it gets a response back. Once it gets a response back, it will pull the data written in <code>permutations</code> and <code>conflicts</code> tables by the C++ program.

## Database Guide

### Installation / Setup

Installation / Setup details can be found in the install guide.

### Configuration

All configuration for the database for the ConfSched webapp can be found in the app/config/database.php file. By default, there will be two database connections created. One for confsched (you can change this name) and one for openconf. The default connection will be setup for confsched (you don't have to specify to use this connection, it will be assumed). To use the openconf connection, you'll need to specify the connection in either the model or query.

This app utilizes Laravel's Eloquent ORM. More information about Eloquent can be found [here](http://laravel.com/docs/4.2/eloquent).

This app also utlilizes Laravel's Migrations for creating tables. More information about Migrations can be found [here](http://laravel.com/docs/4.2/migrations).

### OpenConf

For the preplanning phase, OpenConf's database structure is used. You can find more information on OpenConf's database structure [here](http://www.openconf.com/documentation/tables.php).

### ConfSched

ConfSched is the database that this app utliizes. You don't necessarily need to name it confsched. However, if you change the name, you must update the settings in the configuration files.

#### Structure

![alt text](https://raw.githubusercontent.com/ConfSched/ConfSched/master/docs/Scheduling.png "Scheduling")
![alt text](https://raw.githubusercontent.com/ConfSched/ConfSched/master/docs/CommitteeSourcing.png "Committee Sourcing")
![alt text](https://raw.githubusercontent.com/ConfSched/ConfSched/master/docs/AuthorSourcing.png "Author Sourcing")
