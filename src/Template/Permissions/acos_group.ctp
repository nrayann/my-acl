<?= $this->Html->script(['MyAcl.myAcl'], ['block' => 'script']); ?>
<a class="btn btn-info m-t" href="<?= $this->Url->build('/my-acl/permissions/config', true) ?>"><?= __('Config') ?></a>
<?= $this->Html->link(__('Users'), ['controller' => 'users'], ['class' => 'btn btn-primary m-t']) ?>
<br /><br />
<div class="row m-b">
  <div class="col-md-12">
    <h3>Group <?= ucfirst($obj->name) ?></h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50%" >ACOs</th>
          <th width="50%"><?= ucfirst($obj->name) ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($acos as $key => $aco): ?>
          <tr style="background-color: #E6E6E6;">
            <td><b><?= '- '. $aco->alias ?></b></td> <!-- Controllers -->
            <td>-</td>
          </tr>
          <?php foreach ($aco['children'] as $key => $child): ?>
            <?php if (empty($child['children'])): ?>
              <tr>
                <td><?= '-- '. $child->alias ?></td> <!-- Controllers Actions -->
                <td>
                <?php if (!empty($child['aros'])): ?>
                  <?php foreach ($child['aros'] as $k => $aroc): ?>
                    <?php if ($aroc->foreign_key == $obj->id && $aroc->_joinData->_create == 1): ?>
                      <span data-aco="<?= $aroc->_joinData->aco_id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-success'><?= __('Allowed') ?></span>
                    <?php else: ?>
                      <span data-aco="<?= $child->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'><?= __('Denied') ?></span>
                    <?php endif ?>
                  <?php endforeach ?>
                <?php else: ?>
                  <span data-aco="<?= $child->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'><?= __('Denied') ?></span>
                <?php endif ?>
                </td>
              </tr>
            <?php else: ?>
              <tr>
                <td><b><?= '-- '. $child->alias ?></b></td> <!-- Plugins -->
                <td>-</td>
              </tr>
              <?php foreach ($child['children'] as $key => $grandchildren): ?>
                <tr>
                  <td><?= '--- '. $grandchildren->alias ?></td> <!-- Plugin Actions -->
                  <td>
                  <?php if (!empty($grandchildren['aros'])): ?>
                    <?php foreach ($grandchildren['aros'] as $j => $arop): ?>
                      <?php if ($arop->foreign_key == $obj->id && $arop->_joinData->_create == 1): ?>
                        <span data-aco="<?= $arop->_joinData->aco_id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-success'><?= __('Allowed') ?></span>
                      <?php else: ?>
                        <span data-aco="<?= $grandchildren->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'><?= __('Denied') ?></span>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php else: ?>
                    <span data-aco="<?= $grandchildren->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'><?= __('Denied') ?></span>
                  <?php endif ?>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php endif ?>
          <?php endforeach ?>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
