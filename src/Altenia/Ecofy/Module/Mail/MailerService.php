<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Service\BaseDataService;
use Altenia\Ecofy\Service\ValidationException;

/**
 * Service class that provides business logic for Mail
 */
class MailerService extends BaseService {

	public $mailConfig = null;

    /**
     * Constructor
     */
    public function __construct($id = 'Mail', $mailConfig)
    {
        parent::__construct($id);
        $this->mailConfig = $mailConfig;
    }
    
    /**
     * Sends a single simple mail
     * @param {array} $sender     Format: ['email@addr' => 'Name']
     * @param {array} $recipients Format: ['email1', 'email2',...]
     * @param {string} $subject   The message subject
     * @param {string} $body      The message body
     */
    public function sendMail($sender, $recipients, $subject, $body)
    {
    	$smtpServer = 'smtp.gmail.com';
    	$smtpPort = 465;
    	$transport = Swift_SmtpTransport::newInstance($smtpServer, $smtpPort, "ssl")
			->setUsername('GMAIL_USERNAME')
			->setPassword('GMAIL_PASSWORD');

		$mailer = Swift_Mailer::newInstance($transport);

		$message = Swift_Message::newInstance($subject)
			->setFrom($sender)
			->setTo($recipients)
			->setBody($body);

		$result = $mailer->send($message);
    }

    /**
     * Sends a single template mail
     * @param {array} $sender     Format: ['email@addr' => 'Name']
     * @param {array} $recipients Format: ['email1', 'email2',...]
     * @param {string} $body      The message body
     */
    public function sendTemplateMail($sender, $recipients, $body)
    {
    }
}
