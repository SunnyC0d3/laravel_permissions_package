<?php

namespace LNPG\RolesAndPermissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use LNPG\RolesAndPermissions\Database\Factories\RestrictedDataFactory;

class RestrictedData extends Model
{
    use HasFactory;

    protected $table = 'restricted_datas';
    protected $fillable = [
        'model',
        'table_row_id'
    ];
    
    public function users()
    {
        return $this->morphToMany( User::class, 'userable' )->withTimestamps();
    }

    protected static function newFactory()
    {
        return RestrictedDataFactory::new();
    }
}