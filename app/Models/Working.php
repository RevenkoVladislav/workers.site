<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Working extends Model
{
    use HasFactory;

    protected $table = 'workings';
    protected $fillable = [
        'title',
        'description',
        'company_id',
        'manager_id',
        'status',
        'work_date',
        'start_time',
        'end_time',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

}
