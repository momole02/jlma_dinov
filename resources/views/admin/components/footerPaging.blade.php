
{{--
    $route = route correspondante à l'affichage
--}}
<ul class="pagination pagination-sm no-margin pull-right">

    @if(isset($page_list))

        @if($current_page>0 )
            <li><a href="{{route($route , ['page' => $current_page-1])}}">«</a></li>
        @endif

        @foreach($page_list as $pageEntry)
            <li>
                @if($pageEntry['num']!==$current_page+1)
                    <a href="{{$pageEntry['link']}}">{{ $pageEntry['num'] }}</a>
                @else
                    <a href="{{$pageEntry['link']}}"><b>{{ $pageEntry['num'] }}</b></a>
                @endif
            </li>
        @endforeach
        @if($current_page<count($page_list)-1 )
            <li><a href="{{route($route, ['page' => $current_page+1])}}">»</a></li>
        @endif

    @endif
</ul>