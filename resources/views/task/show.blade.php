{{ $task->name }}
<br>
<a href="{{ route('task') }}">retour</a><br>
<a href="{{ route('task_delete', ['id' => $task->id]) }}">Supprimer la tache</a>