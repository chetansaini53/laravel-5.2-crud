@foreach($recs as $rec)
<div style="
    clear: both;
">
   <a href="{{ route('tasks.show', $rec->seo_url) }}" class="btn btn-info"> <h3>{{ $rec->title }}</h3></a>
    <p>{{ $rec->description}}</p>
    <hr>
</div>
@endforeach