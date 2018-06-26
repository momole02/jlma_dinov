@extends('rentit/layout')


@section('title')
    JeLoueMonAuto.ci - Compte inactif
@endsection

@section('contents')
    <section id="who-we-are" class="page-section dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInLeft">
                    <h2 class="section-title text-left">
                        <span>Compte inactif</span>
                        <small>Votre compte est actuellement inactif</small>
                    </h2>
                    <p>
                        @if(isset($why) && $why==0)
                        <h4><span style="color:#55fa19">Raison : Vous venez de vous inscrire</span></h4>
                            Votre compte est en cours de validation par l'équipe Dinov,
                            vous devez donc patienter(cela peut prendre plusieurs jours) <br>
                            un SMS vous sera envoyé pour confirmer si vous êtes accepté ou refusé.
                        @endif

                        @if(isset($why) && $why==2)
                        <h4><span style="color:#55fa19">Raison : Un problème technique est survenu</span></h4><br>
                                Donc tous les comptes sont suspendus jusqu'à ce que le problème soit réglé.
                        @endif

                        @if(isset($why) && $why==3)
                        <h4><span style="color:#55fa19">Raison : Vos accès on été temporairement suspendus</span></h4><br>
                            Votre profil est en cours d'inspection...
                        @endif

                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection