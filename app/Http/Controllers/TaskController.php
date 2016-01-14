<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Validator;
use Mail;


class TaskController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function index()
    {
      //Envoi de mail

      /*
      Mail::send('emails.test', ['user' => 'ludo'], function ($message) {
        $message->from('ludo.troiswa@gmail.com', 'Your Application');

        $message->to('ludo.troiswa@gmail.com')->subject('Your Reminder!');
      });
      */

      $tasks = Task::all();

      return view('task.index', compact('tasks'));
    }


    public function show($id)
    {
      $task = Task::findOrFail($id);

      $user = User::find(1);
      foreach($user->tasks as $t)
      {
        dump($t->name);
      }

      dump($task->user->name);

      foreach($task->category as $c)
      {
        dump($c->name);
      }

      return view('task.show', compact('task'));
    }

    public function add()
    {
        return view('task.add');
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),
        [
          'name' => 'required|min:2|max:70',
        ],
        [
          'name.required' => 'attention pour le name',
          'required' => 'attention globale'
        ]);

        if ($validator->fails()) {
          return redirect()->route('task_add')
            ->withInput()
            ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect()->route('task')->with('success', 'Enregistrement tache');
    }

    public function delete($id)
    {
      Task::findOrFail($id)->delete();

      return redirect()->route('task')->with('success', 'suppression');

    }
}
