<?php

namespace App\Models;

use Illuminate\Database\Eloquent;

class ContactEntity extends Eloquent\Relations\MorphPivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the contact this intermediate relation is assigned to.
     */
    public function contact(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    /**
     * Get the entity this intermediate relation is assigned to.
     */
    public function entity(): Eloquent\Relations\MorphTo
    {
        return $this->morphTo('entity', 'entity_type', 'entity_id');
    }
}
