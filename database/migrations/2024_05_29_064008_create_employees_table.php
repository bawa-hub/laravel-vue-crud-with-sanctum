<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->enum('gender', ['male', 'female']);
            $table->enum('department', ['IT', 'HR', 'admin']);
            $table->enum('education', ['MBA/MCA', 'BE/BTech', 'ME/MTech']);
            $table->enum('salary', ['Less than 1L', '1 to 3L', 'More than 3L'])->nullable();
            $table->json('hobbies')->nullable();
            $table->date('dob')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
