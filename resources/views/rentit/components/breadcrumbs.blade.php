<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs text-right">
    <div class="container">
        <div class="page-header">
            <h1>{{(isset($title)) ? $title : 'Titre'}}</h1>
        </div>
        <ul class="breadcrumb">



            @php
                $frontBreadcrumb = new \jlma\FrontBreadcrumb();
                $breadcrumbData = $frontBreadcrumb->allHistory( );
            @endphp


            @if( $breadcrumbData!=null )
                @php($count=count($breadcrumbData))
                @for( $i=0;$i<$count;++$i )
                    @php( $breadcrumbDataEntry=$breadcrumbData[$i] )
                    @if( $i!=$count-1 )
                        <li><a href="{{url($breadcrumbDataEntry['url'])}}">{{$breadcrumbDataEntry['name']}}</a></li>
                    @else
                        <li class="active">{{$breadcrumbDataEntry['name']}}</li>
                    @endif
                @endfor
            @endif


            {{-- <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Shortcodes</li>--}}

        </ul>
    </div>
</section>
<!-- /BREADCRUMBS -->