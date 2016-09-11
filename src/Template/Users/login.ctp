<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
    <?= $this->Form->input('username', [
        'placeholder' =>  'Usuário',
        'label' =>  false,
        'div' => 'form-group',
        'class' => 'form-control',
    ]) ?>
    <?= $this->Form->input('password', [
        'placeholder' =>  'Senha',
        'label' =>  false,
        'div' => 'form-group',
        'class' => 'form-control',
    ]) ?>
    <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-primary block full-width m-b m-t']) ?>
<?= $this->Form->end() ?>
