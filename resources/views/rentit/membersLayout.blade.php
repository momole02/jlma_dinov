@extends('rentit/layout')

@section('title')
    JLMA - Espace membres
@endsection

@section('contents')

    @include('rentit/components/breadcrumbs' , [
        'title' => 'Espace locataires',
        'pages' => [
            'Accueil' => ['active' => false , 'link' => route('home')],
            'Espace locataires' => ['active' => true , 'link' => '#']
        ]
    ])


    <section class="page-section with-sidebar">
        <div class="container">
            <div class="row">
                <!-- SIDEBAR -->
                <aside class="col-md-3 sidebar" id="sidebar">

                    <div class="widget shadow">
                        <div class="widget-title">Avatar</div>
                        <div class="widget-content">
                            <div align="center">
                                @php
                                    if( $client_data->photo != 'non-assigne' )
                                        $photo=$client_data->photo;
                                    else
                                        $photo='rentit/img/preview/avatars/testimonial-140x140.jpg';
                                @endphp

                                <img src="{{asset($photo)}}" class="img img-circle img-responsive" alt="photo" >
                            </div>
                            <div align="center">
                                {{$account_data->login}}<br/>
                            </div>
                        </div>
                    </div>



                </aside>

                <div class="col-md-9 content" id="content">

                    @yield('content' , 'Contenu')

                </div>

            </div>
        </div>
    </section>
@endsection
