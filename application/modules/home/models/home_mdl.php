<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Home_mdl extends CI_Model
{



	public function message()
	{

		$this->load->library('email');
		$this->email->set_mailtype("html");

		$client_email = $_POST['requestemail'];
		$client_phone = $_POST['requestphone'];
		$client_message = $_POST['requestmessage'];

		$message = "Urgent Quotation Required !!! <br><font color='red'>Email : $client_email </font><br><br><h3>Phone Number: $client_phone</h3>Message: <b> $client_message</b>";

		//clients mail
		$admin_email = "niram@gmail.com";
		$this->email->to($client_email);
		$this->email->from($admin_email);
		$this->email->subject('Thanks for requesting a Quotation');
		$this->email->message("Hi $client_email,<br> Thanks for requesting a Quotation from Niram Paint  <i>(https://www.niram.com/)</i>. We will get back to you soon.<br><br><br>Regards,<br>Niram Paint ($admin_email)<br>
	            <img src='" . base_url() . "assets/logo.png' height='120px' alt='Tripjyada logo' loading='lazy'>");
		$this->email->send();

		//admin mail
		$this->email->to($admin_email);
		$this->email->from($client_email);
		$this->email->subject("New Quotation Required");
		$this->email->message($message);
		$this->email->send();

		return true;
	}
}
