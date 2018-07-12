<?php

namespace jlma\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use jlma\AccountBusiness;
use jlma\AdminBusiness;
use jlma\Front_Utils;
use jlma\Http\Controllers\Controller;


class ContentController extends Controller
{
    /**
     * @brief Donne le menu correct(en fonction du type d'utilisateur)
     */
    private function getTheGoodMenu()
    {

        $adminBusiness = new AdminBusiness();

        $accountBusiness = new AccountBusiness();
        $menus = $adminBusiness->menus();

        $choosedMenu = array() ;
        $account = $accountBusiness->loggedAccountData();
        if( $account->type_compte==='root' ) $choosedMenu = $menus['root'];
        else $choosedMenu = $menus['other'];

        return $choosedMenu;

    }

    ///////////////////////////////////////////////ECRANS///////////////////////////////////////////////

    /**
     * Panel des témoignages
     */
    public function testimonials()
    {

        $testimonials = DB::table('jla_temoignage')->get();

        return view('admin/content/testimonials')
            ->with('testimonials',$testimonials)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }

    /**
     * Panel des FAQs
     */
    public function faqs(  )
    {
        $faqs = DB::table('jla_faq' )->get();
        return view('admin/content/faqs')
            ->with('faqs' , $faqs)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }
    /**
     * Panel du service client
     */
    public function customerService()
    {

        $customerServiceMembers = DB::table('jla_service_client')->get();

        return view('admin/content/customerService')
            ->with('customer_service_members' , $customerServiceMembers )
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }

    public function stats()
    {
        $stats = DB::table('jla_stats')->get();

        return view('admin/content/stats')
            ->with('stats' , $stats)
            ->with('choosed_menu' , $this->getTheGoodMenu());
    }

    ///////////////////////////////////////////////TRAITEMENTS///////////////////////////////////////////////


    public function doAddTestimonial( Request $req )
    {
        $req->validate(['testimonial-photo'=>'required',
            'testimonial-name'=>'required' ,
            'testimonial-job'=>'required',
            'testimonial-content'=>'required']);


        $testimonialPhoto = $req->file('testimonial-photo')->store( 'public/clients_photo' );
        $testimonialName = $req->post('testimonial-name');
        $testimonialJob = $req->post('testimonial-job');
        $testimonialContent = $req->post('testimonial-content');

        DB::table('jla_temoignage')->insert([
            'photo_tem' => Storage::url($testimonialPhoto),
            'nom_tem' => $testimonialName,
            'prof_tem' => $testimonialJob,
            'contenu_tem' => $testimonialContent,
            'slug'=>Front_Utils::makeSlug('testimonial')
        ]);

        return redirect()->route('adminTestimonials');

    }

    public function doDropTestimonial( $slug )
    {
        DB::table('jla_temoignage')->where('slug',$slug)->delete();

        return redirect()->route('adminTestimonials');
    }

    public function doAddFaq( Request $req )
    {
        $req->validate(['faq-question'=>'required','faq-response'=>'required']);

        $faqQuestion = $req->post('faq-question');
        $faqResponse = $req->post('faq-response');

        DB::table('jla_faq')->insert([
            'question_faq' => $faqQuestion,
            'reponse_faq' => $faqResponse,
            'slug' => Front_Utils::makeSlug( 'faq' )
        ]);

        return redirect()->route('adminFaqs');
    }

    public function doDropFaq( $slug )
    {
        DB::table('jla_faq')->where('slug' , $slug)->delete();

        return redirect()->route('adminFaqs');
    }

    public function doAddCustomerService( Request $req )
    {
        $req->validate([
            'cs-photo' => 'required',
            'cs-name' => 'required',
            'cs-nickname' => 'required',
            'cs-job' => 'required',
            'cs-tel' => 'required',
            'cs-email' => 'required'
        ]);

        $csPhoto =      Storage::url($req->file('cs-photo')->store('public/customers_photos'));
        $csName =      $req->post('cs-name');
        $csNickname =   $req->post('cs-nickname');
        $csJob =    $req->post('cs-job');
        $csTel =    $req->post('cs-tel');
        $csEmail =  $req->post('cs-email');


        DB::table('jla_service_client')->insert([
            'photo_serv_client' => $csPhoto,
            'nom_serv_client' => $csName,
            'surnom_serv_client' => $csNickname,
            'job_serv_client' => $csJob,
            'tel_serv_client' => $csTel,
            'email_serv_client' => $csEmail,
            'slug' => Front_Utils::makeSlug('customerService')
        ]);

        return redirect()->route('adminCustomerService');
    }

    public function doDropCustomerService( $slug )
    {
        DB::table('jla_service_client')->where('slug',$slug)->delete();

        return redirect()->route('adminCustomerService');
    }

    public function doAddStat( Request $req )
    {
        $req->validate([
            'stat-variable' => 'required',
            'stat-value' => 'required',
            'stat-icon' => 'required'
        ]);

        $statVariable = $req->post('stat-variable');
        $statValue = $req->post('stat-value');
        $statIcon = $req->post('stat-icon');

        DB::table('jla_stats')->insert([
            'variable_stat' => $statVariable,
            'valeur_stat' => $statValue,
            'icone_stat' => $statIcon,
            'slug' => Front_Utils::makeSlug('stat-entry')
        ]);

        return redirect()->route('adminStats');
    }

    public function doDropStat( $slug )
    {
        DB::table('jla_stats')->where('slug' , $slug)->delete();

        return redirect()->route('adminStats');
    }

}
