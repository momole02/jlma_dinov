<?php
/**
 * ClientControllerr.php - Contrôleur des propriétaires
 *
 * @author Marc Arnaud A.
 * */

namespace jlma\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use jlma\AccountBusiness;
use jlma\CarBusiness;

class ClientController extends Controller
{

    /**
     * @brief Affiche le formulaire de login
     */
    public function login()
    {

        $business = new AccountBusiness();

        if(session()->has('jlma-ss1-data'))  /*si l'étape 1 à déja été faite*/
            return redirect()->route('signupStep2'); /*passer à l'étape 2*/

        if( $business->isClientConnected() ){

            return redirect()->route('members');

        }else{

            return view('rentit/loginpage');
        }
    }


    /**
     * @brief verifie le formulaire d'inscription(afin de passer à l'étape 2)
    */
    public function doSignup1( Request $req )
    {
        $post_data=$req->all();

        $validator = Validator::make($req->all() , [
            'client-cni-number' => 'required|min:3',
            'client-last-name' => 'required|min:3',
            'client-first-name' => 'required|min:3',
            'client-live-place' => 'required',
            'client-mail' => 'required',
            'client-contact' => 'required',
            'client-civility' => 'required',
            'client-birth-date' => 'required',
            'client-pseudo' => 'required|min:3',
            'client-password' => 'required|min:6',
            'client-password-conf'=> 'required|min:6'
        ]);


        if( $validator->fails() ){
            return redirect()->route('login')->with('post_data',$post_data)->with('errors', $validator->errors());
        }

        $business = new AccountBusiness();
        $parameters = $post_data;
        /// Verifier si le pseudo n'est pas déja pris
        if( $business->pseudoExists( $parameters['client-pseudo'] ) ){ /* le pseudo existe déja */
            return redirect()->route('login')->with('data' , [
                'success' => false,
                'result' => 'le pseudo que vous avez choisi existe déja'
            ])->with('post_data' , $req->all());
        }

        session()->put('jlma-ss1-data' , $post_data);
        return redirect()->route('signupStep2'); /* passer à l'étape2 */
    }

    /**
     * @brief (etape 2) Affiche le formulaire de renseignement de la CNI
     */
    public function signupStep2()
    {
        if(session()->has('jlma-ss2-data'))  /*si l'étape 1 à déja été faite*/
            return redirect()->route('signupStep3'); /*passer à l'étape 2*/

        if( session()->has('jlma-ss1-data') ){ /*Etape 1 correctement  faite */

            return view('rentit/papers')->with('title' , 'Etape 2')
                ->with('desc','Soumettez nous une photo de votre CNI')
                ->with('backLink' , route('backFromSignup2'))
                ->with('targetRoute' , route('doSignup2'));

        }else{
            /* repartir sur le login */
            return redirect()->route('login');
        }
    }

    /**
     * @brief retourne à l'étape 1(login)
    */
    public function backFromSignup2()
    {
        session()->pull('jlma-ss1-data');
        return redirect()->route('login');
    }
    /**
     *@brief Verifie le formulaire de CNI et passe à l'étape 3
     */
    public function doSignup2( Request $req )
    {
        if( session()->has('jlma-ss1-data') ){
            $req->validate([
                'img-file' => 'required'
            ]);

            $path = $req->file('img-file')->store('public/clients_photo');
            session()->put('jlma-ss2-data' , Storage::url($path));
            return redirect()->route('signupStep3');
        }else{
            return redirect()->route('login');
        }

    }



    /**
     * @brief (etape 3) Affiche le formulaire de renseignement du permis de conduire
    */
    public function signupStep3()
    {

        if( session()->has('jlma-ss2-data') ){
            return view('rentit/papers')
                ->with('title','Etape 3')
                ->with('targetRoute' , route('doSignup3'))
                ->with('desc' , 'Soumettez nous une photo de votre permis de conduire')
                ->with('backLink' , route('backFromSignup3'));
        }else{
            return redirect()->route('signupStep2');
        }
    }

    /**
        *@brief Retourne à l'étape 2
     */
    public function backFromSignup3()
    {
        session()->pull('jlma-ss2-data');
        return redirect()->route('signupStep2');
    }

    /**
     * @brief Verifie les données renseignées à l'étape 3 et inscrit l'abonné
    */
    public function doSignup3(Request $req)
    {

        $req->validate([
            'img-file' => 'required'
        ]);
        if( session()->has('jlma-ss1-data') && session()->has('jlma-ss2-data') ) {
            $path = $req->file('img-file')->store('public/clients_photo');

            $business = new AccountBusiness();
            $parameters = session()->get('jlma-ss1-data');
            $img2 = session()->get('jlma-ss2-data');
            $img3 = Storage::url($path);

            $data = $business->register($parameters, $img2, $img3); /* sauvegarder dans la base de données */


            session()->pull('jlma-ss1-data');
            session()->pull('jlma-ss2-data');
            if ($data['success'] === true)
                return redirect()->route('home')->with('data', $data);
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * @brief Traite une requête de login
    */
    public function doLogin( Request $req )
    {
        $req->validate([
           'login' => 'required|min:3',
           'password' => 'required|min:6'
        ]);

        $business = new AccountBusiness();
        $account = $business->fetchAccount( $req->input('login') , $req->input('password') );

        if( $account != null ){
            if($account->actif!=1){ /* compte inactif */
                return view('rentit/inactiveAccount')->with('why' , $account->actif);
            }else{
                $business->connectClient( $account ); /* inscrire les variables sessions du client  */
                return redirect()->route('members'); /* rediriger vers l'espace membres */
            }
        }else{
            $data['success'] = false;
            $data['result'] = 'Mot de passe et/ou login incorrect';
            return redirect()->route('login')->with('data' , $data );
        }
    }
    /**
     * @brief Affiche l'espace membres
     */
    public function members()
    {
        $business = new AccountBusiness();
        $car_business = new CarBusiness();
        if( $business->isClientConnected() ){ /* client connecté ? */

            $account_data = $business->loggedAccountData();
            $client_data = $business->loggedClientData();
            $cars_leasings = $car_business->allClientLeasings($account_data->id_compte);


            return view('rentit/members' )
                ->with('account_data' , $account_data )
                ->with('client_data' ,  $client_data)
                ->with('car_leasings' , $cars_leasings);

        }else{ /* sinon */
            return redirect()->route('login'); /* login */
        }
    }

    /**
     * @brief affiche le formulaire d'édition d'informations
    */
    public function editProfile()
    {
        $business = new AccountBusiness();
        $account_data = $business->loggedAccountData();
        $client_data = $business->loggedClientData();

        if( $business->isClientConnected() )
            return view('rentit/editProfile')
                ->with('account_data' , $account_data)
                ->with('client_data' , $client_data);

        return redirect()->route('login')->with('data' ,[
            'success' => false,
            'result' => 'connectez vous pour continuer'
        ]);
    }

    /**
     * @brief modifie les données du profil
     */
    public function doEditProfile( Request $req )
    {
        $acc_businesss = new AccountBusiness();

        if( $acc_businesss->isClientConnected() ) {

            $logged_account_data = $acc_businesss->loggedAccountData();

            $req->validate([
                'client-cni-number' => 'required|min:3',
                'client-last-name' => 'required|min:3',
                'client-first-name' => 'required|min:3',
                'client-mail' => 'required',
                'client-live-place' => 'required',
                'client-contact' => 'required',
                'client-civility' => 'required',
            ]);

            $post = $req->all();

            $status = $acc_businesss->editProfile($logged_account_data->fk_id_client , $post);


            if( $status['success']==false ){
                return redirect()->route('editProfile')->with('data' , $status);
            }else{
                return redirect()->route('members')->with('data' , $status);
            }
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * @brief modifie le pseudo
     *
     */
    public function doEditPseudo( Request $req )
    {
        $acc_business = new AccountBusiness();

        if( $acc_business->isClientConnected() ){

            $req->validate(['client-pseudo' => 'required|min:3']);
            $post = $req->all();

            $logged_account_data = $acc_business->loggedAccountData();

            $status = $acc_business->editPseudo( $logged_account_data->id_compte , $post['client-pseudo'] );

            if( $status['success']==false ){
                return redirect()->route('editProfile')->with('data' , $status);
            }else{
                return redirect()->route('members')->with('data' , $status);
            }

        }else{
            return redirect()->route('login');
        }
    }

    /**
     * @rief modifie le mot de passe
    */
    public function doEditPassword( Request $req )
    {
        $acc_business = new AccountBusiness();

        if( $acc_business->isClientConnected() ){

            $req->validate([
                'client-ex-password' => 'required|min:6',
                'client-new-password' => 'required|min:6',
                'client-new-password-conf' => 'required|min:6'
            ]);
            $post = $req->all();
            $logged_account_data = $acc_business->loggedAccountData();

            $status = $acc_business->editPassword( $logged_account_data->id_compte ,
                $post['client-ex-password'],
                $post['client-new-password'] ,
                $post['client-new-password-conf']);

            if( $status['success']==false ){
                return redirect()->route('editProfile')->with('data' , $status);
            }else{
                return redirect()->route('members')->with('data' , $status);
            }
        }else{
            return redirect()->route('login');
        }
    }
    /**
     * @brief change la photo d'un client
    */
    public function doChangePhoto( Request $req )
    {

        $acc_business = new AccountBusiness();

        if( $acc_business->isClientConnected() ){

            $req->validate(['client-face' => 'required']);

            $logged_account_data = $acc_business->loggedAccountData();
            $path = $req->file('client-face')->storeAs('public/clients_photo',$logged_account_data->slug);

            $status = $acc_business->changeClientPhoto( $logged_account_data->fk_id_client , Storage::url($path) );

            return redirect()->route('members')->with('data' , $status );

        }else{
            return redirect()->route('login');
        }
    }

    /*
     * @brief Deconnexion
    */
    public function logout()
    {
        $business = new AccountBusiness();

        $business->logoutClient();

        return redirect()->route('login');
    }

}