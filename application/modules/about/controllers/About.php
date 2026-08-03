<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class About extends MX_Controller
{

    function index()
    {
        $data['title'] = "About Us | TripJyada Travel Agency";
        $data['description'] = "TripJyada is a trusted travel agency specialising in Bhutan tours. Enjoy expert-guided, affordable holiday packages tailored for memorable Bhutan journeys.";
        $data['keywords'] = "about TripJyada, Bhutan travel agency, Bhutan tour operator, Bhutan holiday packages, Bhutan tours";
        $data['module'] = "about";
        $data['view_file'] = "about";
        echo Modules::run('template/layout2', $data);
    }

    function choose()
    {
        $data['title'] = "";
        $data['description'] = "";
        $data['module'] = "about";
        $data['view_file'] = "choose";
        echo Modules::run('template/layout2', $data);
    }
    
}
