<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends MX_Controller
{
    //wGtRkO8VoEyUjS
    function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_contact');
    }
    function index()
    {
        $this->load->view('data');
    }
    function booking()
    {
    	$this->load->view('booking');
    }

    function view_data()
    {
    	$where=null;
    	if (isset($_GET['id']))
    		$where['id']=$_GET['id'];
    		
    		if (isset($_GET['met']))
    			$where['message']=$_GET['met'];
    			
    			if (isset($_GET['data']))
    				$select=$_GET['data'];
    				else $select="*";
    				
    				$return=$this->mdl_contact->view_data($where,$select);
    				$this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }
    function view_booking()
    {
        $where=null;
        if (isset($_GET['id']))
	         $where['id']=$_GET['id'];
        
        if (isset($_GET['data']))
	        $select=$_GET['data'];
	    else $select="*";

        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        $date_from = $this->sanitize_export_date($this->input->get('date_from', true));
        $date_to = $this->sanitize_export_date($this->input->get('date_to', true));
        list($date_from, $date_to) = $this->normalize_date_range($date_from, $date_to);

	    $return=$this->mdl_contact->view_book($where,$select,$search,$date_from,$date_to);
        $this->output->set_content_type('application/json')->set_output(json_encode($return->result_array()));
    }

    function export_booking()
    {
        $this->require_admin_session();

        $search = $this->input->get('search', true);
        $search = is_string($search) ? trim($search) : '';
        $date_from = $this->sanitize_export_date($this->input->get('date_from', true));
        $date_to = $this->sanitize_export_date($this->input->get('date_to', true));
        list($date_from, $date_to) = $this->normalize_date_range($date_from, $date_to);
        $rows = $this->mdl_contact->view_book(null, "*", $search, $date_from, $date_to)->result_array();

        $meta = array(
            'search' => $search,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'count' => count($rows),
            'exported_at' => date('Y-m-d H:i:s'),
        );

        $this->load->module("logs");
        $this->logs->add_data("Booking Export", json_encode($meta));

        $filenameSuffix = $date_from || $date_to
            ? (($date_from ?: 'start') . '-to-' . ($date_to ?: 'end'))
            : date('Y-m-d-H-i-s');
        $filename = 'bookings-' . $filenameSuffix . '.xls';

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "<html><head><meta charset='UTF-8'></head><body>";
        echo "<table border='1' cellspacing='0' cellpadding='6'>";
        echo "<tr style='background:#f2f2f2;font-weight:bold;'>";
        echo "<th>S.No.</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone</th>";
        echo "<th>From</th>";
        echo "<th>To</th>";
        echo "<th>Message</th>";
        echo "<th>Timestamp</th>";
        echo "</tr>";

        if (!empty($rows))
        {
            $i = 1;
            foreach ($rows as $row)
            {
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['name']) ? $row['name'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['email']) ? $row['email'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['phone']) ? $row['phone'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['mfrom']) ? $row['mfrom'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['mto']) ? $row['mto'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['msg']) ? $row['msg'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars(isset($row['timestamp']) ? $row['timestamp'] : '', ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }
        }
        else
        {
            echo "<tr><td colspan='8'>No bookings found.</td></tr>";
        }

        echo "</table></body></html>";
        exit;
    }
    function delete_data()
    {
        if (isset($_GET['id']) && $_GET['id'])
        {
            $where['id']=$_GET['id'];
            $object=json_encode($this->mdl_contact->view_data($where,"*")->result());
            $data_title= "Booking Delete";
            
            $this->load->module("logs");
            if ($this->logs->add_data($data_title,$object)) {
                echo $this->mdl_contact->delete_data($where);
            }
        }
    }

    private function require_admin_session()
    {
        if (! $this->session->userdata('username'))
        {
            redirect('login');
            exit;
        }
    }

    private function sanitize_export_date($value)
    {
        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);
        if ($value === '') {
            return null;
        }

        if (preg_match('/^\d{4}-\d{2}-\d{2}T/', $value)) {
            $value = substr($value, 0, 10);
        }

        $date = DateTime::createFromFormat('Y-m-d', $value);
        return ($date && $date->format('Y-m-d') === $value) ? $value : null;
    }

    private function normalize_date_range($date_from, $date_to)
    {
        if ($date_from && $date_to && $date_from > $date_to) {
            $tmp = $date_from;
            $date_from = $date_to;
            $date_to = $tmp;
        }

        return array($date_from, $date_to);
    }
}
?>
