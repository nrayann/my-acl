<?php

namespace MyAcl\Controller;

use MyAcl\Controller\AppController;
use Cake\ORM\TableRegistry;
use Acl\Shell\AclExtrasShell;

class PermissionsController extends AppController
{

    public function acos($id, $model)
    {
        if (!in_array($model, ['users', 'groups'])) {
            $this->Flash->error(__("Missing model parameter"));
            return $this->redirect($this->referer());
        }

        $acos_table = TableRegistry::get('Acos');
        $acos = $acos_table->find('all')
            ->find('threaded')
            ->where(['Acos.id !=' => 1])
            ->contain(['Aros'])
            ->toArray();

        foreach ($acos as $key => $aco) {
            if ($aco->_show != 1) {
                unset($acos[$key]);
                continue;
            }
            if (!empty($aco['children'])) {
                foreach ($aco['children'] as $key_1 => $aco_children) {
                    // controllers
                    if (!empty($aco_children['aros'])) {
                        foreach ($aco_children['aros'] as $key_2 => $aco_children_aros) {
                            if ($aco_children_aros->foreign_key != $id || $aco_children_aros->model != ucfirst($model)) {
                                unset($acos[$key]['children'][$key_1]['aros'][$key_2]);
                            }
                        }
                        $acos[$key]['children'][$key_1]['aros'] = array_values($acos[$key]['children'][$key_1]['aros']);
                    }

                    // plugins
                    if (!empty($aco_children['children'])) {
                        foreach ($aco_children['children'] as $key_3 => $grandchildren) {
                            if (!empty($grandchildren['aros'])) {
                                foreach ($grandchildren['aros'] as $key_4 => $grandchildren_aro) {
                                    if ($grandchildren_aro->foreign_key != $id || $grandchildren_aro->model != ucfirst($model)) {
                                        unset($acos[$key]['children'][$key_1]['children'][$key_3]['aros'][$key_4]);
                                    }
                                }
                            }
                        }
                        $acos[$key]['children'][$key_1]['children'][$key_3]['aros'] = array_values($acos[$key]['children'][$key_1]['children'][$key_3]['aros']);
                    }
                }
            }
        }

        $this->set('acos', $acos);

        $this->viewBuilder()->layout('MyAcl.default');

        if ($model == 'users') {
            $aros_table = TableRegistry::get('Aros');
            $aro = $aros_table->find('all')->find('threaded')->where(['Aros.foreign_key =' => $id, 'Aros.model =' => 'Users'])->first();
            $this->set('aro', $aro);

            $users_table = TableRegistry::get('MyAcl.Users');
            $user = $users_table->find('all')->where(['Users.id' => $id])->contain(['Groups'])->first();
            $this->set('obj', $user);
            $this->viewBuilder()->template('acos_user');

        } else {
            $aros_table = TableRegistry::get('Aros');
            $aro = $aros_table->find('all')->find('threaded')->where(['Aros.foreign_key =' => $id, 'Aros.model =' => 'Groups'])->first();
            $this->set('aro', $aro);

            $groups_table = TableRegistry::get('Groups');
            $group = $groups_table->get($id);
            $this->set('obj', $group);
            $this->viewBuilder()->template('acos_group');

        }
    }

    public function grantOrDeny()
    {
        $this->request->allowMethod(['ajax']);
        $status = false;
        $aro_id = isset($this->request->data['aro_id']) ? $this->request->data['aro_id'] : null;
        $aco_id = isset($this->request->data['aco_id']) ? $this->request->data['aco_id'] : null;
        $aros_acos_table = TableRegistry::get('ArosAcos');
        $aros_acos = $aros_acos_table->find('all')->where(['aro_id' => $aro_id, 'aco_id' => $aco_id])->first();

        if (is_null($aros_acos)) {
            $aros_acos_table = TableRegistry::get('ArosAcos');
            $aros_acos = $aros_acos_table->newEntity();
            $aros_acos->aro_id = $aro_id;
            $aros_acos->aco_id = $aco_id;
            $aros_acos->_create = 1;
            $aros_acos->_read = 1;
            $aros_acos->_update = 1;
            $aros_acos->_delete = 1;
        } else {
            $aros_acos->_create = $aros_acos->_create == 1 ? -1 : 1;
            $aros_acos->_read = $aros_acos->_read == 1 ? -1 : 1;
            $aros_acos->_update = $aros_acos->_update == 1 ? -1 : 1;
            $aros_acos->_delete = $aros_acos->_delete == 1 ? -1 : 1;
        }

        if ($aros_acos_table->save($aros_acos)) {
            $status = true;
        }

        $this->set('status', $status);
        $this->set('_serialize', ['status']);
    }

    public function acoSync()
    {
        try {
            $AclExtrasShell = new AclExtrasShell();
            $AclExtrasShell->startup();
            $AclExtrasShell->acoSync();
            $this->Flash->success(__('Atualizado com sucesso.'));
            return $this->redirect($this->referer());
        } catch (Exception $e) {
            $this->Flash->error(__($e->getMessage()));
            return $this->redirect($this->referer());
        }
    }

    public function config()
    {
        $acos_table = TableRegistry::get('Acos');

        if ($this->request->is('ajax')) {
            $aco_id = isset($this->request->data['aco_id']) ? $this->request->data['aco_id'] : null;
            $status = false;
            $aco = $acos_table->find('all')
            ->where(['id' => $aco_id])
            ->first();

            if (!is_null($aco)) {
                $aco->_show = $aco->_show == 1 ? 0 : 1;
                if ($acos_table->save($aco)) {
                    $status = true;
                }
            }
            $this->set('status', $status);
            $this->set('_serialize', ['status']);
        } else {
            $acos = $acos_table->find('all')
            ->find('threaded')
            ->where(['Acos.id !=' => 1])
            ->toArray();

            $this->set('acos', $acos);
            $this->viewBuilder()->layout('MyAcl.default');
        }

    }
}
