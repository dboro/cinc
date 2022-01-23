<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailer_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('secret');
            $table->json('to')->nullable();
            $table->boolean('is_to')->default(true);
            $table->string('subject');
            $table->mediumText('body')->nullable();
            $table->boolean('is_template')->default(false);
            $table->foreignId('account_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('account_id')->on('accounts')->references('id')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });

        $account = \App\Models\Admin\Account::query()
            ->where('product_id', \App\Models\Admin\Product::query()
                ->where('name', 'Mailer')
                ->pluck('id')->first()
            )->first();

        \App\Models\Mailer\MailerTemplate::factory()
            ->state([
                'name' => 'Furniture',
                'to' => ['dmitrydboro@gmail.com', 'test@test.com'],//['ksysha.shulgenko11@gmail.com', 'rimskiyv@gmail.com'],
                'subject' => 'Furniture',
                'secret' => \Illuminate\Support\Facades\Hash::make('furniture-secret'),
                'account_id' => $account->id,
            ])->createOne();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailer_templates');
    }
}
