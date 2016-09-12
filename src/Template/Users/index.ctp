<h3><?= __('Users') ?></h3>
<?= $this->Html->link(__('Add'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
&nbsp
<?= $this->Html->link(__('Groups'), ['controller' => 'groups'], ['class' => 'btn btn-info']) ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('group_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->name) ?></td>
            <td><?= h($user->username) ?></td>
            <td><?= $user->group->name ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-info btn-xs']) ?>
                <?= $this->Html->link(__('Permissions'), ['controller' => 'permissions', 'action' => 'acos', $user->id, 'user'], ['class' => 'btn btn-primary btn-xs']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class' => 'btn btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
