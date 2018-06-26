<!-- PAGE WITH SIDEBAR -->
<section class="page-section with-sidebar sub-page">
    <div class="container">
        <div class="row">
            <!-- CONTENT -->
            <div class="col-md-9 content car-listing" id="content">

                <!-- Car Listing -->
                    @include ('rentit/components/carListing/carList' , ['list_cars' => $list_cars ])
                <!-- /Car Listing -->


                @php
                if(isset($useSearch) && $useSearch==true){ /*s'il faut afficher les resultats d'une recherche*/
                    $route = 'carSearchResults';
                }else{
                    $route = 'showCars';
                }
                @endphp

                <!-- Pagination -->
                    <div class="pagination-wrapper">
                    <ul class="pagination">
                        @php
                        $nbPages = floor($cars_count / $nb_cars_per_page);
                        if( $cars_count % $nb_cars_per_page ) ++$nbPages;
                        @endphp

                        <li {{ ($current_page ==0 ) ? 'class=disabled' : ''  }} >
                            <a href="{{ $current_page!=0 ? route($route , ['page' => $current_page - 1]) : '#' }}"><i class="fa fa-angle-double-left"></i> Previous</a>
                        </li>
                        @for($i=0;$i<$nbPages;++$i)
                            <li {{ ($current_page ==$i ) ? 'class=active' : '' }}>
                                <a href="{{ $current_page != $i ? route($route , ['page' => $i ]):'#' }} ">{{ $i+1 }}</a>
                            </li>
                        @endfor
                        <li  {{ ($current_page >= $nbPages-1 ) ? 'class=disabled' : '' }}>
                            <a href="{{ $current_page != $nbPages-1 ? route($route , ['page' => $current_page + 1]) : '#' }}">Next <i class="fa fa-angle-double-right"></i></a>
                        </li>
{{--
                        <li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i> Previous</a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">Next <i class="fa fa-angle-double-right"></i></a></li>--}}
                    </ul>
                </div>
                <!-- /Pagination -->

            </div>
            <!-- /CONTENT -->

            <!-- SIDEBAR -->
            <aside class="col-md-3 sidebar" id="sidebar">
                <!-- widget -->
                <div class="widget shadow widget-find-car">
                    <h4 class="widget-title">Rechercher offre</h4>
                    <div class="widget-content">
                        <p style="color:red">
                            @include('rentit/components/validation')
                        </p>

                        <!-- Search form -->
                        <div class="form-search light">
                            <form action="{{route('doSearchCars')}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group has-icon has-label">
                                    <label for="formSearchUpLocation3">Lieu recup. du vehicule</label>
                                    <input type="text" class="form-control" name="leasing-place" id="formSearchUpLocation3" placeholder="Ou recupérer voulez vous le vehicule ?">
                                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                </div>

                                <div class="form-group has-icon has-label">
                                    <label for="formSearchOffLocation3">Lieu dépôt du vehicule</label>
                                    <input type="text" class="form-control" id="formSearchOffLocation3" name="leasing-drop-place" placeholder="Ou voulez vous déposer le vehicule ?">
                                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                </div>

                                <div class="form-group has-icon has-label">
                                    <label for="formSearchUpDate3">Date recup. du vehicule</label>
                                    <input type="date" class="form-control" name="leasing-begin-date" id="formSearchUpDate3" >
                                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                </div>

                                <div class="form-group has-icon has-label selectpicker-wrapper">
                                    <label>Heure de récup. du vehicule</label>
                                    <input class="form-control" type="time" name="leasing-begin-time" data-live-search="true" data-width="100%"
                                            data-toggle="tooltip" >
                                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                </div>

                                <div class="form-group has-icon has-label">
                                    <label for="formSearchUpDate3">Date dépot du vehicule</label>
                                    <input type="date" class="form-control" name="leasing-end-date" id="formSearchUpDate3" >
                                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                </div>

                                <div class="form-group has-icon has-label selectpicker-wrapper">
                                    <label>Heure de dépôt du vehicule</label>
                                    <input class="form-control" type="time" name="leasing-end-time" data-live-search="true" data-width="100%"
                                            data-toggle="tooltip" >
                                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                </div>

                                <div>
                                    <i class="fa fa-plus-circle"></i><a href="#"> Recherche avancée</a>
                                </div>


                                <button type="submit" id="formSearchSubmit3" class="btn btn-submit btn-theme btn-theme-dark btn-block">Rechercher </button>

                            </form>
                        </div>
                        <!-- /Search form -->
                    </div>
                </div>
                <!-- /widget -->
                <!-- widget price filter -->
               {{-- <div class="widget shadow widget-filter-price">
                    <h4 class="widget-title">Price</h4>
                    <div class="widget-content">
                        <div id="slider-range"></div>
                        <input type="text" id="amount" readonly />
                        <button class="btn btn-theme btn-theme-dark">Filter</button>
                    </div>
                </div>--}}
                <!-- /widget price filter -->
                <!-- widget testimonials -->
                <div class="widget shadow">
                    <div class="widget-title">Testimonials</div>
                    <div class="testimonials-carousel">
                        <div class="owl-carousel" id="testimonials">
                            <div class="testimonial">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                        <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                        <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="testimonial-text">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</div>
                                        <div class="testimonial-name">John Doe <span class="testimonial-position">Co- founder at Rent It</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /widget testimonials -->
                <!-- widget helping center -->
                <div class="widget shadow widget-helping-center">
                    <h4 class="widget-title">Helping Center</h4>
                    <div class="widget-content">
                        <p>Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.</p>
                        <h5 class="widget-title-sub">+90 555 444 66 33</h5>
                        <p><a href="mailto:support@supportcenter.com">support@supportcenter.com</a></p>
                        <div class="button">
                            <a href="#" class="btn btn-block btn-theme btn-theme-dark">Support Center</a>
                        </div>
                    </div>
                </div>
                <!-- /widget helping center -->
            </aside>
            <!-- /SIDEBAR -->

        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
