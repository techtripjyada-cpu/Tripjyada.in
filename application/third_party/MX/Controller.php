<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__) . '/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link    http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright   Copyright (c) 2015 Wiredesignz
 * @version     5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
#[\AllowDynamicProperties]
class MX_Controller
{
    public $autoload = array();
    public $comp;
    public $data;
    public $load;
    public function __construct()
    {
        $suffix = CI::$APP->config->item('controller_suffix') ?? '';
        $class = str_replace($suffix, '', get_class($this));
        log_message('debug', $class . " MX_Controller Initialized");
        Modules::$registry[strtolower($class)] = $this;

        /* copy a loader instance and initialize */
        $this->load = clone load_class('Loader');
        $this->load->initialize($this);
        CI::$APP->config->load('tripjyada_mail', true);
        $mailConfig = (array) CI::$APP->config->item('tripjyada_mail');

        $supportEmail = !empty($mailConfig['support_email']) ? $mailConfig['support_email'] : 'info@tripjyada.com';
        $replyToEmail = !empty($mailConfig['reply_to_email']) ? $mailConfig['reply_to_email'] : $supportEmail;
        $companyName = !empty($mailConfig['company_name']) ? $mailConfig['company_name'] : 'Tripjyada';
        $companyDomain = !empty($mailConfig['company_domain']) ? $mailConfig['company_domain'] : 'tripjyada.in';
        $publicContactEmails = !empty($mailConfig['public_contact_emails']) && is_array($mailConfig['public_contact_emails'])
            ? $mailConfig['public_contact_emails']
            : array($supportEmail);
        $primaryPublicEmail = reset($publicContactEmails);
        $primaryPublicEmail = $primaryPublicEmail ? $primaryPublicEmail : $supportEmail;

        $this->comp['phone1']         = 'tel:+919558515518';
        $this->comp['phone1_display'] = '+91-9558515518';

        $this->comp['phone2']         = 'tel:+919083701454';
        $this->comp['phone2_display'] = '+91-9083701454';

        $this->comp['wa_number']      = '919558515518';
        $this->comp['wa_link']        = 'https://api.whatsapp.com/send?phone=919558515518';

        $this->comp['supportmail'] = $supportEmail;
        $this->comp['replyToMail'] = $replyToEmail;
        $this->comp['mail']        = $primaryPublicEmail;
        $this->comp['mailhtml']    = 'mailto:' . $primaryPublicEmail;
        $this->comp['public_contact_emails'] = $publicContactEmails;
        $this->comp['public_contact_emails_display'] = implode(', ', $publicContactEmails);
        $this->comp['company3'] = $companyName;
        $this->comp['companydomain'] = $companyDomain;

        $this->comp['facebookhtml']  = "https://www.facebook.com/share/18p4oPvY6K/?mibextid=wwXIfr";
        $this->comp['instagramhtml'] = "https://www.instagram.com/thetripjyada?igsh=a2ZqZzljMzhtOGY0";
        $this->comp['youtubehtml']   = "https://youtube.com/@tripjyadasdt?si=ILWBdwL1dBSglrJS";
        $this->comp['pinteresthtml'] = "https://pin.it/6Rxu3jTBd";
        $this->comp['linkedinhtml']  = "https://www.linkedin.com/company/tripjyada-travel-agency/";
        $this->comp['whatsapphtml']  = "https://api.whatsapp.com/send?phone=919558515518";

        $this->comp['address'] = "<address>Shivmandir, Siliguri, Darjeeling, West Bengal</address>";
        $this->comp['address1'] = "";
        $this->comp['address2'] = "";
        $this->comp['addressRegion'] = "Siliguri";
        $this->comp['postalCode'] = "734011";
        $this->comp['companystate'] = "West Bengal";
        $this->comp['themeColor'] = "#e21b22";

        $this->comp['sku'] = "tj28857";
        $this->comp['mpn'] = "tj28857";
        // Review
        $this->comp['ratingValue'] = "5";
        $this->comp['ratingCount'] = "3539";
        $this->comp['datePublished'] = "";
        $this->comp['reviewBody'] = "";
        $this->comp['reviewperson'] = "";

        /* autoload module items */
        $this->load->_autoloader($this->autoload);
    }

    public function __get($class)
    {
        return CI::$APP->$class;
    }
}
