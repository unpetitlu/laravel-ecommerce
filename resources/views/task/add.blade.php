Nombre d'utilisateur en BDD : {{ $count }}

@if(count($errors->all()))
 {{ dump($errors) }}
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('task_store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="text" name="name" value="{{ Request::old('name') }}">
    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}

    <input type="file" name="photo[]">
    <input type="file" name="photo[]">

    <button>Ajouter une tache</button>
</form>


{{ \Carbon\Carbon::setLocale('fr') }}
{{ \Carbon\Carbon::createFromTimeStamp(strtotime('2016-01-01'))->diffForHumans() }}
{{ \Carbon\Carbon::today()->format('l') }}