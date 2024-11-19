<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

abstract class Entity extends Eloquent\Model
{
    use Eloquent\Concerns\HasUlids,
        Eloquent\Factories\HasFactory,
        Eloquent\SoftDeletes;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the intermediate relation of this entity and the contacts.
     */
    public function contactables(): Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ContactEntity::class, 'entity', 'entity_type', 'entity_id');
    }

    /**
     * Get the contacts of this entity.
     */
    public function contacts(): Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Contact::class, 'entity', ContactEntity::class, 'entity_id', 'contact_id')
            ->using(ContactEntity::class)
            ->withPivot(['id'])
            ->withTimestamps();
    }
}
