@if (session('success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <i class="fa fa-times"></i> {{ session('success') }}
    </div>
@endif

@forelse ($tasks as $t)
    <li>
      <a href="{{ route('task_show', ['id' => $t->id]) }}">{{ $t->name }}</a>
    </li>
@empty
    <p>No task</p>
@endforelse


<a href="{{ route('task_add') }}">Ajouter une tache</a>