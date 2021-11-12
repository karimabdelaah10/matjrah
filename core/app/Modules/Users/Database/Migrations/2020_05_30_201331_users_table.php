<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type' ,\App\Modules\Users\Enums\UserEnum::types())->index(); // required
            $table->string('name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('mobile_number')->index()->nullable(); //required
            $table->string('password')->nullable(); //required
            $table->string('subdomain')->nullable();
            $table->boolean('is_admin')->nullable()->default(0)->index();
            $table->boolean('is_active')->nullable()->default(1)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
