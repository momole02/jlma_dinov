@extends('rentit/layout')

@section('title')
    -- JeLoueMonAuto --
@endsection

@section('contents')

    <!-- BREADCRUMBS -->

    @yield('breadcrumbs' , 'breadcrumbs')

    <!-- /BREADCRUMBS -->

    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar">
        <div class="container">
            <div class="row">
                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar" id="sidebar">

                    @yield('widgets' , 'widgets');

                </aside>
                <!-- /SIDEBAR -->

                <!-- CONTENT -->
                <div class="col-md-9 content" id="content">

                    @yield('innerContent', 'innerContent')

                </div>
                <!-- /CONTENT -->

            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->
@endsection