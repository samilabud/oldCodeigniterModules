<?php
class Contacto extends Controller
{
	function contacto()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$config = array(		 
							 array(
								'field' => 'names',
								'label' => 'Nombres',
								'rules' => 'required|max_length[100]'
							 ),
							  array(
								'field' => 'email',
								'label' => 'E-Mail',
								'rules' => 'required|valid_email|max_length[150]'
							 ),							 
							  array(
								'field' => 'subject',
								'label' => 'Asunto',
								'rules' => 'required|max_length[150]'
							 ),
							  array(
								'field' => 'message',
								'label' => 'Mensaje',
								'rules' => 'required|max_length[400]'
							 )
                   );
		$this->form_validation->set_rules($config);
		
		$data = array();
		$data['success'] = false;

		if($this->form_validation->run())
		{
			if($this->input->post("email"))
			{
				$this->load->library('email');
				
				/*Sending email confirmation*/
				$config['mailtype'] = 'sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				
				$this->email->initialize($config);
				
				$this->email->from('info@apsars.com', 'APSARS');
				$this->email->to('info@apsars.com');
				$this->email->subject('Contácto');
				
				$data['nombres'] = $this->input->post('names');
				$data['telefono'] = $this->input->post('phone');
				$data['correo'] = $this->input->post('email');
				$data['mensaje'] = $this->input->post('message');
				
				$this->email->message($this->load->view("emails/contacto",$data,true));
				$this->email->send(); //sending email
				$data['success'] = true;
			}
		
		}
		$this->myload->view("contacto",$data);
	}		
}