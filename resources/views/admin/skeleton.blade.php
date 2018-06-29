{{--
    yields :

    title => titre de la page
    headerTitle => Titre du haut
    headerDescription => Description
    breadcrumbs => Système de breadcrumbs
    content  => Contenu de la page

--}}

        <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    @yield('extra-css')

    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/skin-blue.min.css') }}">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">

            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img style="width:70px" src="{{asset('rentit/img/logo-jlma.png')}}"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img style="width:70px" src="{{asset('rentit/img/logo-jlma.png')}}"></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning" id="notifCount"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><span id="notifHeaderMsg">AAAAAAA</span></li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu" id="notifContent">
                                    {{--<li><!-- start notification -->--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                    <!-- end notification -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('adminDoLogout')}}" class="btn btn-default btn-flat">Se déconnecter</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>

                @php


                    if(isset($choosed_menu)){
                        foreach ( $choosed_menu as $menu_items ){
                            if($menu_items[2]==null){ /*il n'y a pas de sous menus*/
                                print '<li><a href="'.$menu_items[1].'"><i class="fa fa-link"></i> <span>'.$menu_items[0].'</span></a></li>';
                            }else{
                                $str='<li class="treeview">
                                <a href="'.$menu_items[1].'"><i class="fa fa-link"></i> <span>'.$menu_items[0].'</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">';

                                $sub_menus = $menu_items[2];
                                foreach( $sub_menus as $sub_menu_items ){
                                    $str .= '<li><a href="'.$sub_menu_items[1].'">'.$sub_menu_items[0].'</a></li>';
                                }
                                $str.='</ul>';
                                print($str);
                            }
                        }
                    }
                @endphp

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <section class="content-header">



            <h1>
                @php
                    $adminBreadcrumb = new \jlma\AdminBreadcrumb();

                    $returnLink = $adminBreadcrumb->previousPage( route('home') );
                @endphp

                <a href="{{$returnLink}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>   Retour</a>

                @yield('headerTitle')
                <small>@yield('headerDescription')</small>
            </h1>
            {{--<h1>--}}
            {{--Page Header--}}
            {{--<small>Optional description</small>--}}
            {{--</h1>--}}

            @yield('breadcrumbs')

            <ol class="breadcrumb">

                @php
                    $adminBreadcrumb = new \jlma\AdminBreadcrumb();
                    $breadcrumbData = $adminBreadcrumb->allHistory();
                @endphp
                @if( $breadcrumbData!=null )
                    @php($count = count($breadcrumbData))

                    @for( $i = 0 ; $i<$count; ++$i)

                        @php($breadcrumbDataEntry=$breadcrumbData[$i])
                        @if( $i!=$count-1 )
                            <li><a href="{{url($breadcrumbDataEntry['url'])}}"><i class="fa fa-dashboard"></i> {{$breadcrumbDataEntry['name']}}</a></li>
                        @else
                            <li class="active">{{$breadcrumbDataEntry['name']}}</li>
                        @endif
                    @endfor
                @endif
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                {{--<li class="active">Here</li>--}}
            </ol>

            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
            {{--<li class="active">Here</li>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Espace admin JLMA
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 <a href="#">Dinov</a>.</strong> All rights reserved.
    </footer>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

@yield('extra-scripts')


<script type="text/javascript">

    $(function(){


        setInterval( function(){
            $.ajax({
                url:'/admin/usernotifs',
                accepts:'application/json'
            }).done((
                function( data ){
                    var notifs = data;
                    // [
                    //     {"link":"http:\/\/localhost:8000\/admin\/eventCard\/inscriptio-29062018113723","title":"Inscription( MARCO )","date":"2018-06-29"},
                    //     {"link":"http:\/\/localhost:8000\/admin\/eventCard\/inscriptio-29062018113723","title":"Inscription( MARCO )","date":"2018-06-29"}
                    // ]

                    $('#notifCount').html('');
                    if( notifs.length > 0 ) {
                        $('#notifCount').html(notifs.length);
                    }
                    $('#notifHeaderMsg').html('Vous avez '+notifs.length+' notifications');
                    $('#notifContent').html('');
                    for (var i=0;i<Math.min(10,notifs.length);++i){
                        var notifEntry = notifs[i];
                        var liTag = '<li><a href="'+notifEntry.link+'"><i class="fa fa-calendar"></i>['+notifEntry.date+']  '+notifEntry.title+'</a></li>';
                        $('#notifContent').append(liTag);
                    }
                }));
        } , 1500);


    });


</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>