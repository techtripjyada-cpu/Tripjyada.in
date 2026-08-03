<?php
if (file_exists(APPPATH . "modules/bhutan_tour/views/data/$slug.php")) {
    include "data/$slug.php";
} else {
    redirect(site_url('group-tour'));
}
include 'package_layout.php';
