@extends('rentit/membersLayout')


@section('content')
    <div class="post-wrap">

        {{--<div class="post-media">
            <a href="assets/img/preview/blog/blog-post-870x370x1.jpg" data-gal="prettyPhoto"><img src="assets/img/preview/blog/blog-post-870x370x1.jpg" alt=""></a>
        </div> --}}

        <div class="post-header">
            <strong>
                <p style="color:green">
                    @include('rentit/components/dataSuccess')
                </p>
            </strong>
            <h2 class="post-title">Edition du profil </h2>

        </div>
        <div class="post-body">
            <div class="post-excerpt">

                <div class="container-fluid">

                    <form class="form" method="post" action="{{ route('doEditProfile') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group has-label has-icon" >
                                    <label for="client-civility">Civilité:</label>

                                    <select style="color:black" class="custom-select-sm form-control" id="client-civility" name="client-civility">
                                        <option value="Mr"   {{ ($client_data->civilite == 'Mr')?'selected':' '  }} >Mr</option>
                                        <option value="Mlle" {{ ($client_data->civilite== 'Mlle')?'selected':' ' }} >Mlle</option>
                                        <option value="Mme"  {{ ($client_data->civilite== 'Mme')?'selected':' ' }} >Mme</option>
                                    </select>
                                    <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client-last-name">Nom:</label>
                                    <input class="form-control" type="text" value="{{ $client_data->nom }}" name="client-last-name" id="client-last-name">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group has-label has-icon">
                                    <label for="client-first-name">Prénoms:</label>
                                    <input class="form-control" type="text" value="{{ $client_data->prenom }}" name="client-first-name" id="client-first-name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group has-label has-icon">
                                    <label for="client-cni-number">N° CNI : </label>
                                    <input class="form-control" type="text" value="{{ $client_data->numcni }}" name="client-cni-number" id="client-cni-number">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group has-label has-icon">
                                    <label for="client-mail">Email: </label>
                                    <input class="form-control" type="text" value="{{ $client_data->email }}" name="client-mail" id="client-mail">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group has-label has-icon">
                                    <label for="client-contact">Contact: </label>
                                    <input class="form-control" type="text" value="{{ $client_data->contact }}" name="client-contact" id="client-contact">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group has-label has-icon">
                                    <label for="client-live-place">Lieu d'habitation : </label>
                                    <input class="form-control" type="text" value="{{ $client_data->situationgeo }}" name="client-live-place" id="client-live-place">
                                    <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left">Modifier mes infos personnelles</button>
                            </div>

                        </div>
                    </form>
                    <br>
                    <br>
                    <br>


                    <form class="form" method="post" action="{{ route('doEditPseudo') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>Pseudo </h3>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-inline">
                                    <label for="client-pseudo">Pseudo :</label>
                                    <input class="form-control" type="text" value="{{ $account_data->login }}" name="client-pseudo" id="client-pseudo">
                                    <button type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left">Modifier mon pseudo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <br>

                    <form class="form" method="post" action="{{ route('doEditPassword') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>Mot de passe </h3>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client-ex-password">Ancien mot de passe:</label>
                                    <input class="form-control" type="password" name="client-ex-password" id="client-ex-password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client-new-password">Nouveau mot de passe:</label>
                                    <input class="form-control" type="password" name="client-new-password" id="client-new-password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client-new-password-conf">Confirmation du nouveau:</label>
                                    <input class="form-control" type="password" name="client-new-password-conf" id="client-new-password-conf">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left">Modifier mon mot de passe</button>
                            </div>

                        </div>
                    </form>

                    <br>
                    <br>
                    <br>


                    <form class="form" method="post" action="{{ route('doChangePhoto') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>Photo </h3>

                        <div class="row">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="client-face">Chemin vers la photo :</label>
                                    <input class="form-control form-control-file" type="file" name="client-face" id="client-face">
                                </div>

                                <button type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left">Modifier la photo</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="post-footer">
            {{--<span class="post-read-more"><a href="#" class="btn btn-theme btn-theme-transparent btn-icon-left">Modifier mes infos personnelles</a></span>--}}
        </div>
    </div>

@endsection
