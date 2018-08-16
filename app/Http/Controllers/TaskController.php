<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;
    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    public function show(Request $request) {
        return view('tasks.task', [
            'task' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'date_completion' => 'required|date_format:Y-m-d'
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
            'date_completion' => $request->date_completion,
        ]);

        return redirect('/tasks');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  Task  $task
     * @return Response
     */

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'date_completion' => 'required|date_format:Y-m-d'
        ]);

        $input = $request->all();

        $task->fill($input)->save();
        return redirect('/task/'.$id);

    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
