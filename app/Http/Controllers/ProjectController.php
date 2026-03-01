<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
public function show($id)
{
    $project = Project::findOrFail($id);
    
    if (!$project) {
        dd('Проект не найден в базе');
    }

    return view('project.show', [
        'project' => $project,
    ]);
}
}