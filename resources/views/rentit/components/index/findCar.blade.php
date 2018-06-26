<section id="find-car-new" class="page-section find-car dark">
    <div class="container">

        <form action="#" class="form-find-car">
            <div class="row">

                <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                    <h2 class="section-title text-left no-margin">
                        <small>Great Rental Cars</small>
                        <span>Find your car</span>
                    </h2>

                </div>
                <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                    <div class="form-group has-icon has-label">
                        <label for="formFindCarLocation">Picking Up Location</label>
                        <input type="text" class="form-control" id="formFindCarLocation" placeholder="Airport or Anywhere">
                        <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                    </div>
                </div>
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                    <div class="form-group has-icon has-label">
                        <label for="formFindCarDate">Picking Up Date</label>
                        <input type="text" class="form-control datepicker" id="formFindCarDate" placeholder="dd/mm/yyyy">
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                    <div class="form-group has-icon has-label">
                        <label for="formFindCarCategory">Price Category</label>
                        <input type="text" class="form-control" id="formFindCarCategory" placeholder="Select Car Group">
                        <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                    </div>
                </div>
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                    <div class="form-group">
                        <button type="submit" id="formFindCarSubmit" class="btn btn-block btn-submit ripple-effect btn-theme">Find Car</button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>


<!-- GOOGLE MAP -->
<section class="page-section no-padding no-bottom-space-off">
    <div class="container full-width">

        <!-- Google map -->
        <div class="google-map">
            <div id="map-canvas"></div>
        </div>
        <!-- /Google map -->

    </div>
</section>
