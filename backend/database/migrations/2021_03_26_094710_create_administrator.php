<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->foreignId('product_id')->nullable();

            $table->foreign('product_id')->on('products')->references('id')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });

        $admins = [];
        // Create Dmitry
        $admins[] = \App\Models\User::factory()
            ->state([
                'name' => 'Dmitry Borodavkin',
                'username' => 'dmitry',
                'email' => 'dmitrydboro@gmail.com',
            ])
            ->createOne();

        // Create Vitaliy
        $admins[] = \App\Models\User::factory()
            ->state([
                'name' => 'Vitaliy Rimskiy',
                'username' => 'vitaliy',
                'email' => 'vitaliy@wbmslab.com',
            ])
            ->createOne();

        $adminRole = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $userRole = \Spatie\Permission\Models\Role::create(['name' => 'user']);

        /* @var $user \App\Models\User */
        foreach ($admins as $user) {
            $user->assignRole($adminRole);
            $user->assignRole($userRole);
        }

        // Create Test
        $user = \App\Models\User::factory()
            ->state([
                'name' => 'Test User',
                'username' => 'user',
                'email' => 'user@user.com',
            ])
            ->createOne();
        $user->assignRole($userRole);

        $productNames = ['tasker', 'crm', 'mailer'];

        foreach ($productNames as $name) {

            /* @var \App\Models\Admin\Product $product */
            $product = \App\Models\Admin\Product::factory()
                ->state([
                    'name' => ucfirst($name),
                    'slug' => $name,
                ])
                ->createOne();

            $adminRoleP = \Spatie\Permission\Models\Role::create(['name' => $name . '-admin', 'product_id' => $product->id]);
            $userRoleP = \Spatie\Permission\Models\Role::create(['name' => $name . '-user', 'product_id' => $product->id]);

            $account = \App\Models\Admin\Account::factory()
                ->state([
                    'name' => 'Test',
                    'slug' => 'test',
                    'product_id' => $product->id
                ])
            ->createOne();

            foreach ($admins as $user) {
                /* @var $accountUser \App\Models\Admin\AccountUser */
                $accountUser = \App\Models\Admin\AccountUser::factory()
                    ->state([
                        'account_id' => $account->id,
                        'user_id' => $user->id,
                        'is_owner' => true
                    ])
                    ->createOne();

                $accountUser->assignRole($adminRoleP);
                $accountUser->assignRole($userRoleP);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
