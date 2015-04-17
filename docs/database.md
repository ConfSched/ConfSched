## Database Guide

### Configuration

All configuration for the database for the ConfSched webapp can be found in the app/config/database.php file. By default, there will be two database connections created. One for confsched (you can change this name) and one for openconf. The default connection will be setup for confsched (you don't have to specify to use this connection, it will be assumed). To use the openconf connection, you'll need to specify the connection in either the model or query.

This app utilizes Laravel's Eloquent ORM. More information about Eloquent can be found [here]().

This app also utlilizes Laravel's Migrations for creating tables. More information about Migrations can be found [here]().

### OpenConf

For the preplanning phase, OpenConf's database structure is used. You can find more information on OpenConf's database structure [here](http://www.openconf.com/documentation/tables.php).

### ConfSched

ConfSched is the database that this app utliizes. You don't necessarily need to name it confsched. However, if you change the name, you must update the settings in the configuration files.

#### Structure

![alt text](https://raw.githubusercontent.com/ConfSched/ConfSched/master/docs/Scheduling.png "Database")




