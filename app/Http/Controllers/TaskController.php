<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Image;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Mail;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth', ['only' => [
        //     'add',
        // ]]);
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

      //dump($task->user->name);

      foreach($task->category as $c)
      {
        dump($c->name);
      }

      // Save manytomany
      // $catEssai = new Category();
      // $catEssai->name = "bonjour";
      // $task->category()->save($catEssai);


      // Save onetomany
      // $task = new Task();
      // $task->name = "essai avec un user";
      // $userEssai = new User();
      // $userEssai->name = "bonjour";
      // $userEssai->email = "bonjour@gmail.com";
      // $userEssai->password = "coucou";
      // $userEssai->save();
      // $task->user()->associate($userEssai);
      // $task->save();
      // die('ok');

      return view('task.show', compact('task'));
    }

    public function add()
    {
        return view('task.add');
    }

    public function store(Request $request)
    {
      $rules =
        [
          'name' => 'required|min:2|max:70',
        ];
      $rulesTranslations = 
        [
          'name.required' => 'attention pour le name',
          'required' => 'attention globale'
        ];

      $nbr = count($request->file('photo')) - 1;
      foreach(range(0, $nbr) as $index) {
        $rules['photo.'.$index] = 'image';
        $rulesTranslations['photo.'.$index.'.image'] = "ce n'est pas une image";
      }


      $validator = Validator::make($request->all(), $rules, $rulesTranslations);
      
      /*
      $validator = Validator::make($request->all(),
        [
          'name' => 'required|min:2|max:70',
        ],
        [
          'name.required' => 'attention pour le name',
          'required' => 'attention globale'
        ]);
      */

        if ($validator->fails()) {
          return redirect()->route('task_add')
            ->withInput()
            ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            foreach($files as $f)
            {
              $filename = str_random(10).'.'.$f->getClientOriginalExtension(); // Récupère le nom original du fichier
              $destinationPath = public_path().'/uploads/tasks'; // Indique où stocker le fichier
              $f->move($destinationPath, $filename); // Déplace le fichier
              $image = new Image();
              $image->name = $filename;
              $image->save();
              $task->images()->save($image);
            }
        }

        return redirect()->route('task')->with('success', 'Enregistrement tache');
    }

    public function delete($id)
    {
      $task = Task::findOrFail($id);

      $this->authorize('destroy', $task);

      Task::findOrFail($id)->delete();

      return redirect()->route('task')->with('success', 'suppression');

    }
}
