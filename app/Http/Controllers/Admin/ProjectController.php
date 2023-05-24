<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

#Custom Request
use App\Http\Requests\ProjectRequest;

#Models
use App\Models\Project;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Project::assignSlug($request->nameField);

        $newProject = new Project();
        $newProject->name = $data['nameField'];
        $newProject->description = $data['descriptionField'];
        $newProject->thumb = $data['thumbField'];
        $newProject->slug = Project::assignSlug($data['nameField']);
        $newProject->type_id = $data['typeField'];

        $newProject->save();

        // $newProject = Project::create($data);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $project->name = $data['nameField'];
        $project->description = $data['descriptionField'];
        $project->thumb = $data['thumbField'];
        $project->slug = Project::assignSlug($data['nameField']);
        $project->type_id = $data['typeField'];
        $project->save();

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Project::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.projects.index');
    }
}
