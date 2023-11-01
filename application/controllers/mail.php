<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mail extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('v_mail');
	}

	public function enviaEmail()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('senha', 'senha', 'required');
		$this->form_validation->set_rules('EmailDest', 'E-mail do destinatário', 'required|valid_email');
		$this->form_validation->set_rules('textoDest', 'Texto', 'required');
		$this->form_validation->set_rules('QtdeDest', 'Quantidade', 'required');

		if ($this->form_validation->run() == FALSE) {
			$retorno = array(
				'mensagens' => validation_errors(),
				'cod' => 2
			);
		} else {

			$dados = $this->input->post();


			// $TPemail = $dados['TPemail'];
			$email = $dados['email'];
			$senha = $dados['senha'];
			$EmailDest = $dados['EmailDest'];
			$textoDest = $dados['textoDest'];
			$QtdeDest = $dados['QtdeDest'];

			// if ($TPemail == 'outlook') {
			$smtp = 'smtp-mail.outlook.com';
			// } else {
			// 	$smtp = 'smtp.gmail.com';
			// }

			for ($i = 0; $i < $QtdeDest; $i++) {

				/* Load PHPMailer library */
				$this->load->library('phpmailer_lib');

				/* PHPMailer object */
				$mail = $this->phpmailer_lib->load();
				$mail->ClearAddresses();
				$mail->clearAttachments();

				// echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded');

				/* SMTP configuration */
				$mail->isSMTP();
				$mail->SMTPDebug = 0;        // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
				$mail->Host     = $smtp;
				$mail->SMTPAuth = true;
				$mail->Username = "$email";
				$mail->Password = "$senha";
				$mail->SMTPSecure = 'tls';
				$mail->Port     = 587;

				//
				$mail->setFrom("$email", 'Mail');
				//  $mail->addReplyTo('andre.ferreira@cinpal.com', 'Mail');

				/* Add a recipient */
				$mail->addAddress("$EmailDest");


				// $mail->Subject = "Novo teste";
				// $mail->AddAttachment('C:\Users\DANIEL.COSTA\Downloads\sol.jpg');

				/* Add cc or bcc */
				//  $mail->addCC('');
				//  $mail->addBCC('');

				/* Email subject */
				$mail->Subject = 'Email enviado pelo phpmailer 26/10/2023';

				/* Set email format to HTML */
				$mail->isHTML(true);

				/* Email body content */
				$mailContent = "$textoDest";
				$mail->Body = $mailContent;

				$retorno = 0;
				if (!$mail->send()) {
					$retorno = array(
						'mensagens' => $mail->ErrorInfo,
						'cod' => 3
					);
				}else{
					$retorno = array(
						'mensagens' => 'Sucesso',
						'cod' => 1
					);
				}
			}
	
		}
		echo json_encode($retorno);
	}
}
