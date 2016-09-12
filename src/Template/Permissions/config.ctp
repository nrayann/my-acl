<?= $this->Html->script(['MyAcl.myAcl'], ['block' => 'script']); ?>
<a class="btn btn-info m-t" href="<?= $this->Url->build('/my-acl/permissions/acoSync', true) ?>"><?= __('ACO Sync') ?></a>
&nbsp
<?= $this->Html->link(__('Groups'), ['controller' => 'groups'], ['class' => 'btn btn-primary m-t']) ?>
<br /><br />
<div class="row m-b">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th width="50%" >ACOs</th>
          <th width="50%">Status</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach ($acos as $key => $aco): ?>
            <tr style="background-color: #E6E6E6;">
              <td><b><?= '- '. __d('my_acl', $aco->alias) ?></b></td> <!-- Controllers -->
              <td>
                <?php if ($aco->_show == 1): ?>
                  <span style="cursor:pointer;" data-aco="<?= $aco->id ?>" class='showOrHide label label-success reload'><?= __('Visible') ?></span>
                <?php else: ?>
                  <span style="cursor:pointer;" data-aco="<?= $aco->id ?>" class='showOrHide label label-danger reload'><?= __('Invisible') ?></span>
                <?php endif ?>
              </td>
            </tr>
            <?php if ($aco->_show == 1): ?>
              <?php foreach ($aco['children'] as $key => $child): ?>
                <?php if (empty($child['children'])): ?>
                  <tr>
                    <td><?= '-- '. __d('my_acl', $child->alias) ?></td> <!-- Controllers Actions -->
                    <td>
                    <?php if ($child->_show == 1): ?>
                      <span style="cursor:pointer;" data-aco="<?= $child->id ?>" class='showOrHide label label-success'><?= __('Visible') ?></span>
                    <?php else: ?>
                      <span style="cursor:pointer;" data-aco="<?= $child->id ?>" class='showOrHide label label-danger'><?= __('Invisible') ?></span>
                    <?php endif ?>
                    </td>
                  </tr>
                <?php else: ?>
                  <tr>
                    <td><b><?= '-- '. __d('my_acl', $child->alias) ?></b></td> <!-- Plugins -->
                    <td>
                      <?php if ($child->_show == 1): ?>
                        <span style="cursor:pointer;" data-aco="<?= $child->id ?>" class='showOrHide label label-success reload'><?= __('Visible') ?></span>
                      <?php else: ?>
                        <span style="cursor:pointer;" data-aco="<?= $child->id ?>" class='showOrHide label label-danger reload'><?= __('Invisible') ?></span>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php if ($child->_show == 1): ?>
                    <?php foreach ($child['children'] as $key => $grandchildren): ?>
                      <tr>
                        <td><?= '--- '. __d('my_acl', $grandchildren->alias) ?></td> <!-- Plugin Actions -->
                        <td>
                        <?php if ($grandchildren->_show == 1): ?>
                          <span style="cursor:pointer;" data-aco="<?= $grandchildren->id ?>" class='showOrHide label label-success'><?= __('Visible') ?></span>
                        <?php else: ?>
                          <span style="cursor:pointer;" data-aco="<?= $grandchildren->id ?>" class='showOrHide label label-danger'><?= __('Invisible') ?></span>
                        <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  <?php endif ?>
                <?php endif ?>
              <?php endforeach ?>
            <?php endif ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
</div>
