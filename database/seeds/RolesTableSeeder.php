<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $roles = ['ADMIN' => 'Administrator role.', 'ENCODER' => 'Encoder role.', 'MEMBER' => 'Member role.'];
        foreach ($roles as $role => $description) {
            factory(Role::class)->create([
                'id' => $role,
                'description'=> $description
            ]);
        }
    }
}
