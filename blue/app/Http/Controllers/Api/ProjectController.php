<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterProjectRequest;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service) {}

    public function index(FilterProjectRequest $request)
    {

        return ProjectResource::collection(Project::query()->with(['tasks'])->filter($request->validated())->paginate(10)->withQueryString());
    }

    public function store(ProjectRequest $request)
    {
        $project = $this->service->store($request->toDTO());

        return response()->json(['message' => 'success', 'project' => new ProjectResource($project)], 201);
    }

    public function show(int $id)
    {
        return new ProjectResource(Project::query()->with(['tasks', 'creator'])->findOrFail($id));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        if ($request->user()->cannot('update', $project)) {
            return response()->json(['message' => 'forbidden'], 403);
        }

        $project = $this->service->update($request->toDTO(), $project);

        return response()->json(['message' => 'success', 'project' => new ProjectResource($project)]);
    }

    public function delete(Request $request, Project $project)
    {
        if ($request->user()->cannot('delete', $project)) {
            return response()->json(['message' => 'forbidden'], 403);
        }
        // do-> transactions
        $project->tasks()->delete();
        $project->delete();

        return response()->noContent();
    }
}
