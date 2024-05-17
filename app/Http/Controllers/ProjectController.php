<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;
use App\Http\Requests\Projects\DeleteRequest;
use App\Http\Requests\Projects\StoreRequest;
use App\Http\Requests\Projects\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Fetch a JSON index of projects.
     */
    public function index(): JsonResponse
    {
        $projects = Project::with([ 'images', 'technologies', 'type' ])->orderBy('name')->get();

        return response()->json($projects);
    }

    /**
     * Create a new project in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $project = $this->_upsert($request);

        return response()->json([
            'project' => $project,
        ]);
    }

    /**
     * Update the given project in storage.
     */
    public function update(UpdateRequest $request, Project $project): JsonResponse
    {
        $project = $this->_upsert($request, $project);

        return response()->json([
            'project' => $project,
        ]);
    }

    /**
     * Delete the given project from storage.
     */
    public function destroy(DeleteRequest $request, Project $project): JsonResponse
    {
        $project->delete();

        return response()->json([
            'message' => 'Project successfully deleted.',
        ]);
    }

    /**
     * Upsert a project from given request data.
     */
    private function _upsert(StoreRequest|UpdateRequest $request, ?Project $project = null): Project
    {
        $data = $request->safe()->toArray();

        $data['type_id'] = ProjectType::where('name', $data['type'])->value('id');
        unset($data['type']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('projects/covers', 'public');
        }

        if ($request->hasFile('hero')) {
            $data['hero'] = $request->file('hero')->store('projects/heroes', 'public');
        }

        if (empty($data['cover'])) unset($data['cover']);
        if (empty($data['hero'])) unset($data['hero']);

        if (!empty($project)) {
            $project->update($data);
        } else {
            $project = Project::create($data);
        }

        $imageIds = [];
        if (!empty($data['images'])) {
            foreach ($data['images'] as $id => $imageData) {
                $imageDelta = [
                    'title' => $imageData['title'],
                    'caption' => $imageData['caption'],
                    'sort_order' => $imageData['sort_order'],
                ];

                if (!empty($imageData['file'])) {
                    $imagePath = $imageData['file']->store('projects/images', 'public');
                    $imageDelta['path'] = $imagePath;
                    $imageDelta['url'] = Storage::url($imagePath);
                }

                if (is_numeric($id)) {
                    $image = ProjectImage::where('id', $id)->first();
                    $image->update($imageDelta);
                } else {
                    $image = $project->images()->create($imageDelta);
                }

                $imageIds[] = $image->id;
            }
        }

        $project->images()->whereNotIn('project_images.id', $imageIds)->delete();

        $project->refresh();

        $project->technologies()->sync($request->safe()->technologies ?? []);

        $project->load([ 'images', 'technologies', 'type' ]);

        return $project;
    }
}
