<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class DeploymentCheck extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'is_completed',
        'completed_at'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
