<ul class="breadcrumb-me">
    <li><a href="{{route('dashboard.index')}}">ABCTL Dashboard</a></li>
    @foreach($steps as $step)
        @if($loop->last)
            <li><span>{{$step['title']}}</span></li>
        @else
            <li><a href="{{route($step['route'])}}">{{$step['title']}}</a></li>
        @endif
    @endforeach
</ul>
