<?php

use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_entity', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('contact_id')
                ->references('id')
                ->on(Contact::make()->getTable())
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('entity_type');
            $table->string('entity_id');
            $table->timestamps();

            // Indexes
            $table->index(['entity_type', 'entity_id']);
            $table->unique(['entity_type', 'entity_id', 'contact_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_entity');
    }
};
