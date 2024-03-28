<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    /**
     * Return the technologies used on this project.
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'projects_technologies', 'project_id', 'technology_id');
    }

    /**
     * Return this project's type.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class, 'type_id');
    }
}
