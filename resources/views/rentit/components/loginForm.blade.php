<form class="form" method="post" action="{{ route('doLogin') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

            @if(isset($from_home) && $from_home==false)

                <div style="color:red" class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">

                @include('rentit/components/validation')

                </div>
            @else

                <div class="col-md-12 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                <h2 class="section-title text-left no-margin">
                    <small>Déja inscrit ??</small>
                    <span>Connectez vous</span>
                </h2>
                </div>
            @endif

            <div class="col-md-6 col-md-offset-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="form-group has-icon has-label">
                    <label for="login">Login: </label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Entrez votre login">
                </div>
            </div>

            <div class="col-md-6 col-md-offset-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="form-group has-icon has-label">
                    <label for="password">Mot de passe: </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
            </div>


            <div class="col-md-4 col-md-offset-4 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="form-group has-icon has-label">
                    <div class="form-group has-icon has-label">
                        <button type="submit" class="btn btn-block btn-submit ripple-effect btn-theme">Lancer la connexion</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>