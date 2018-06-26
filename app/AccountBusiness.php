<?php
/**
 * AccountBusiness.phphp - Implémentation de la logique métier des comptes
 *
 * @author Marc Arnaud A.
 *
 */

namespace jlma;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountBusiness
{
    /*
     *
     * A LIRE : note à propos des statuts
     * un statut est un tableau associatif contenant principalement deux clés
     *      ['success'] => vrai si l'opération à été un succes(faux dans le cas contraire)
     *      ['result'] => petit message expliquant ce qui s'est passé
     * */

    /**
     * @brief Inscrit un nouveau client(propriétaire, ou locataire)
     *
     * @param post données à enregistrer
     *  $post['client-cni-number']  <-- N° carte CNI du client
     *  $post['client-last-name']   <-- nom du client
     *  $post['client-first-name']  <-- prenom du client
     *  $post['client-birth-date']  <-- date de naissance du client (yyyy-mm-dd)
     *  $post['client-mail']        <-- mail du client
     *  $post['client-contact']     <-- contact du client
     *  $post['client-live-place']  <-- situation géographique du client
     *  $post['client-civlity']     <-- civilité du client
     *  $post['client-pseudo']      <-- pseudo du client
     *  $post['client-type']        <-- type de client ('locataire' ou 'proprietaire' )
     *  $post['client-password']        <-- mot de passe client
     *  $post['client-password-conf']   <-- confirmation du mot de passe
     *
     * @param $img1 image CNI
     * @param $img2 image Permis
     * @return un status
     */
    public function register( $post,$img1,$img2  )
    {
        $account_type = 'client';

        /* vérifier les mots de passe */
        if( $post['client-password'] != $post['client-password-conf'] ){
            $status['result'] = 'Les mots de passes saisis ne correspondent pas';
            $status['success'] = false;
            return $status;
        }


        $now = new \DateTime(null);

        /** TODO : verifier si la date est correcte*/
       /* $date = date_create_from_format('Y-m-d' , $post['client-birth-date']);
        $date_format = date_format($date , 'Y-m-d');
        var_dump($date_format , $post['client-birth-date']);
        if($date_format != $post['client-birth-date'] ){
            return[
                'success' => false,
                'result' => 'La date de naissance est incorrecte'
            ];
        }*/

        /* inserer directement les données en base */

        /* inserer le client */
        $last_id = DB::table('jla_client')->insertGetId([
            'nom' => $post['client-last-name'],
            'prenom' => $post['client-first-name'],
            'date_naiss' => $post['client-birth-date'],
            'contact' => $post['client-contact'],
            'email' => $post['client-mail'],
            'situationgeo' => $post['client-live-place'],
            'numcni' => $post['client-cni-number'],
            'photo' => 'non-assigne',
            'img_cnt' => '(???)',
            'img_permis' => $img2,
            'img_cni' => $img1,
            'civilite' => (isset($post['client-civility'])) ? $post['client-civility'] : ' ',
            'fk_id_type_personne' => '0'
        ]);

        /* inserer le compte */
        DB::table('jla_compte')->insert([
            'cpte_isatif' => '(???)',
            'login' => $post['client-pseudo'],
            'password' => Hash::make( $post['client-password'] ),
            'cpte_lastdate' => strftime('%Y-%m-%d %H:%M:%S'), /* ??? */
            'cpte_datecreate' => strftime('%Y-%m-%d %H:%M:%S'),
            'fk_id_particulier' => 1,
            'actif' => 0,
            'type_compte' => $account_type,
            'fk_id_client' => $last_id,
            'slug' => Str::slug( $post['client-pseudo'].$now->format('dmYhis') )
        ]);


        $status['result'] = 'Votre inscription à bien été prise en compte, nous vous contacterons...';
        $status['success'] = true; /*l'opération a été un succès*/

        return $status;
    }
    
    /**
     * @brief Edite les paramètres du profil
     *
     * @param post paramètres
     *
     *  $post['client-cni-number']  <-- N° carte CNI du client
     *  $post['client-last-name']   <-- nom du client
     *  $post['client-first-name']  <-- prenom du client
     *  $post['client-mail']        <-- mail du client
     *  $post['client-contact']     <-- contact du client
     *  $post['client-live-place']  <-- situation géographique du client
     *  $post['client-civlity']     <-- civilité du client
     *
     * @param client_id ID du compte correspondant
     *
     * @return un statut
    */
    public function editProfile( $client_id , $post )
    {
        $status = [
            'success' => true,
            'result' => 'profil édité avec succès'
        ];

        DB::table('jla_client')->where('id_client', $client_id)
            ->update([
                'nom'       => $post['client-last-name'],
                'prenom'    => $post['client-first-name'],
                'contact'   => $post['client-contact'],
                'email'     => $post['client-mail'],
                'situationgeo'  => $post['client-live-place'],
                'numcni'        => $post['client-cni-number'],
                'civilite'      => $post['client-civility']
            ]);

        return $status;
    }

    /**
     * @brief modifie le pseudo
     *
     * @param account_id ID du compte
     * @param new_pseudo nouveau pseudo
     *
     * @return un statuts
     *
    */

    public function editPseudo( $account_id, $new_pseudo )
    {
        if( !$this->pseudoExists($new_pseudo) ) {
            DB::table('jla_compte')->where('id_compte', $account_id)->update(['login' => $new_pseudo]);

            /* mettre à jour les données des sessions */
            $logged_acc_data = $this->loggedAccountData();
            $logged_acc_data->login = $new_pseudo;
            $this->connectClient($logged_acc_data);

            return [
                'success' => true,
                'result' => 'Pseudo modifié avec succès'
            ];

        }
        return[
            'success' => false,
            'result' => 'le pseudo choisi existe déja'
        ];
    }


    /**
     * @brief modifie le mot de passe
     *
     * @param account_id ID du compte
     * @param ex_password ancien mot de passe
     * @param new_password nouveau mot de passe
     * @param new_password_conf confirmation du mot de passe
     *
     * @return un statut
    */
    public function editPassword( $account_id , $ex_password , $new_password, $new_password_conf )
    {
        $ex_password_hash_tb = DB::table('jla_compte')->select('password')->where('id_compte' , $account_id)->first();
        if( $ex_password_hash_tb == null){
            return [
                'success' => false,
                'result' => 'Erreur interne'
            ];
        }

        $ex_password_hash = $ex_password_hash_tb->password;

        if( !Hash::check( $ex_password , $ex_password_hash ) ){ /*verfier si l'ancien  mot de passe est correct*/
             return [
                 'success' => false,
                 'result' => "L'ancien mot de passe est incorrect"
             ];
        }

        if( $new_password !== $new_password_conf ){
            return [
                'success' => false,
                'result' => "Les deux mots de passes ne correspondent pas"
            ];
        }

        DB::table('jla_compte')->where('id_compte' , $account_id)->update([
           'password' => Hash::make( $new_password )
        ]);
        return [
            'success' => true,
            'result' => 'Le mot de passe à été correctement changé'
        ];
    }

    /**
     * @brief change la photo du client
     *
     * @param client_id ID du client
     * @param path chemin vers la photo
     *
     * @return un status
    */
    public function changeClientPhoto( $client_id , $path )
    {
        DB::table('jla_client')->where('id_client' , $client_id)->update([
           'photo' => $path
        ]);

        return [
            'success' => true,
            'result' => 'La photo à été modifiée avec succès'
        ];

    }

    /**
     * @brief recherche des clients en fonction du login et du mdp
     *
     * @param login pseudo ou login
     * @param password mot de passe
     *
     * @return les donneés du compte (ou null si les informations sont introuvables en base)
     */
    public function fetchAccount( $login, $password )
    {
        $account = DB::table('jla_compte')
            ->where('login' , $login)->first(); /*chercher un locataire ayant ce pseudo*/

        if( $account != null ) {
            /* verifier si le mot de passe est correct */
            if (Hash::check($password, $account->password)) {
                return $account;
            }
        }
        return null ;
    }

    /**
     * @brief effectue la connexion d'un client (l'ajoute aux sessions)
     *
     * @param account Données du compte
     */
    public function connectClient( $account )
    {
        session()->put( 'client-account-data' , $account );
    }

    /**
     * @brief verifie si un client est déja connecté
     *
     * @return vrai si un client est connecté(faux sinon)
    */
    public function isClientConnected( )
    {
        return (session()->has('client-account-data'));
    }

    /**
     * @brief retourne les informations de compte des données client
     */
    public function loggedAccountData()
    {
        return session()->get('client-account-data');
    }

    /**
     * @brief recupère les informations client du client connecté
     *
     * @return les données du client connecté (ou NULL dans le cas contraire)
     */
    public function loggedClientData()
    {

        if( $this->isClientConnected() ) {

            $logged_account = $this->loggedAccountData();

            return $this->clientData( $logged_account->slug );
        }

        return null ;
    }


    /**
     * @brief récupère les informations sur n'importe quel client connaissant le slug
     *
     * @param slug slug de compte(jla_compte)
     *
     * @return les données du client(ou NULL s'il n'existe pas)
     */
    public function clientData( $slug )
    {
        $id_client = 0 ;
        $clientData = null ;

        $accountData=DB::table('jla_compte')->where( 'slug' , $slug )->first();

        if( $accountData!=null ){
            $id_client = $accountData->fk_id_client; /* recupérer l'id des données client */

            $clientData = $this->clientDataByID($id_client);
            $clientData->accountData = $accountData;

            return $clientData;
        }
        return null ;
    }

    public function clientDataByID( $id )
    {
        /*chercher les données client*/
        $client_data = DB::table('jla_client')->where('id_client' , $id)->first();

        return $client_data;
    }

    public function clientDataByAccountID( $id )
    {
        $id = DB::table('jla_compte')->where('id_compte',$id)->value('fk_id_client');

        return $this->clientDataByID( $id );
    }

    /**
     * @brief Déconnecte le client actuel
     */
    public function logoutClient()
    {
        session()->pull('client-account-data');
    }

    /**
     * @brief verifie si le pseudo existe déja
    */
    public function pseudoExists( $pseudo )
    {
        return DB::table('jla_compte')->where('login',$pseudo)->exists();
    }

    /**
     * @brief retourne la liste des clients inscrits
    */
    public function allClients( $offset=0,$limit=10 )
    {
        $accounts = DB::table('jla_compte')->offset($offset)->limit($limit)->get();

        for( $i=0;$i<count($accounts);++$i ){
            $acc = & $accounts[$i];

            $this->storeAccountExtraData( $acc );
        }

        return $accounts ;
    }

    public function storeAccountExtraData( $acc )
    {
        $clientData = $this->clientDataByID( $acc->fk_id_client );

        $acc->clientName = $clientData->civilite.' '.$clientData->prenom.' '.$clientData->nom;
        $acc->clientBirthDate = $clientData->date_naiss;
        $acc->clientCni = $clientData->numcni;
        $acc->clientContact = $clientData->contact;
    }

    /**
     * @brief retourne le nombre total des clients inscrits
    */
    public function clientsCount(  )
    {
        return DB::table('jla_compte')->count();
    }

    /**
     * @brief désinscrit un client
    */
    public function dropClient( $slug )
    {
        DB::table('jla_compte')->where('slug',$slug)->delete();
    }

    public function searchClients( $cni , $first_name, $last_name, $location , $pseudo )
    {
        $query = 'SELECT * FROM jla_client,jla_compte WHERE';
        $useAnd=false;

        if( $cni!=null ){
            $query .= " jla_client.numcni LIKE('%$cni%') ";
            $useAnd=true;
        }
        if( $first_name!=null ){
            if( $useAnd ) $query.=' AND ';
            $query .= " jla_client.prenom LIKE('%$first_name%') ";
            $useAnd=true;
        }

        if( $last_name!=null ){
            if( $useAnd ) $query.=' AND ';
            $query .= " jla_client.nom LIKE('%$last_name%') ";
            $useAnd=true;
        }

        if( $location!=null ){
            if( $useAnd ) $query.=' AND ';
            $query .= "  jla_client.situationgeo LIKE('%$location%') ";
            $useAnd=true;
        }

        if( $pseudo!=null ){
            if( $useAnd ) $query.=' AND ';
            $query .= "  jla_compte.login LIKE('%$pseudo%') ";
            $useAnd=true;
        }

        if( $useAnd ) $query.=' AND ';
        $query .= "  jla_compte.fk_id_client=jla_client.id_client ";

        $data = DB::select($query);


        for( $i=0;$i<count($data);$i++ )
            $this->storeAccountExtraData( $data[$i] );

        return $data;
    }

    public function activateAcount( $slug , $status )
    {
        DB::table('jla_compte')->where('slug',$slug)->update(['actif'=>$status]);
    }

    /* Remet le mot de passe à 123456789*/
    public function zeroPassword( $slug )
    {
        $newPassword = Hash::make( '123456789' );

        DB::table('jla_compte')->where('slug',$slug)->update(['password'=>$newPassword]);
    }

}