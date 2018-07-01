<section id="find-best" class="page-section no-padding slider">
    <div class="container full-width">

        <div class="main-slider">
            <div class="owl-carousel" id="main-slider">

                <!-- Slide 1 -->
                <div class="item slide1 ver1">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
                                        <h2 class="caption-title">Cherchez l'offre qui vous correspond</h2>
                                        <h3 class="caption-subtitle">Recherche D'offre</h3>
                                        <!-- Search form -->
                                        <div class="row">
                                            <div class="col-sm-12 col-md-10 col-md-offset-1">

                                                <div class="form-search dark">
                                                        @if($errors->any())
                                                        <b> Remplissez correctement les champs</b>
                                                            @foreach($errors->all() as $err)
                                                                {{$err}}<br>
                                                            @endforeach
                                                        @endif
                                                    <form action="{{route('doSearchCars')}}" method="post">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <div class="form-title">
                                                            <i class="fa fa-globe"></i>
                                                            <h2>Cherchez les differentes offre en fonction de vos critères</h2>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpLocation">Lieu de recupération du vehicule</label>
                                                                        <input type="text" class="form-control" name="leasing-place" id="formSearchUpLocation" placeholder="Ou voulez vous prendre le vehicule">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchUpDate">Date de recupération du vehicule</label>
                                                                        <input type="date" class="form-control" name="leasing-begin-date"id="formSearchUpDate" placeholder="dd/mm/yyyy">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Heure de recupération du vehicule</label>
                                                                        <input  name="leasing-begin-time" type="time"
                                                                                class="form-control" data-live-search="true" data-width="100%"
                                                                                data-toggle="tooltip" title="Select">

                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffLocation">Lieu de dêpot de vehicule</label>
                                                                        <input name="leasing-end-place" type="text" class="form-control" id="formSearchOffLocation" placeholder="Ou deposerez vous le vehicule">
                                                                        <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate">Date du dépôt du vehicule : </label>
                                                                        <input type="date" name="leasing-end-date" class="form-control" id="formSearchOffDate" placeholder="dd/mm/yyyy">
                                                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                        <label>Heure de depôt du vehicule</label>
                                                                        <input  name="leasing-end-time" type="time"
                                                                                class="form-control" data-live-search="true" data-width="100%"
                                                                                data-toggle="tooltip" title="Select">
                                                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i> <a href="#"></a>
                                                                    <button type="submit" id="formSearchSubmit" class="btn btn-submit btn-theme pull-right">Lancer la recherche</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /Search form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 1 -->

                <!-- Slide 2 -->
                <div class="item slide2 ver2">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
                                        <!-- Search form -->
                                        <div class="form-search light">
                                            <form action="#">
                                                <div class="form-title">
                                                    <i class="fa fa-globe"></i>
                                                    <h2>Search for Cheap Rental Cars Wherever Your Are</h2>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-12">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpLocation2">Picking Up Location</label>
                                                                <input type="text" class="form-control" id="formSearchUpLocation2" placeholder="Airport or Anywhere">
                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffLocation2">Dropping Off Location</label>
                                                                <input type="text" class="form-control" id="formSearchOffLocation2" placeholder="Airport or Anywhere">
                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpDate2">Picking Up Date</label>
                                                                <input type="text" class="form-control datepicker" id="formSearchUpDate2" placeholder="dd/mm/yyyy">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>Picking Up Hour</label>
                                                                <select
                                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">
                                                                    <option>20:00 AM</option>
                                                                    <option>21:00 AM</option>
                                                                    <option>22:00 AM</option>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate2">Dropping Off Date</label>
                                                                <input type="text" class="form-control datepicker" id="formSearchOffDate2" placeholder="dd/mm/yyyy">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>Dropping Off Hour</label>
                                                                <select
                                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">
                                                                    <option>20:00 AM</option>
                                                                    <option>21:00 AM</option>
                                                                    <option>22:00 AM</option>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-submit">
                                                    <div class="container-fluid">
                                                        <div class="inner">
                                                            <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                            <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme ripple-effect pull-right">Find Car</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Search form -->

                                        <h2 class="caption-subtitle">Find Your Car!<br/> Rent A Car Theme</h2>
                                        <p class="caption-text">
                                            Vivamus in est sit amet risus rutrum facilisis sed ut mauris. Aenean aliquam ex ut sem aliquet, eget vestibulum erat pharetra. Maecenas vel urna nulla. Mauris non risus pulvinar.
                                        </p>
                                        <p class="caption-text">
                                            <a class="btn btn-theme ripple-effect btn-theme-md" href="#">See All Vehicles</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 2 -->

                <!-- Slide 3 -->
                <div class="item slide3 ver3">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
                                        <!-- Search form -->
                                        <div class="form-search light">
                                            <form action="#">
                                                <div class="form-title">
                                                    <i class="fa fa-globe"></i>
                                                    <h2>Search for Cheap Rental Cars Wherever Your Are</h2>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-12">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpLocation3">Picking Up Location</label>
                                                                <input type="text" class="form-control" id="formSearchUpLocation3" placeholder="Airport or Anywhere">
                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffLocation3">Dropping Off Location</label>
                                                                <input type="text" class="form-control" id="formSearchOffLocation3" placeholder="Airport or Anywhere">
                                                                <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchUpDate3">Picking Up Date</label>
                                                                <input type="text" class="form-control datepicker" id="formSearchUpDate3" placeholder="dd/mm/yyyy">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>Picking Up Hour</label>
                                                                <select
                                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">
                                                                    <option>20:00 AM</option>
                                                                    <option>21:00 AM</option>
                                                                    <option>22:00 AM</option>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate3">Dropping Off Date</label>
                                                                <input type="text" class="form-control datepicker" id="formSearchOffDate3" placeholder="dd/mm/yyyy">
                                                                <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>Dropping Off Hour</label>
                                                                <select
                                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">
                                                                    <option>20:00 AM</option>
                                                                    <option>21:00 AM</option>
                                                                    <option>22:00 AM</option>
                                                                </select>
                                                                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-submit">
                                                    <div class="container-fluid">
                                                        <div class="inner">
                                                            <i class="fa fa-plus-circle"></i> <a href="#">Advanced Search</a>
                                                            <button type="submit" id="formSearchSubmit3" class="btn btn-submit ripple-effect btn-theme pull-right">Find Car</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Search form -->

                                        <h2 class="caption-title">For rental Cars</h2>
                                        <h3 class="caption-subtitle">Best Deals</h3>
                                        <p class="caption-text">
                                            Sales Up  %45 Off<br/>
                                            All Rental Cars Start from  49$
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 3 -->

                <!-- Slide 4 -->
                <div class="item slide4 ver4">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
                                        <h2 class="caption-title">For rental Cars</h2>
                                        <h3 class="caption-subtitle"><span>Best Deals</span></h3>
                                        <p class="caption-text">
                                            Sales Up  %45 Off<br/>
                                            All Rental Cars Start from  49$
                                        </p>
                                        <p class="caption-text">
                                            <a class="btn btn-theme ripple-effect btn-theme-md" href="#">See All Vehicles</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 4 -->

            </div>
        </div>

    </div>
</section>



