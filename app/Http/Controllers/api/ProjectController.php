<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // aggiungo 2 progetti por page e le tabelle type and technology relazionate a tabella projects
        $projects = Project::with('type', 'technologies')->paginate(2);

        return response()->json([
            'status' => 'success',
            'results' => $projects
        ]);
    }
}
