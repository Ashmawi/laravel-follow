<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFollowsTable extends Migration
{

    // Get a follow relationships table name.
    private function getTableName()
    {
        return config('follow.table_name');
    }
    
    // Get a user model key name.
    private function userKeyName()
    {
        $userModel = config('follow.user');
        return (new $userModel)->getKeyName();
    }

    // Get a users table name.
    private function usersTableName()
    {
        $userModel = config('follow.user');
        return (new $userModel)->getTable();
    }


    // /**
    //  * Run the migrations.
    //  *
    //  * @return void
    //  */
    // public function up()
    // {
    //     Schema::create('user_follows', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('user_id')->constrained()->onDelete('cascade');
    //         $table->foreignId('following_id')->constrained('users')->onDelete('cascade');
    //         $table->timestamps();
    //     });
    // }

    public function up()
    {
        Schema::create($this->getTableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->unique(['user_id', 'following_id']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('following_id');

            $table->foreign('user_id')
                ->references($this->userKeyName())
                ->on($this->usersTableName())
                ->onDelete('cascade');

            $table->foreign('following_id')
                ->references($this->userKeyName())
                ->on($this->usersTableName())
                ->onDelete('cascade');

            $table->timestamp('followed_at');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName());
    }
}
