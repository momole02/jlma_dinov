<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs text-right">
    <div class="container">
        <div class="page-header">
            <h1>{{(isset($title)) ? $title : 'Titre'}}</h1>
        </div>
        <ul class="breadcrumb">

            @if(isset($pages))
                @foreach($pages as $page_name => $page_info)
                    <li {{ ($page_info['active']==true) ? 'class=active' : '' }}>
                        @if($page_info['active']==false)
                            <a href="{{ $page_info['link'] }}" >{{ $page_name }}</a>
                        @else
                            {{ $page_name }}
                        @endif
                    </li>
                @endforeach
            @endif

            {{-- <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Shortcodes</li>--}}

        </ul>
    </div>
</section>
<!-- /BREADCRUMBS -->