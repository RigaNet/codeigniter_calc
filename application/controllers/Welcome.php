<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{

        $this->load->library('currency_converter');

		if(isset($_POST['action']) AND $_POST['action'] == 'CalcFormHandler') {
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            if ($this->form_validation->run() == FALSE) {
                $params = [];
                parse_str($_POST['FormData'], $params);
                $total = $this->currency_converter->convertcurrency($params['amount'], $params['from'], $params['to']);

                if($total != 0) {
                    $json['result'] = $total . ' ' .$params['to'];
                } else {
                	$json['result'] = 'Error';
                }
            } else {
                $json['result'] = 'Error';
            }

            echo json_encode($json);
			exit;
    
		}
        
        $rates = $this->currency_converter->getcurrency();
        $data['rates'] = $rates;
        $this->load->view('welcome_message', $data);
        
    }
}
