<section id="faqs" class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>Les questions les plus posées</small>
            <span>FAQS</span>
        </h2>

        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                <!-- FAQ -->
                <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">

                    @php
                        $i=0;
                    @endphp


                    @isset( $faqs )
                        @for($i=0;$i<min(3,count($faqs));++$i)

                            @php $faqEntry=$faqs[$i]; @endphp


                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$i+1}}">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i+1}}" aria-expanded="false" aria-controls="collapse{{$i+1}}">
                                            <span class="dot"></span> {{$faqEntry->question_faq}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$i+1}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$i+1}}">
                                    <div class="panel-body">
                                        {{$faqEntry->reponse_faq}}
                                    </div>
                                </div>
                            </div>

                        @endfor

                    @endisset


                    <!-- /faq3 -->
                </div>
                <!-- /FAQ -->
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">
                <!-- FAQ -->
                <div class="panel-group accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                    <!-- faq1 -->
                    @isset( $faqs )
                        @for($i=3;$i<min(6,count($faqs));++$i)

                            @php $faqEntry=$faqs[$i]; @endphp

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading2{{$i+1-3}}">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion{{$i+1-3}}" href="#collapse2{{$i+1-3}}" aria-expanded="false" aria-controls="collapse2{{$i+1-3}}">
                                            <span class="dot"></span> {{$faqEntry->question_faq}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2{{$i+1-3}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2{{$i+1-3}}" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        {!! nl2br($faqEntry->reponse_faq) !!}
                                    </div>
                                </div>
                            </div>

                    @endfor

                @endisset


                </div>
                <!-- /FAQ -->
            </div>
        </div>

    </div>
</section>