<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class WorksController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('works', ['projects' => $projects]);
    }
}