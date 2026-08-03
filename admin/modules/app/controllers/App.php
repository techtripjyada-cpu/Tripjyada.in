<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App extends MX_Controller
{
    function index()
    {
        if ($this->session->userdata('username'))
        {
            $this->load->view('header');
            $this->load->view('navigation');
            $this->load->view('body');
            $this->load->view('footer');
        }
        else redirect('login');
    }

    function login_layout($data)
    {
        $this->load->view('header',$data);
        $this->load->view('body');
        $this->load->view('footer');
    }

    function app_main()
    {

        if ($this->session->userdata('username'))
        {
            //app
            $this->load->view('main/main.js');
            //controllers

            $this->load->view('login/ctrl_login.js');
            $this->load->view('dashboard/ctrl_dashboard.js');
            $this->load->view('reviews/ctrl_reviews.js');
            $this->load->view('contact/ctrl_contact.js');
            $this->load->view('contact/ctrl_booking.js');
            $this->load->view('newsletter/ctrl_newsletter.js');
            $this->load->view('blog/ctrl_blog.js');
            $this->load->view('packages/ctrl_packages.js');
            $this->load->view('packages/ctrl_package_details.js');
            $this->load->view('logs/ctrl_logs.js');
            $this->load->view('payments/ctrl_payments.js');
            $this->load->view('city/ctrl_city.js');
            $this->load->view('offers/ctrl_offers.js');
            $this->load->view('gallery/ctrl_gallery.js');
            $this->load->view('album/ctrl_album.js');
            $this->load->view('branches/ctrl_branches.js');
            $this->load->view('users/ctrl_users.js');
            $this->load->view('cardpage/ctrl_cardpage.js');
            $this->load->view('cardpage/ctrl_cardpage_tabs.js');
            $this->load->view('cardpage/ctrl_cardpage_desc.js');
        }
        else redirect('login');
    }

    function pagination()
    {
        $this->load->view('dirPagination.tpl.html');
    }
    function help()
    {
        $this->load->view('help/help');
    }

}
