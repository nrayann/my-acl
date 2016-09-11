<?php

namespace MyAcl\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{

    public $components = [
        'Acl' => [
            'className' => 'Acl.Acl'
        ]
    ];

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'authorize' => [
                'Acl.Actions' => ['actionPath' => 'controllers/']
            ],
            'loginAction' => [
                'plugin' => 'MyAcl',
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'plugin' => false,
                'controller' => 'Pages',
                'action' => 'display'
            ],
            'logoutRedirect' => [
                'plugin' => 'MyAcl',
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => false
            ],
            'authError' => 'You are not authorized to access that location.',
            'flash' => [
                'element' => 'error'
            ]
        ]);

        if($this->Auth->user()) {
            $_us = TableRegistry::get('MyAcl.Users');
            $this->set('logged', $_us->find('all')
                ->where(['Users.id' => $this->Auth->user('id')])
                ->contain(['Groups'])
                ->first()
                );
        }

    }

}
