<div class="row">
    <div class="col-md-6">
        <?= $this->Form->create($group) ?>
        <fieldset>
            <legend><?= __('Add Group') ?></legend>
            <?php
                echo $this->Form->input('name',[
                    'label' =>  __('Name'),
                    'div' => 'form-group',
                    'class' => 'form-control',
                    ]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary m-b m-t']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
