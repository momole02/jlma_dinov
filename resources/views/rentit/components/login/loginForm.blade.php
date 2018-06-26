<section class="page-section color">
    <div class="container">
        <div class="row">
            @include('rentit/components/validation')
            @php
                if(Session::has('post_data'))   $post_data = Session::get('post_data');
            @endphp
        </div>
        <div class="row">
            <div class="col-sm-6" >
                <h3 class="block-title"><span>Login</span></h3>
                <form action="{{route('doLogin')}}" method="post" class="form-login">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-12 hello-text-wrap">
                            <span class="hello-text text-thin">Bienvenue dans l'espace client </span>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <a class="btn btn-theme btn-block btn-icon-left facebook" href="#"><i class="fa fa-facebook"></i>Connexion facebook</a>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <a class="btn btn-theme btn-block btn-icon-left twitter" href="#"><i class="fa fa-twitter"></i>Connexion Twitter</a>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"><input  class="form-control" name="login" type="text" placeholder="Entrez votre login"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"><input class="form-control"  name="password" type="password" placeholder="Votre mot de passe"></div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="checkbox">
                                <label><input type="checkbox">Rester connecté</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 text-right-lg">
                            <a class="forgot-password" href="#">Mot de passe oublié ?</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-theme btn-block btn-theme-dark" href="#">Login</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-6" >
                <h3 class="block-title"><span>S'inscrire</span></h3>
                <form action="{{route('doSignup1')}}" method="post"  class="form-login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-12 hello-text-wrap">
                            <span class="hello-text text-thin">Créer un compte JLMA - Tous les champs sont obligatoires</span><br>
                            <div class="col-md-3 ">
                                <div class="form-group has-icon">
                                    <select class="form-control" name="client-civility">
                                        <option value="Mr"   {{ (isset($post_data) && $post_data['client-civility']=='Mr')?'selected':' '  }} >Mr</option>
                                        <option value="Mlle" {{ (isset($post_data) && $post_data['client-civility']=='Mlle')?'selected':' '  }} >Mlle</option>
                                        <option value="Mme"  {{ (isset($post_data) && $post_data['client-civility']=='Mme')?'selected':' '  }} >Mme</option>
                                    </select>
                                    <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                                </div>
                            </div>
                            <div class="col-md-9 ">
                                <div class="form-group">
                                    <input required type="text" class="form-control" value="{{isset($post_data) ? $post_data['client-last-name'] : '' }}"  name="client-last-name" placeholder="Entrez votre nom">
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="text" class="form-control" value="{{isset($post_data) ? $post_data['client-first-name'] : '' }}"  name="client-first-name" placeholder="Entrez votre prénom">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="text" class="form-control" value="{{isset($post_data) ? $post_data['client-cni-number'] : '' }}" name="client-cni-number" placeholder="N° CNI">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input required type="email" class="form-control" value="{{isset($post_data) ? $post_data['client-mail'] : '' }}" name="client-mail" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input required type="text" class="form-control" value="{{isset($post_data) ? $post_data['client-contact'] : '' }}" name="client-contact" placeholder="Téléphone">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="text" class="form-control" value="{{isset($post_data) ? $post_data['client-live-place'] : '' }}" name="client-live-place" placeholder="Lieu d'habitation">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="date" class="form-control" name="client-birth-date" value="{{isset($post_data) ? $post_data['client-birth-date'] : '' }}" placeholder="Date de naissance">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    Vous êtes :
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="text" class="form-control" value="{{isset($post_data) ? $post_data['client-pseudo'] : '' }}" name="client-pseudo"   placeholder="Pseudo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="client-password" placeholder="Mot de passe">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="client-password-conf" placeholder="Confirmation du mot de passe">
                                </div>
                            </div>

                        </div>
                        {{--<div class="col-md-12">
                            <h3 class="block-title">Signup Today and You'll be able to</h3>
                            <ul class="list-check">
                                <li>Online Order Status</li>
                                <li>See Ready Hot Deals</li>
                                <li>Love List</li>
                                <li>Sign up to receive exclusive news and private sales</li>
                                <li>Quick Buy Stuffs</li>
                            </ul>
                        </div>--}}
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-theme btn-theme-dark btn-create" href="#">Créer un compte</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>