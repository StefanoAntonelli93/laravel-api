<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // aggiungo 2 progetti por page e le tabelle type and technology relazionate a tabella projects con l'eager loading
        $projects = Project::with('type', 'technologies')->paginate(2);

        return response()->json([
            'status' => 'success',
            'results' => $projects
        ]);
    }


    // mostro il dettaglio del progetto in pages->ProjectDetail
    public function show(string $slug)
    {

        $project = Project::where('slug', $slug)->with('type', 'technologies', 'user')->first();

        if ($project) {
            return response()->json([
                'status' => 'success',
                'results' => $project
            ]);
        } else {
            return response()->json([
                'status' => 'false',
                'results' => null
            ], 404);
        }
    }
}
