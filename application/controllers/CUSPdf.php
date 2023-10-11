<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class CUSPdf extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Mdl_Persons', 'Mdl_Appointments','Mdl_AppointmentProducts', 'Mdl_Invoices', 'Mdl_Recipes', 'Mdl_AppointmentHistory'));
		
		$fontsFolder = ($_SERVER['HTTP_HOST'] == 'localhost:8888' || $_SERVER['HTTP_HOST'] == 'localhost') ? $_SERVER['DOCUMENT_ROOT'] . '/botanicaslyr/assets/fonts' : $_SERVER['DOCUMENT_ROOT'] . '/assets/fonts';
		$this->mpdfConfig = [
			'mode' => 'c',
        	'format' => 'A4',
			'fontDir' => [
				$fontsFolder,
			],
			'fontdata' => [
				'Courier' => [
					'R' => 'Courier.ttf',
					'I' => 'Courier.ttf',
				]
			],
			'default_font' => 'Courier',
			'debugfonts' => true,
		];
	}

    function general($id){
		$this->load->library('pdf');
		$data['products'] = $this->Mdl_AppointmentProducts->getAppointmentProducts($id);
		$data['ap'] = $this->Mdl_Appointments->appointmentGetId($id);
		$this->load->view('pages/files/general', $data);

		$html = $this->output->get_output();
 
		//$this->dompdf->set_option('defaultFont', 'Helvetica');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);

		$this->dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');

		$this->dompdf->render();

		// Output the generated PDF to Browser
		$this->dompdf->stream('factura_general_'.$id.'_'.date('Y_m_d').'.pdf', array('Attachment' => 0));
	}
}
