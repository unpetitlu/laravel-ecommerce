@forelse ($tasks as $t)
    <li>{{ $t->name }}</li>
@empty
    <p>No task</p>
@endforelse