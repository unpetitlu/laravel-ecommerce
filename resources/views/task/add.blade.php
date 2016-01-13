@if(count($errors->all()))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('task_store') }}" method="POST">
    {{ csrf_field() }}

    <input type="text" name="name">

    <button>Ajouter une tache</button>
</form>