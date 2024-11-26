<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // If you're using a different table name, uncomment and define it:
    // protected $table = 'roles';

    // Define fillable fields
    protected $fillable = ['name'];

    // Define the relationship with the User model
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
