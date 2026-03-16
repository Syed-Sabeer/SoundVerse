<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRelationship extends Model
{
    use SoftDeletes;

    protected $table = 'user_relationships';

    protected $fillable = [
        'user_id',
        'related_user_id',
        'relationship_type_id',
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function relatedUser()
    {
        return $this->belongsTo(User::class, 'related_user_id');
    }
public function partners()
{
    return $this->belongsToMany(
        User::class,
        'user_relationships',
        'user_id',
        'related_user_id'
    )->withTimestamps();
}


    public function relationshipType()
    {
        return $this->belongsTo(RelationshipType::class, 'relationship_type_id');
    }
}
