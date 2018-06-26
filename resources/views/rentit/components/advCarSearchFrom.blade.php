<form class="form" method="post" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
    <div class="row">


            <div class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                <h2 class="section-title text-left no-margin">
                    {{-- <span>Recherche avancées de vehicules</span> --}}
                    <small>Inscrivez les différentes informations concernant les vehicules que vous cherchez.</small>

                </h2>

            </div>

        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <label for="leasing-begin-place">Lieu de récupération du vehicule: </label>
                <input type="text" class="form-control" value="{{isset($post_data) ? $post_data['leasing-begin-place'] : '' }}"  name="leasing-begin-place" id="leasing-begin-place" placeholder="Ou voulez vous recupérer le véhicule ?">
                <span class="form-control-icon"><i class="fa fa-user"></i></span>
                <small>
                    L'endroit ou vous voulez recupérer le vehicule afin de commencer la location.
                </small>
            </div>
        </div>

        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <label for="leasing-begin-date">Date de début de la location: </label>
                <input type="date" class="form-control" id=leasing-begin-date" name="leasing-begin-date" value="{{isset($post_data) ? $post_data['leasing-begin-date'] : ''}}">
                <span class="form-control-icon"><i class="fa fa-calendar"></i> </span>
            </div>
        </div>

        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <label for="leasing-begin-time">Heure de début de la location:</label>
                <input type="time" name="leasinig-begin-time" class="form-control" value="{{isset($post_data) ? $post_data['leasing-begin-time'] : ' ' }}" id="leasing-begin-time" placeholder="Entrez votre nom">
                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <label for="leasing-end-place">Lieu de dépot du vehicule: </label>
                <input type="text" class="form-control" value="{{isset($post_data) ? $post_data['leasing-begin-place'] : '' }}"  name="leasing-end-place" id="leasing-end-place" placeholder="Ou voulez vous recupérer le véhicule ?">
                <span class="form-control-icon"><i class="fa fa-user"></i></span>
                <small>
                    L'endroit ou vous voulez déposer le vehicule après la location.
                </small>
            </div>
        </div>

        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <label for="leasing-end-date">Date de fin de la location: </label>
                <input type="date" class="form-control" id=leasing-end-date" name="leasing-end-date" value="{{isset($post_data) ? $post_data['leasing-end-date'] : ''}}">
                <span class="form-control-icon"><i class="fa fa-calendar"></i> </span>
            </div>
        </div>

        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <label for="leasing-end-time">Heure de fin de la location:</label>
                <input type="time" name="leasinig-end-time" id="leasing-end-time" class="form-control" value="{{isset($post_data) ? $post_data['leasing-end-time'] : '' }}"  placeholder="Entrez votre nom">
                <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <b>Sélectionnez les marques que vous voulez avoir(à gauche) :</b>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="has-icon has-label">
                <select multiple="multiple" style="width:300px;height:350px" id="brands-select" name="my-select">

                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group ">
                <label>Année de fabrication:</label><br><br>
                <input type="hidden" class="form-control" id="years-slider" value="2000"><br><br>
                <span id="years-slider-info"></span>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="form-group has-icon has-label">
                <button type="submit" class="btn btn-block btn-submit ripple-effect btn-theme">Rechercher</button>
            </div>
        </div>
    </div>

</form>