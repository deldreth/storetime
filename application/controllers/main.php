<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->database();
		$this->load->helper('url');

		// Load the users
		$users = $this->db->get('users');
		$data['users'] = $users->result();

		usort($data['users'], 'cmp');
			
		// Get the last day in history	
		$this->db->select_max('date', 'date');
		$lastDay = $this->db->get('history');
		$data['lastDay'] = $lastDay->result();
	
		$this->load->view('index', $data);
	}

	public function update ($userId = null)
	{
		if ($_REQUEST['userId'] !== null) {
			$userId = $_REQUEST['userId'];
		}

		if ($userId === null) {
			return false;
		}

		$this->load->database();

		// Update that users last day
		$lastDay = array(
			'lastDay' => date('c', strtotime(date('c')) - 5 * 3600)
		);
		$this->db->update('users', $lastDay, array('id' => $userId));

		// Insert a history record
		$history = array(
			'user_id' => $userId,
			'date'    => date('c', strtotime(date('c')) - 5 * 3600)
		);
		$this->db->insert('history', $history);

		$this->load->helper('url');
		redirect('main/index');
	}

	public function history () {
		$this->load->database();
		$this->load->helper('url');

		$this->db->select('*');
		$this->db->from('history');
		$this->db->order_by('date', 'desc');
		$this->db->join('users', 'users.id = history.user_id');

		$history = $this->db->get();
		$data['history'] = $history->result();

		$this->load->view('history', $data);
	}

	public function celebrity () {
		$this->load->database();
		$history = array(
			'user_id' => 0,
			'date'    => date('c', strtotime(date('c')) - 5 * 3600)
		);

		$this->db->insert('history', $history);

		$this->load->helper('url');
		redirect('main/index');
	}
}

function cmp($a, $b) {
	$at = strtotime($a->lastDay);
	$bt = strtotime($b->lastDay);

	if ($at == $bt) {
		return 0;
	}

	return ($at < $bt) ? -1 : 1;
}
/* End of file index.php */
