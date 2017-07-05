{!!$page->content!!}

<br>
@if(count($news) > 0)
    @foreach($news as $article)
        {{$article->title}}<br>
    @endforeach
@endif
<br>
@if(count($items) > 0)
    @foreach($items as $item)
        {{$item->title}}<br>
    @endforeach
@endif