<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('failures', function (Blueprint $table) {
            $table->id();
            $table->string("picture", 40);
            $table->string("location", 40);
            $table->decimal("latitude", 10, 8);
            $table->decimal("longitude", 10, 8);
            $table->string("description", 150);
            $table->date("date");
            $table->foreignId("states_id")->references("id")->on("states");
            $table->foreignId("users_id")->references("id")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failures');
    }
};
