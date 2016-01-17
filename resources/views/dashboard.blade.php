@foreach($tweets as $t)
  <p>{!! App\Http\Services\Twitter::autolink($t->text) !!}</p>
@endforeach