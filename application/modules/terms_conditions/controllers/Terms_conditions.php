<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Terms_conditions extends MX_Controller
{
    function index()
    {
        $data['title']       = "Terms & Conditions | TripJyada";
        $data['description'] = "Read TripJyada's terms and conditions covering general policies, payment, cancellation, and more for your Bhutan and group tour bookings.";
        $data['keywords']    = "TripJyada terms and conditions, booking policy, cancellation policy, payment policy, travel terms";
        $data['module']      = "terms_conditions";
        $data['view_file']   = "terms_conditions";
        echo Modules::run('template/layout2', $data);
    }
}
