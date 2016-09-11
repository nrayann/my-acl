<?= $this->Form->create($user) ?>
<fieldset>
    <legend><?= __('Edit User') ?></legend>
    <?php
        echo $this->Form->input('name',[
            'label' =>  __('Name'),
            'div' => 'form-group',
            'class' => 'form-control',
            ]);
        echo $this->Form->input('username',[
            'label' =>  __('Username'),
            'div' => 'form-group',
            'class' => 'form-control',
            ]);
        echo $this->Form->input('password',[
            'label' =>  __('Password'),
            'div' => 'form-group',
            'class' => 'form-control',
            'value' => '',
            'required' => false
            ]);
        echo $this->Form->input('group_id',[
            'options' => $groups,
            'label' =>  __('Group'),
            'div' => 'form-group',
            'class' => 'form-control'
            ]);
    ?>
</fieldset>
<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary block full-width m-b m-t']) ?>
<?= $this->Form->end() ?>
