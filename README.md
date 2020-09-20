# Iam plugin for CakePHP

Plugin that covers authorization and management for users; What is include

* Management for Users, Groups, Roles and Policies
* AuthorizationManagerService - Checking if user has assigner required policy for action
* UserManagerService - Manage Users
* PolicyManagerService - Manage policices, Asign/Remove policy from role
* RolesManagerServcice - Manage Roles, Assign/Remove Role from user
* PolicyBuilder - create role string in proper form from given route parts (prefix, plugin, controller, action)

## Requirements

* Cakephp Authentication plugin
* Cakephp Auhtorization plugin
* Service layer for cakephp
* PHP 7.4.*
* CakePHP 4.*
* Database MySql, Postgres to store data

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require maymeow/cakephp-iam-admin
```

## Usage

Chack if user has Assigned policy it can be used with Controllers or With CakeHPHP Authorization plugin policies.

```php
// use Iam\Builder\PolicyBuilder;
// ...
$this->loadService('Iam.UserAuthorization');
//...

$hasPolicy = $this->UserAuthorization->hasPolicyTo($this->_getUser($user), new PolicyBuilder(null, 'Iam', 'users', 'view')); // return bool
```