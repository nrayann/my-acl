# MyAcl plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require 'nrayann/my-acl:dev-master'
```

Include the ACL and MyAcl plugin in app/config/bootstrap.php
```
Plugin::load('Acl', ['bootstrap' => true]);
Plugin::load('MyAcl', ['bootstrap' => false, 'routes' => true]);
```

Set up your database config in `config/app.php`

Run ```
bin/cake migrations migrate -p Acl
``` to create acl tables.

Run ```
bin/cake acl_extras aco_sync
``` to automatically create ACOs.

Run ```
bin/cake migrations migrate -p MyAcl
``` to create Users and Groups tables.

Put your User data to seed in config/Seeds/UsersSeed.php

Run ```
bin/cake migrations seed --seed UsersSeed -p MyAcl
``` to populate the database.

Run ```
bin/cake acl grant Groups.1 controllers
``` to grant permissions for admin group.

Inside the project folder, run `sudo chmod -R 777 tmp/` to solve/avoid permission errors.
