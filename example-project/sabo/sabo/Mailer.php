<?php

namespace Sabo\Sabo;

use \PHPMailer\PHPMailer\PHPMailer;

use \Exception;

use \Sabo\Custom\RouteCustomExtensions;

use \Twig\Loader\FilesystemLoader;

use \Twig\Environment;

class Mailer
{
	private PHPMailer $mailer;

	public function __construct
	(
		private readonly Array $mail_list,
		private readonly string $subject,
		private readonly string $template_path,
		private readonly FilesystemLoader $twig_file_loader,
		private readonly RouteCustomExtensions $custom_extension,
		private readonly Array $template_data = [], 
		private readonly string $alt_content = 'Une erreur s\'est produite à l\'envoi',
	)
	{
        $this->mailer = new PHPMailer(true);

        $this->mailer->isSMTP();
        $this->mailer->CharSet = "UTF-8";
        $this->mailer->Encoding = "base64";
        $this->mailer->SMTPSecure = "ssl";
        $this->mailer->SMTPDebug = 0;
        $this->mailer->Port = 465;
        $this->mailer->SMTPAuth = true;
	}

	public function send_mail():bool
	{
		$this->mailer->isHTML(true);
        $this->mailer->setFrom($_ENV['mailer']['email'],strtoupper($_ENV['appname']) );

        list(
        	'host' => $this->mailer->Host,
        	'email' => $this->mailer->Username,
        	'password' => $this->mailer->Password
        ) = $_ENV['mailer'];

        try
        {
        	foreach($this->mail_list as $receiver_email)
                $this->mailer->addAddress($receiver_email);

            $this->mailer->Subject = $this->subject;
            $this->mailer->AltBody = $this->alt_content;

	        $twig = new Environment($this->twig_file_loader, [
	            'cache' => false,
	            'charset' => 'utf-8'
	        ]);

        	$twig->addExtension($this->custom_extension);

        	$this->mailer->Body = $twig->render($this->template_name,$this->template_data);

            return $this->mailer->send();
        }
        catch(Exception)
        {
        	return false;
        }
	}
}