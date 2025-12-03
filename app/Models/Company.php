<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $guarded = ['name', 'description'];

    public function managers(): HasMany
    {
        return $this->hasMany(Manager::class, 'company_id', 'id');
    }

    public function working(): HasMany
    {
        return $this->hasMany(Working::class, 'company_id', 'id');
    }
}
