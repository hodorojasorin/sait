<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campanii', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('project_name');
            $table->string('service_type');
            $table->string('status')->default('planificata');
            $table->decimal('budget', 10, 2);
            $table->date('launch_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('service_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campanii');
    }
};
