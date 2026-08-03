<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends MX_Controller {
    

    function photo_gallery()
    {
        $data['title'] = "Travel Photo Gallery | TripJyada";
        $data['description'] = "Browse TripJyada's Bhutan travel photo gallery. Discover stunning images of monasteries, valleys, festivals, and unforgettable tour moments across Bhutan.";
        $data['keywords'] = "travel photo gallery, Bhutan photos, tour images, TripJyada gallery, destination photos";
        $data['module']="gallery";
        $data['view_file']="photo-gallery";
        echo Modules::run('template/layout2',$data);
    }
    

}
