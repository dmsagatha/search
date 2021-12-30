<?php

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Role::class)->constrained();

      $table->string('name');
      $table->string('email')->unique();
      $table->string('gender');
      $table->string('phone', 20);
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->foreignId('current_team_id')->nullable();
      $table->string('profile_photo_path', 2048)->nullable();
      $table->rememberToken();
      $table->timestamps();
    });

    DB::statement(
      'ALTER TABLE users ADD FULLTEXT fulltext_index(name, email, phone)'
    );
  }

  
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
