<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        if (Auth::check() && Auth::user()->company_id) {

            static::addGlobalScope('company', function (Builder $builder) {
                $builder->where('company_id', Auth::user()->company_id);

            });
        }

        static::creating(function ($department) {
            if (Auth::check() && Auth::user()->company_id) {
                $department->company_id = Auth::user()->company_id;
            }
        });
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
