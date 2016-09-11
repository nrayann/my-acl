<?= $this->Html->script(['MyAcl.myAcl'], ['block' => 'script']); ?>
<div class="container">
  <div class="col-md-12">
    <a class="btn btn-info m-t" href="<?= $this->Url->build('/my-acl/permissions/config', true) ?>">Configurações</a><br /><br />
  </div>
  <div class="row">
  <?php foreach ($arr_acos as $key => $acos): ?>
    <div class="col-md-6">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th width="50%" >Seção</th>
          <th width="50%"><?= ucfirst($obj->username) ?></th>
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
                          <span style="cursor:pointer;" data-aco="<?= $aroc->_joinData->aco_id ?>" data-aro="<?= $aroc->_joinData->aro_id ?>" class='grantOrDeny label label-success'>Permitido</span>
                        <?php else: ?>
                          <span style="cursor:pointer;" data-aco="<?= $child->id ?>" data-aro="<?= $aroc->id ?>" class='grantOrDeny label label-danger'>Negado</span>
                        <?php endif ?>
                      <?php endforeach ?>
                    <?php else: ?>
                      <span style="cursor:pointer;" data-aco="<?= $child->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-info'>Não definido</span>
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
                            <span style="cursor:pointer;" data-aco="<?= $arop->_joinData->aco_id ?>" data-aro="<?= $arop->_joinData->aro_id ?>" class='grantOrDeny label label-success'>Permitido</span>
                          <?php else: ?>
                            <span style="cursor:pointer;" data-aco="<?= $grandchildren->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-danger'>Negado</span>
                          <?php endif ?>
                        <?php endforeach ?>
                      <?php else: ?>
                        <span style="cursor:pointer;" data-aco="<?= $grandchildren->id ?>" data-aro="<?= $aro->id ?>" class='grantOrDeny label label-info'>Não definido</span>
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
  <?php endforeach ?>
  </div>
</div>