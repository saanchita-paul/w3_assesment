<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeploymentCheck extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'is_completed',
        'completed_at'
    ];
}
