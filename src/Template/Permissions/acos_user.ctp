<?= $this->Html->script(['MyAcl.myAcl'], ['block' => 'script']); ?>
<a class="btn btn-info m-t" href="<?= $this->Url->build('/my-acl/permissions/acoSync', true) ?>"><?= __('ACO Sync') ?></a>
&nbsp
<a class="btn btn-info m-t" href="<?= $this->Url->build('/my-acl/permissions/config', true) ?>"><?= __('Config') ?></a>
<?= $this->Html->link(__('Groups'), ['controller' => 'groups'], ['class' => 'btn btn-primary m-t']) ?>
<br /><br />
<div class="row m-b">
  <div class="col-md-12">
    <h3>User <?= $obj->username ?></h3>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th width="50%" >ACOs</th>
        <th width="50%"><?= $obj->username ?></th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($acos as $key => $aco): ?>
          <tr style="background-color: #E6E6E6;">
            <td><b><?= '- '. __d('my_acl', $aco->alias) ?></b></td> <!-- Controllers -->
            <td>-</td>
          </tr>
          <?php foreach ($aco['children'] as $key => $child): ?>
            <?php if (empty($child['children'])): ?>
              <?php if ($child->_show == 1): ?>
              <tr>
                <td><?= '-- '. __d('my_acl', $child->alias) ?></td> <!-- Controllers Actions -->
                <td>
                  <?php if (!empty($child['aros'])): ?>
                    <?php foreach ($child['aros'] as $k => $aroc): ?>
                      <?php if ($aroc->foreign_key == $obj->id && $aroc->_joinData->_create == 1): ?>
                        <span style="cursor:pointer;" data-aco="<?= $aroc->_joinData->aco_id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-success'><?= __('Allowed') ?></span>
                      <?php else: ?>
                        <span style="cursor:pointer;" data-aco="<?= $child->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'><?= __('Denied') ?></span>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php else: ?>
                    <span style="cursor:pointer;" data-aco="<?= $child->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-info'><?= __('No defined') ?></span>
                  <?php endif ?>
                </td>
              </tr>
              <?php endif ?>
            <?php else: ?>
              <tr>
                <td><b><?= '-- '. __d('my_acl', $child->alias) ?></b></td> <!-- Plugins -->
                <td>-</td>
              </tr>
              <?php foreach ($child['children'] as $key => $grandchildren): ?>
                <?php if ($grandchildren->_show == 1): ?>
                <tr>
                  <td><?= '--- '. __d('my_acl', $grandchildren->alias) ?></td> <!-- Plugin Actions -->
                  <td>
                    <?php if (!empty($grandchildren['aros'])): ?>
                      <?php foreach ($grandchildren['aros'] as $j => $arop): ?>
                        <?php if ($arop->foreign_key == $obj->id && $arop->_joinData->_create == 1): ?>
                          <span style="cursor:pointer;" data-aco="<?= $arop->_joinData->aco_id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-success'><?= __('Allowed') ?></span>
                        <?php else: ?>
                          <span style="cursor:pointer;" data-aco="<?= $grandchildren->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'><?= __('Denied') ?></span>
                        <?php endif ?>
                      <?php endforeach ?>
                    <?php else: ?>
                      <span style="cursor:pointer;" data-aco="<?= $grandchildren->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-info'><?= __('No defined') ?></span>
                    <?php endif ?>
                  </td>
                </tr>
                <?php endif ?>
              <?php endforeach ?>
            <?php endif ?>
          <?php endforeach ?>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
