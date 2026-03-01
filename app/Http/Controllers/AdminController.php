<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class AdminController extends Controller
{
public function index()
{
    $projects = Project::all();
   
    return view('admin.index', ['projects' => $projects]);
}
    public function create()
    {
        return view('admin.create');
    }
    
public function store(Request $request)

{
    $project = new Project();
    $project->title = $request->title;
    $project->description = $request->description;
    $project->price = $request->price;
    $project->author = $request->author;
    $project->image = $request->image;
    $project->save();
    
    return redirect()->route('admin.index')->with('success', 'Проект успешно добавлен!');
}
    
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.edit', ['project' => $project]);
    }
    
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->price = $request->price;
        $project->author = $request->author;
        $project->image = $request->image;
        $project->save();
        
        return redirect()->route('admin.index')->with('success', 'Проект обновлён!');
    }
    
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        
        return redirect()->route('admin.index')->with('success', 'Проект удалён!');
    }
}