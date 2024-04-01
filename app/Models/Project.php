<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    /**
     * The accessors to always include.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'cover_url',
        'hero_url',
        'technology_ids',
    ];

    /**
     * The attributes that are mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_id',
        'name',
        'slug',
        'cover',
        'hero',
        'url',
        'summary',
        'introduction',
    ];

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

    /**
     * Return the fully-qualified URL to the project's cover image.
     */
    public function getCoverUrlAttribute(): string
    {
        return Storage::url($this->cover);
    }

    /**
     * Return the fully-qualified URL to the project's hero image.
     */
    public function getHeroUrlAttribute(): string
    {
        return Storage::url($this->hero);
    }

    /**
     * Return an array of this project's technology IDs.
     */
    public function getTechnologyIdsAttribute(): Collection
    {
        return $this->technologies()->pluck('technologies.id');
    }

    /**
     * Return the validation rules for creating/updating projects.
     */
    public function validationRules(): array
    {
        $rules = [
            'name' => "required|string|max:255|unique:projects,name",
            'slug' => "required|string|max:255|unique:projects,slug",
            'type' => 'required|exists:project_types,name',
            'cover' => 'nullable|image',
            'hero' => 'nullable|image',
            'url' => 'nullable|url|max:255',
            'summary' => 'required|string',
            'introduction' => 'required|string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'required|integer|exists:technologies,id',
        ];

        if (!empty($this->id)) {
            $rules['name'] .= ",{$this->id}";
            $rules['slug'] .= ",{$this->id}";
        }

        return $rules;
    }
}
