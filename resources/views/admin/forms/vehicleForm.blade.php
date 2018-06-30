{{-- Formulaire de vehicule --}}
{{--

    Variables valides :

    $form_target =>  lien de destination du formulaire
    $car_brand => marque du vehicule
    $car_model => modèle du vehicule
    $car_registration_number => matricule du vehicule
    $car_year => année de fabrication du vehicule
    $car_registration_year => année d'immatriculation du vehicule
    $car_places_count => nombre de places
    $car_doors_count => nombre de portes
    $car_km => kilométrage du vehicule
    $car_energy => Type d'énergie
    $car_consumption => consommation de la voiture
    $car_horses_count => nombre de chevaux de la voiture
    $car_country => Pays de fabrication
    $car_color => Couleur du vehicule
    $car_description => Description du vehicule
    $car_type => Type du vehicule
    $car_speed_box => Boite à vitesse
    $car_day_price=> Prix de la location /Jour
    $car_week_price=> Prix de la location /Semaine
    $car_month_price => Prix de la location /Mois
    $car_year_price => Prix de la location /An

    $car_slug => slug de modification
    $form_sumbit_title => initulé du bouton de soummission

    $brand_list => contient un ensemble de tableaux associatifs sous la forme suivante
    [ 'name' => nom de la marque , 'value'=> identifiant de la marque(BDD) ]

    $model_list => contient un ensemble de tableaux associatifs sous la forme suivante
    ['name' => nom du modèle, 'value'=>identifiant du  modèle(BDD) ]

    $energy_list => contient l'ensemble des energies
    ['name' => nom de l'énergie, 'value'=>identifiant de l'énergie(BDD) ]

    $type_list => contient l'ensemble des types de vehicules
    ['name' => nom du type , 'value'=>du type(BDD) ]

    $speed_box_list => contient l'ensemble des boites de vitesses
    ['name' => nom, 'value'=>identifiant  ]

 --}}
<form class="form-horizontal" method="post" action="{{isset($form_target) ? $form_target : '#'}}">



    @isset($car_slug)
            <input type="hidden" name="car-slug" value="{{$car_slug}}">
    @endisset

    @if($errors->any())
        <ul>
            @foreach( $errors->all() as $err )
                <li>{{$err}}</li>
            @endforeach
        </ul>
    @endif

    <input type="hidden" value="{{csrf_token()}}" name="_token">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="car-brand" class="col-sm-2 control-label">Marque(*)</label>
                <div class="col-sm-5">
                    <select class="form-control select2" id="car-brand" name="car-brand" style="width: 100%;">
                        @isset( $brand_list )
                            @php($presenceFlag=FALSE)
                            @foreach( $brand_list as $brandEntry )

                                @if( isset($car_brand)  && $brandEntry['name']===$car_brand )
                                    @php($presenceFlag=TRUE)
                                    <option value="{{$brandEntry['value']}}" selected="selected">{{$brandEntry['name']}}</option>
                                @else
                                    <option value="{{$brandEntry['value']}}">{{$brandEntry['name']}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="car-other-brand" placeholder="Autre marque"
                           value="{{ (isset($car_brand) && (!isset($presenceFlag) || $presenceFlag==FALSE))?$car_brand:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-model" class="col-sm-2 control-label" >Modèle(*)</label>
                <div class="col-sm-5">
                    <select class="form-control select2" id="car-model" name="car-model" style="width: 100%;">
                        @isset( $model_list )
                            @php($presenceFlag=FALSE)
                            @foreach( $model_list as $modelEntry )
                                @if( isset($car_model) && $car_model==$modelEntry['name'] )
                                    @php($presenceFlag=TRUE)
                                    <option value="{{$modelEntry['value']}}" selected="selected">{{$modelEntry['name']}}</option>
                                @else
                                    <option value="{{$modelEntry['value']}}">{{$modelEntry['name']}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="car-other-model" placeholder="Autre modèle"
                           value="{{ (isset($car_model) && (!isset($presenceFlag) || $presenceFlag==FALSE))?$car_model:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-registration-number" class="col-sm-2 control-label" style="text-align:left">Matricule(*)</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="car-registration-number" name="car-registration-number" placeholder="Immatriculation"
                    value="{{(isset($car_registration_number)) ? $car_registration_number : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-country" class="col-sm-2 control-label">Pays(*)</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="car-country" name="car-country" placeholder="Le pays d'origine(facultatif)"
                    value="{{isset($car_country) ? $car_country : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-year" class="col-sm-2 control-label"> A.F </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="car-year" name="car-year" placeholder="L'année de fabrication du vehicule"
                    value="{{isset($car_year) ? $car_year:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-registration-year" class="col-sm-2 control-label">A.I </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="car-registration-year" name="car-registration-year" placeholder="L'année d'immatriculation du vehicule"
                    value="{{isset($car_registration_year) ? $car_registration_year : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-color" class="col-sm-2 control-label">Couleur </label>
                <div class="col-sm-10">
                    <input required type="text" id="car-color" name="car-color" class="form-control my-colorpicker1 colorpicker-element"
                    value="{{isset($car_color)?$car_color:''}}">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="car-day-price" style="font-size:12px" class="col-sm-2 control-label">Prix/Jour(*)</label>
                <div class="col-sm-10">
                    <input required type="number" id="car-day-price" name="car-day-price" class="form-control" placeholder="Prix de la location par jour en F/CFA"
                           value="{{isset($car_day_price)?$car_day_price:''}}">
                </div>
            </div>

            <div class="form-group">
                <label for="car-week-price" style="font-size:12px" class="col-sm-2 control-label">Prix/Jour(*)</label>
                <div class="col-sm-10">
                    <input required type="number" id="car-week-price" name="car-week-price" class="form-control" placeholder="Prix de la location par jour en F/CFA"
                           value="{{isset($car_week_price)?$car_week_price:''}}">
                </div>
            </div>

            <div class="form-group">
                <label for="car-month-price"  style="font-size:12px"  class="col-sm-2 control-label">Prix /Mois(*)</label>
                <div class="col-sm-10">
                    <input required type="number" id="car-month-price" name="car-month-price" class="form-control" placeholder="Prix de la location par mois en F/CFA"
                           value="{{isset($car_month_price)?$car_month_price:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-year-price" style="font-size:12px"  class="col-sm-2 control-label">Prix /An(*) </label>
                <div class="col-sm-10">
                    <input required type="number" id="car-year-price" name="car-year-price" class="form-control" placeholder="Prix de la location par an en F/CFA"
                           value="{{isset($car_year_price)?$car_year_price:''}}">
                </div>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="form-group">
                <label for="car-places-count" class="col-sm-2 control-label">N.places(*)</label>
                <div class="col-sm-5">
                    <input required type="number" class="form-control" id="car-places-count" placeholder="Nombre de places" name="car-places-count" min="2"
                    value="{{isset($car_places_count) ? $car_places_count : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-doors-count" class="col-sm-2 control-label">N.portes(*)</label>
                <div class="col-sm-5">
                    <input required type="number" class="form-control" id="car-doors-count" name="car-doors-count" placeholder="Nombre de portes" min="2"
                    value="{{isset($car_doors_count) ? $car_doors_count:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-km" class="col-sm-2 control-label">Kilom.(*)</label>
                <div class="col-sm-5">
                    <input required type="number" class="form-control" id="car-km" name="car-km" placeholder="Kilométrage(km)" min="10"
                    value="{{isset($car_km) ? $car_km:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-energy" class="col-sm-2 control-label">Energie(*)</label>
                <div class="col-sm-5">
                    <select class="form-control" id="car-energy" name="car-energy" style="width: 100%;">
                        @isset( $energy_list )
                            @php( $presenceFlag=FALSE )
                            @foreach( $energy_list as $energyEntry )
                                @if(isset($car_energy) && $car_energy == $energyEntry['name'])
                                    @php( $presenceFlag=TRUE)
                                    <option value="{{$energyEntry['value']}}" selected="selected">{{$energyEntry['name']}}</option>
                                @else
                                    <option value="{{$energyEntry['value']}}">{{$energyEntry['name']}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="text" name="car-other-energy" class="form-control" placeholder="Autre type d'énergie"
                           value="{{ (isset($car_energy) && (!isset($presenceFlag) || $presenceFlag==FALSE))?$car_energy:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-consumption" class="col-sm-2 control-label">Conso.</label>
                <div class="col-sm-7">
                    <input  type="text" id="car-consumption" name="car-consumption" class="form-control" placeholder="Consommation de la voiture(l/100 Km)"
                    value="{{isset($car_consumption) ? $car_consumption : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-horses-count" class="col-sm-2 control-label">N.chevaux</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="car-horses-count" placeholder="Nombre de chevaux" name="car-horses-count" min="2"
                    value="{{isset($car_horses_count) ? $car_horses_count : ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-type" class="col-sm-2 control-label">Type de vehicule(*)</label>
                <div class="col-sm-5">
                    <select class="form-control" id="car-type" name="car-type" style="width: 100%;">
                        @isset( $types_list )
                            @php( $presenceFlag=FALSE )
                            @foreach( $types_list as $typeEntry)
                                @if(isset($car_type) && $car_type== $typeEntry['name'])
                                    @php( $presenceFlag=TRUE)
                                    <option value="{{$typeEntry['value']}}" selected="selected">{{$typeEntry['name']}}</option>
                                @else
                                    <option value="{{$typeEntry['value']}}">{{$typeEntry['name']}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="text" name="car-other-type" class="form-control" placeholder="Autre type de vehicule"
                           value="{{ (isset($car_type) && (!isset($presenceFlag) || $presenceFlag==FALSE))?$car_type:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="car-speed-box" class="col-sm-2 control-label">Boite de vitesse(*)</label>
                <div class="col-sm-5">
                    <select class="form-control" id="car-speed-box" name="car-speed-box" style="width: 100%;">
                        @isset( $speed_box_list)
                            @php( $presenceFlag=FALSE )
                            @foreach( $speed_box_list as $speedBoxEntry)
                                @if(isset($car_speed_box) && $car_speed_box== $speedBoxEntry['name'])
                                    @php( $presenceFlag=TRUE)
                                    <option value="{{$speedBoxEntry['value']}}" selected="selected">{{$speedBoxEntry['name']}}</option>
                                @else
                                    <option value="{{$speedBoxEntry['value']}}">{{$speedBoxEntry['name']}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-sm-5">
                    <input type="text" name="car-other-speed-box" class="form-control" placeholder="Autre type de boite"
                           value="{{ (isset($car_speed_box) && (!isset($presenceFlag) || $presenceFlag==FALSE))?$car_speed_box:''}}">
                </div>
            </div>

        </div>

    </div>

    <b>Description du véhicule:</b><br>
    <textarea placeholder="Description du véhicule" value="{{isset($car_description)?$car_description:''}}" name="car-description" cols="100" rows="7"></textarea><br>

    <input type="submit" value="{{isset($form_submit_title) ? $form_submit_title : 'Ajouter'}}" class="btn btn-warning">

</form>
