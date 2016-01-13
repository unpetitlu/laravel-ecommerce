<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Models\Task;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    public function show()
    {
      $tasks = Task::all();

      return view('task.tasks', compact('tasks'));
    }

    public function add()
    {
        return view('task.add-task');
    }

    public function addTraitement(Request $request)
    {
      $validator = Validator::make($request->all(),
        [
          'name' => 'required|min:2|max:5',
        ],
        [
          'name.required' => 'attention pour le name',
          'required' => 'attention globale'
        ]);

        if ($validator->fails()) {
          return redirect()->route('taskadd')
            ->withInput()
            ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect()->route('taskshow');
    }

    public function delete()
    {

    }
}
