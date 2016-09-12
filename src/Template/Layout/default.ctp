<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->fetch('meta') ?>

        <title>
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('MyAcl.bootstrap.min') ?>
        <?= $this->Html->css('MyAcl.font-awesome.min') ?>
        <?= $this->Html->css('MyAcl.base') ?>
        <?= $this->Html->css('MyAcl.cake') ?>
        <?= $this->Html->css('MyAcl.style') ?>
        <?= $this->fetch('css') ?>
    </head>
    <body>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href=""><?= $this->fetch('title') ?></a></h1>
                </li>
            </ul>
            <div class="top-bar-section">
                <ul class="right">
                    <li><a target="_blank" href="https://github.com/nrayann/my-acl"><?= __('Documentation') ?></a></li>
                    <li><a href="<?= $this->Url->build('/users/logout', true) ?>"><?= __('Logout') ?></a></li>
                </ul>
            </div>
        </nav>

        <?= $this->Flash->render() ?>
        <div class="container clearfix">
            <?= $this->fetch('content'); ?>
        </div>
        <footer>
            <?= $this->Html->script('MyAcl.jquery-3.1.0.min') ?>
            <?= $this->Html->script('MyAcl.bootstrap.min') ?>

            <?= $this->fetch('script') ?>
        </footer>
    </body>
</html>
