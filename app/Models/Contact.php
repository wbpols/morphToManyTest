<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

class Contact extends Eloquent\Model
{
    use Eloquent\Concerns\HasUlids,
        Eloquent\Factories\HasFactory,
        Eloquent\SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the intermediate relations between this contact and the entities.
     */
    public function contactables(): Eloquent\Relations\HasMany
    {
        return $this->hasMany(ContactEntity::class, 'contact_id', 'id');
    }

    /**
     * Get the customers this contact is assigned to.
     */
    public function customers(): Eloquent\Relations\MorphToMany
    {
        return $this->entities(Customer::class);
    }

    /**
     * Get the entities this contact is assigned to.
     *
     * @param  string  $class  The entity class to query.
     */
    private function entities(string $class): Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany($class, 'entity', ContactEntity::class, 'contact_id', 'entity_id');
    }

    /**
     * Get the prospects this contact is assigned to.
     */
    public function prospects(): Eloquent\Relations\MorphToMany
    {
        return $this->entities(Prospect::class);
    }
}
