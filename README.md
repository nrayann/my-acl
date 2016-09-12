# MyAcl plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require 'nrayann/my-acl:dev-master'
```

Include the ACL and MyAcl plugin in app/config/bootstrap.php
```php
Plugin::load('Acl', ['bootstrap' => true]);
Plugin::load('MyAcl', ['bootstrap' => false, 'routes' => true]);
```
Include and configure the AuthComponent and the AclComponent in the AppController
```php
public $components = [
    'Acl' => [
        'className' => 'Acl.Acl'
    ]
];
...
$this->loadComponent('Auth', [
    'authorize' => [
        'Acl.Actions' => ['actionPath' => 'controllers/']
    ],
    'loginAction' => [
        'plugin' => false,
        'controller' => 'Users',
        'action' => 'login'
    ],
    'loginRedirect' => [
        'plugin' => false,
        'controller' => 'Pages',
        'action' => 'display'
    ],
    'logoutRedirect' => [
        'plugin' => false,
        'controller' => 'Users',
        'action' => 'login'
    ],
    'unauthorizedRedirect' => [
        'plugin' => false,
        'controller' => 'Users',
        'action' => 'login',
        'prefix' => false
    ],
    'authError' => 'You are not authorized to access that location.',
    'flash' => [
        'element' => 'error'
    ]
]);
```

Add UsersController::login function
```php
public function login() {
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('Your username or password was incorrect.'));
    }
}
```

Add UsersController::logout function
```php
public function logout() {
    $this->Flash->success(__('Good-Bye'));
    $this->redirect($this->Auth->logout());
}
```

Add src/Templates/Users/login.ctp
```php
<?= $this->Form->create() ?>
<fieldset>
    <legend><?= __('Login') ?></legend>
    <?= $this->Form->input('username') ?>
    <?= $this->Form->input('password') ?>
    <?= $this->Form->submit(__('Login')) ?>
</fieldset>
<?= $this->Form->end() ?>
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

Run ```
bin/cake migrations seed --seed UsersSeed -p MyAcl
``` to create the admin user.

Run ```
bin/cake acl grant Groups.1 controllers
``` to grant permissions for admin group.

Inside the project folder, run `sudo chmod -R 777 tmp/` to solve/avoid permission errors.

Log in credentials:
username: you@example.com
password: 123456

For aco sync, access http://"your-application-address"/my-acl/permissions/acoSync

For grant/deny permissions to users and groups, click on permissions buttom at actions column in its index template.

For hide or show ACOS on permission lists, click on config buttom or access http://"your-application-address"/my-acl/permissions/config

