# PHP Quiz

[![Build Status](https://github.com/IGBIllinois/php-quiz/actions/workflows/main.yml/badge.svg)](https://github.com/IGBIllinois/php-quiz/actions/workflows/main.yml)

* A simple PHP Quiz
* Supports Multiple different quizes
* MySQL backend with LDAP for authentication
* Manual located at [docs/manual.md](docs/manual.md)

## Prerequisites
* PHP
* php-ldap
* MySql
* Ldap

## Installation
* Download the latest release from https://github.com/IGB-UIUC/php-quiz/releases or git clone the repository.  Place this in the document root of the web server
```
git clone https://github.com/IGB-UIUC/php-quiz.git
```
* Create Mysql Database
```
CREATE DATABASE phpquiz CHARACTER SET utf8 COLLATE utf8_general_ci;
```
* Import sql/php-quiz.sql to create database structure
```
mysql -u root -p phpquiz < sql/php-quiz.sql
```
* Create mysql user with insert,select,update,delete permissions on php-quiz database
```
CREATE USER 'phpquiz'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD';
GRANT SELECT,INSERT,DELETE,UPDATE ON phpquiz.* to 'phpquiz'@'localhost';
```
* Copy conf/config.inc.php.dist to conf/config.inc.php
```
cp conf/config.inc.php.dist conf/config.inc.php
```
* Edit includes/config.inc.php to have your mysql and ldap settings
```
//MySQL settings
define('MYSQL_USER','phpquiz');
define('MYSQL_PASSWORD','');
define('MYSQL_HOST','localhost');
define('MYSQL_DATABASE','phpquiz');
define('MYSQL_SSL',false);

//LDAP Settings
define('LDAP_HOST','XXX.XXX.XXX.XXX');
define('LDAP_BASE_DN', 'dc=XXX,dc=XXX,dc=XXX');
define('LDAP_PEOPLE_DN', 'ou=people,dc=XXX,dc=XXX,dc=XXX');
define('LDAP_GROUP_DN', 'ou=group,dc=XXX,dc=XXX,dc=XXX');
define('LDAP_SSL',false);
define('LDAP_TLS',false);
define('LDAP_PORT','389');
define('PASSWORD_RESET_URL','');

define('UPLOAD_DIR','uploads/');
define('DEFAULT_QUESTION_POINTS',1);
define('DEFAULT_PASS_SCORE',0);
define('TITLE','Training Website');
define('EMAIL','');

define('DEBUG',false);
```
* Add initial user to database
```
INSERT INTO users(user_name,user_role) VALUES('USERNAME','1');
```
* Run composer install to install php/javascript dependencies
```
composer install
```
* Set /uploads folder for the apache user to have read/write permssions on it
```
chown apache.apache uploads
```


