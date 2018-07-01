<section id="help-desk" class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>Avez vous besoin de quelque chose ?</small>
            <span>Consultez le service client </span>
        </h2>

        <!-- Team row -->
        <div class="row">


            @isset( $customer_services )


                @for( $i=0;$i<min(4,count($customer_services));++$i)
                    @php
                        $service = $customer_services[$i];
                    @endphp
                    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                        <div class="thumbnail thumbnail-team no-border no-padding">
                            <div class="media">
                                <img src="{{$service->photo_serv_client}}" alt=""/>
                            </div>
                            <div class="caption">
                                <h4 class="caption-title">{{$service->nom_serv_client}} ( {{$service->surnom_serv_client}})  <small> {{$service->job_serv_client}}</small></h4>
                                <ul class="team-details">
                                    <li>Tel: {{$service->tel_serv_client}}</li>
                                    <li>Mail:<a href="mailto:{{$service->email_serv_client}}">{{$service->email_serv_client}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endfor
            @endisset

        </div>
        <!-- /Team row -->

    </div>
</section>