@extends('rentit/layout')


@section('title')
    -- JeLoueMonAuto -- Comment ça marche ?
@endsection

@section('contents')
    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs text-right">
        <div class="container">
            <div class="page-header">
                <h1>Comment ça marche</h1>
            </div>
            <ul class="breadcrumb">
                <li><a href="{{route('home')}}">Acceuil</a></li>
                <li class="active">Comment ça marche</li>
            </ul>
        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <!-- PAGE WITH SIDEBAR -->
    <section class="page-section with-sidebar">
        <div class="container">
            <div class="row">

                <!-- CONTENT -->
                <div class="col-md-9 content" id="content">

                    <!-- Blog posts -->
                    <article class="post-wrap">
                        <div class="post-media">
                            <a href="{{asset('img/picto.jpg')}}" data-gal="prettyPhoto"><img src="{{asset('img/picto.jpg')}}" alt=""></a>
                        </div>
                        <div class="post-header">
                            <h2 class="post-title"><a href="#">Comment ça marche ?? </a></h2>
                            <div class="post-meta">{{--By <a href="#">author name here</a> / 6th June 2014 / in <a href="#">Design</a>, <a href="#">Photography</a> / <a href="#">27 Comments</a> / 18 Likes / <a href="#">Share This Post</a>--}}</div>
                        </div>
                        <div class="post-body">
                            <div class="post-excerpt">
                                <p>
                                    {{-- Le texte ici --}}

                                <h6>Louer une voiture, aujourd’hui, c’est simple comme <b>jelouemonauto.ci</b> !</h6>
                                    <h3>01-Je choisis mon véhicule</h3>

                                    <b>Avec les photos et les évaluations, mon choix se fait simplement.</b><br>
                                Saisissez votre adresse de départ dans la <a href="{{route('home')}}">barre de recherche</a> ou choisissez votre vehicule dans la liste <a href="{{route("showCars")}}">ici</a>.<br>
                                    Dans la liste des véhicules disponibles, <br>
                                    sélectionnez celui qui correspond à vos critères de recherche <br>
                                    (catégorie, marque et modèle, budget, nombre de places, options, carburant…). Les photos des voitures et les profils des propriétaires vous aident à finaliser votre choix. Vous pouvez utiliser notre système de messagerie pour contacter un propriétaire afin d’obtenir certaines précisions.<br>
                                    Liste des locations par ville et point d’intérêts :<br>

                                <h3>02- J’effectue ma réservation en ligne</h3>
                                    En 2 minutes, j’envoie ma demande de réservation <b>jelouemonauto.ci</b>.<br>
                                    Le jour du rendez-vous nous ferons un état des lieux du véhicule, signerons le document de prise en charge, et vous nous remettrez les clés du véhicule.<br>

                                <h3>03-Je récupère le véhicule et je prends la route</h3>
                                    <b>jelouemonauto.ci</b> vous accueille et vous remet les clés. C’est parti pour votre voyage !<br>
                                    <b>jelouemonauto.ci</b> prend en charge votre voiture et gère les locations pour vous.<br>
                                    Les services compris dans notre prestation comprennent :<br>
                                    - La gestion de l’ensemble des demandes de location sur le site <b>jelouemonauto.ci</b><br>
                                    - La gestion de l’organisation des locations conclues<br>
                                    - La remise des clés et l’état des lieux au check-in / check-out des locations<br>
                                    Les départs se font depuis votre garage ou si vous n’avez pas de garage, depuis une place de parking près de chez vous.<br>
                                    Pour les locations, vous gagnez 50% du montant total.<br>

                                <h3>04-Je restitue le véhicule et je laisse une évaluation au propriétaire</h3>
                                    C’est terminé pour ce voyage, mais je garde contact avec <b>jelouemonauto.ci</b> pour la prochaine location !<br>
                                    Confirmez le lieu du rendez-vous retour avec <b>jelouemonauto.ci</b>. Avant le rendez-vous retour, vérifiez la jauge du carburant, et complétez si nécessaire (même niveau qu’au départ). Nettoyer l’intérieur de la voiture, et éventuellement l’extérieur, afin de la rendre dans l’état où on vous l’a remise. Ensemble, passez en revue la voiture et remplissez l’état des lieux retour figurant sur le contrat que vous signerez en 2 exemplaires. Conservez chacun un exemplaire du contrat de location <b>jelouemonauto.ci</b> Si le niveau de carburant n’est pas conforme, ou si le kilométrage excède celui inclus dans le contrat, vous pouvez régler le complément directement au propriétaire, ou par téléphone via le service client <b>jelouemonauto.ci</b>. Echangez une chaleureuse poignée de mains, et promettez-nous de rester en contact. Une fois chez vous, pensez à évaluer <b>jelouemonauto.ci</b>  en ligne et laissez un commentaire Parlez de votre expérience <b>jelouemonauto.ci</b> à vos amis, sur Facebook et vos autres réseaux sociaux et préparez votre prochain voyage !<br>

                                </p>
                            </div>
                        </div>
                        <div class="post-footer">
                            <span class="post-read-more">
                                <a href="{{route('home')}}" class="btn btn-theme btn-theme-transparent btn-icon-left"><i class="fa fa-arrow-left"></i> Accueil</a>
                                <a href="#" class="btn btn-theme btn-theme-transparent btn-icon-left"><i class="fa fa-arrow-right"></i> La communauté de l'auto partage</a>
                            </span><br>
                        </div>
                    </article>
                    <!-- / -->

                    <article class="post-wrap">
                        <div class="post-media">
                            <a href="{{asset('img/picto2.jpg')}}" data-gal="prettyPhoto"><img src="{{asset('img/picto2.jpg')}}" alt=""></a>
                        </div>
                        <div class="post-header">
                            <h2 class="post-title"><a href="#">La communauté de l'auto partage </a></h2>
                            <div class="post-meta">{{--By <a href="#">author name here</a> / 6th June 2014 / in <a href="#">Design</a>, <a href="#">Photography</a> / <a href="#">27 Comments</a> / 18 Likes / <a href="#">Share This Post</a>--}}</div>
                        </div>
                        <div class="post-body">
                            <div class="post-excerpt">
                                <h3>La communauté de l'auto partage</h3>

                                <h5>Entre voisins, collègues et amis. Avec jelouemonauto.ci, ça roule par affinités. En toute confiance.</h5>
                                <p>
                                Les locations se font avec les personnes en qui vous avez confiance, par affinités<br>
                                Sur jelouemonauto.ci, vous pouvez louer à des anonymes, vous louez à des personnes de confiance de votre entourage ou de votre quartier.<br>
                                </p>

                                Vous faites la connaissance avec les membres de jelouemonauto.ci de votre quartier grâce aux profils détaillés vérifiés, aux commentaires et à notre système de messagerie.<br>
                                Vous participez à la vie de la communauté et assistez aux nombreux évènements et apéros jelouemonauto.ci près de chez vous<br>
                                Les apéros sont un excellent moyen de créer ou consolider des liens avec les membres jelouemonauto.ci autour de vous, et d’échanger vos conseils sur les locations.<br>

                                <h5>Appartenir à la communauté jelouemonauto.ci en 4 étapes Entraide, bienveillance, convivialité, contribuez et profitez de la vie de communauté jelouemonauto.ci !</h5>

                                <h3>01-Je m’inscris et je soigne mon profil</h3>
                                <p>
                                Pour donner envie aux autres membres de partager avec moi, je prends le temps de compléter parfaitement mon profil<br>
                                Sur jelouemonauto.ci, chacun veille à renseigner le mieux possible son profil, car conducteurs et propriétaires savent bien que les affinités et la confiance jouent un rôle majeur dans l’auto partage jelouemonauto.ci.<br>
                                Dès que vous envoyez une demande de réservation sur notre site, nous avons accès à votre profil.<br>
                                Faites-vous connaître : parlez de vos études, de votre métier, de vos goûts, de vos expériences de conduite, de vos valeurs, de ce que vous aimez dans le principe de jelouemonauto.ci et de l’économie collaborative…<br>
                                Si vous êtes propriétaire, n’hésitez pas à photographier votre véhicule sous tous les angles, pour mieux le mettre en valeur.<br>
                                </p>

                                <h3>02-Je dialogue en ligne et garde le contact</h3>
                                <p>
                                La messagerie permet de communiquer avec les propriétaires autour de vous, pour votre prochaine location ou pour faire connaissance<br>
                                Sur jelouemonauto.ci, la location ne se limite pas à une simple transaction commerciale. C’est une relation authentique qui se construit sur la confiance : d’abord grâce à la messagerie en ligne, ensuite face-à- face autour du véhicule ou autour d’un café.<br>
                                N’hésitez pas à poser vos questions aux propriétaires dont les véhicules vous intéressent. Échangez et dialoguez, faites plus ample connaissance. Fixez l’heure et le lieu de la rencontre pour la remise puis la restitution du véhicule. Gardez le contact.<br>
                                </p>

                                <h3>03- Je laisse une évaluation et un commentaire pour la communauté</h3>
                                <p>
                                Au retour de mes locations, j’évalue la personne sur les critères classiques et sur la convivialité. Et je garde le contact pour une prochaine location.<br>
                                Sur jelouemonauto.ci, voyageurs et propriétaires n’oublient jamais de laisser leurs évaluations et leurs commentaires après chaque location ; c’est un système qui a fait ses preuves : il permet à notre communauté d’entraide et de partage de fonctionner parfaitement.<br>
                                Chaque évaluation et commentaire que vous donnez enrichit la communauté.<br>
                                Chaque évaluation et commentaire que vous recevez construit votre réputation.<br>
                                </p>

                                <h3>04-Je joue collectif et participe à la communauté</h3>
                                <p>
                                Je m’implique pour développer cette belle initiative de partage dans mon quartier et dans mon réseau.<br>
                                Sur jelouemonauto.ci, voyageurs et propriétaires aiment bien se retrouver et partager sur les réseaux sociaux : Facebook, LinkedIn, Twitter…<br>
                                </p>

                                <p>
                                Alors que le célèbre proverbe « Qui se ressemble, s’assemble » se vérifie chaque jour un peu plus, les membres de la communauté de l’auto partage ont carrément inventé le leur : « Les voitures de nos amis sont nos voitures… »</p>
                                Connectez-vous avec Facebook, et découvrez vos affinités et centres d’intérêt communs avec d’autres voyageurs ou propriétaires. Capitalisez sur vos réseaux pour développer la communauté jelouemonauto.ci dans votre réseau et quartier.</p>
                                </p>

                                <h3>Une communauté de confiance</h3>
                                <p>
                                jelouemonauto.ci est basé sur les affinités entre les membres de la communauté, et sur les liens de confiance forts qui sont encore renforcés au fil des locations.<br>
                                Toutes les locations se font avec les personnes en qui vous avez confiance, qui vous ressemblent.<br>
                                </p>

                            </div>
                        </div>
                        <div class="post-footer">
                            <span class="post-read-more">
                                <a href="{{route('home')}}" class="btn btn-theme btn-theme-transparent btn-icon-left"><i class="fa fa-arrow-left"></i> Comment ça marche ?</a>
                                <a href="#" class="btn btn-theme btn-theme-transparent btn-icon-left"><i class="fa fa-arrow-right"></i> La communauté de l'auto partage</a>
                            </span><br>
                        </div>
                    </article>

                    <!-- /Blog posts -->


                </div>
                <!-- /CONTENT -->

            </div>
        </div>
    </section>
    <!-- /PAGE WITH SIDEBAR -->

@endsection