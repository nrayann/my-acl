<?php
use Migrations\AbstractSeed;
use Cake\ORM\TableRegistry;

/**
 * Groups seed.
 */
class GroupsSeed extends AbstractSeed
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
        $data = [
            'name' => 'Admin',
            'created' =>  date('Y-m-d H:i:s'),
            'modified' =>  date('Y-m-d H:i:s')
        ];

        $groups_table = TableRegistry::get('MyAcl.Groups');
        $group = $groups_table->newEntity();
        $group = $groups_table->patchEntity($group, $data);
        $groups_table->save($group);

    }
}
