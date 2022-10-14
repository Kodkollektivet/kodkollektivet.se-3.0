<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\image;


class ProjectController extends Controller
{
    
    public function index($tag = null)
    {
        $tagnames = \App\Http\Controllers\TagController::tagNames();

        if (!isset($tag)) {
            $uri      = 'projects';
            $projects = project::orderBy('created_at', 'desc')->paginate(4);
        } else {
            if (in_array($tag, $tagnames->all())) {
                $uri      = 'projects/' . $tag;
                $projects = project::whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', $tag);
                })->orderBy('created_at', 'desc')->paginate(4);
            } else {
                return redirect()->route('projects');
            }
        }

        foreach ($projects as $project) {
            $project->image = image::where([
                    'item_id'   => $project->id,
                    'item_type' => 'project',
                    'cover'     => 1
                ])->first();
        }

        return view('common.projects')->with([
            'uri'      => $uri,
            'projects' => $projects,
            'footer'   => \App\View\Components\CommonLayout::footer(),
            'tags'     => $tagnames
        ]);
    }


    public function create()
    {
        //
    }


    public function show($name)
    {
        if (isset($_GET) && isset($_GET['id'])) {
            $project = project::find(filter_var($_GET['id'], FILTER_VALIDATE_INT));

            if (isset($project)) {
                $project->images = image::where([
                    'item_id'   => $project->id,
                    'item_type' => 'project'
                ])->get();

                $project->cover  = $project->images->where('cover', 1)->first();

                $users           = [];
                $tasks_total     = 0;
                $tasks_done      = 0;

                foreach ($project->stages as $stage) {
                    $stage_tasks      = $stage->tasks->count();
                    $stage_tasks_done = $stage->tasks->where('done', 1)->count();

                    $tasks_total     += $stage_tasks;
                    $tasks_done      += $stage_tasks_done;

                    $stage->progress  = $stage_tasks ? round($stage_tasks_done / $stage_tasks * 100) : 0;

                    foreach ($stage->tasks as $task) {
                        foreach ($task->users as $user) {
                            if (!in_array($user->id, array_keys($users))) {
                                $users[$user->id] = $user;
                            }
                        }
                    }
                }

                $current_stage = $project->stages->where('progress', '!=', 100)->first() !== null ?
                                 "Currently at: {$project->stages->where('progress', '!=', 100)->first()->name}" : (
                                 count($project->stages) ? 'Project completed!' : 'Damn, looks like we haven\'t started yet.');

                return view('common.project')->with([
                    'project'       => $project,
                    'updates'       => \App\Models\user_action::where([
                                        'item_id'   => $project->id,
                                        'item_type' => 'project'
                                    ])->orderBy('created_at', 'desc')->get(),

                    'users'         => $users,
                    'footer'        => \App\View\Components\CommonLayout::footer(),
                    'progress'      => $tasks_total ? $tasks_done / $tasks_total * 100 : 0,
                    'current_stage' => $current_stage
                ]);

            }
        }

        return redirect(route('projects'));
    }

    public function edit(project $project)
    {
        //
    }


    public function destroy(project $project)
    {
        //
    }
}
