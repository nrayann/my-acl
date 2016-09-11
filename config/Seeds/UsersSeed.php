<?php
use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $this->call('GroupsSeed');

        $groups_table = TableRegistry::get('MyAcl.Groups');
        $group = $groups_table->find('all')->where(['name' => 'Admin'])->first();

        $data = [
            'name' => 'Rayann Nayran',
            'username' => 'rayann@pianolab.com.br',
            'password' => '123456',
            'group_id' => $group->id,
            'created' =>  date('Y-m-d H:i:s'),
            'modified' =>  date('Y-m-d H:i:s')
        ];

        $users_table = TableRegistry::get('MyAcl.Users');
        $user = $users_table->newEntity();
        $user = $users_table->patchEntity($user, $data);
        $users_table->save($user);

    }
}
