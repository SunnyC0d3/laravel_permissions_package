<?php

namespace LNPG\RolesAndPermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use LNPG\RolesAndPermissions\Database\Factories\FieldFactory;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'column_name',
        'model'
    ];

    public function users()
    {
        return $this->morphToMany( User::class, 'userable' )->withTimestamps();
    }

    protected static function newFactory()
    {
        return FieldFactory::new();
    }
}