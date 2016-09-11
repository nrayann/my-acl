<h3><?= __('Groups') ?></h3>
<?= $this->Html->link(__('Add'), ['controller' => 'groups', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
&nbsp
<?= $this->Html->link(__('Users'), ['controller' => 'users'], ['class' => 'btn btn-info']) ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $group): ?>
        <tr>
            <td><?= $this->Number->format($group->id) ?></td>
            <td><?= h($group->name) ?></td>
            <td><?= h($group->created) ?></td>
            <td><?= h($group->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $group->id], ['class' => 'btn btn-info']) ?>
                <?= $this->Html->link(__('Permissions'), ['controller' => 'permissions', 'action' => 'acos', $group->id, 'group'], ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $group->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
