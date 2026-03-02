<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Project extends Model
{
    protected $fillable = [
        'name',
        'owner_email',
        'release_date',
    ];

    public function deploymentChecks(): HasMany
    {
        return $this->hasMany(DeploymentCheck::class);
    }
}
