<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationshipType extends Model
{
    protected $table = 'relationship_types';

    protected $fillable = ['name'];

    // If your timestamps are not nullable, Laravel handles them automatically
    public $timestamps = true;

    public function userRelationships()
    {
        return $this->hasMany(UserRelationship::class, 'relationship_type_id');
    }
}
