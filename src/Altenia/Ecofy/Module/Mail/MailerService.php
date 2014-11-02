<?php namespace Altenia\Ecofy\Module\Mail;

use Altenia\Ecofy\Service\BaseService;
use Altenia\Ecofy\Util\TemplateEngineMustache;

/**
 * Service class that provides business logic for Mail
 */
class MailerService extends BaseService {

	public $mailConfig = null;

    /**
     * Constructor
     * @param {string} $id
     * @param {string} $mailConfig contains: 
     */
    public function __construct($mailConfig, $id = 'Mailer')
    {
        parent::__construct($id);
        $this->mailConfig = $mailConfig;

        
        $transport = \Swift_SmtpTransport::newInstance($smtpServer, $smtpPort, "ssl")
            ->setUsername($serverUsername)
            ->setPassword($serverPassword);

        $mailer = \Swift_Mailer::newInstance($transport);

    }
    
    /**
     * Sends a single simple mail
     * @param {array} $sender     Format: ['email@addr' => 'Name']
     * @param {array} $recipients Format: ['email1', 'email2',...]
     * @param {string} $subject   The message subject
     * @param {string} $body      The message body
     */
    public function sendMail($sender, $recipients, $subject, $body, &$failures)
    {
    	$smtpServer = 'smtp.gmail.com';
    	$smtpPort = 465;

        $serverUsername = $this->mailConfig['username'];
        $serverPassword = $this->mailConfig['password'];

		$message = \Swift_Message::newInstance($subject)
			->setFrom($sender)
			->setTo($recipients)
			->setBody($body);

		$result = $mailer->send($message, $failuress);

		return $result;
    }

    /**
     * Sends a single template mail
     * @param {array} $sender     Format: ['email@addr' => 'Name']
     * @param {array} $recipients Format: ['email1', 'email2',...]
     * @param {array} $context    The context to send as parameter to the template
     * @param {string} $subjectTemplate   The message subject template
     * @param {string} $bodyTemplate      The message body template
     */
    public function sendTemplateMail($sender, $recipients, $context, $subjectTemplate, $bodyTemplate, &$failures)
    {
    	$te = new TemplateEngineMustache();
        $te->init();
    	$subject = $te->render($subjectTemplate, $context);
    	$body = $te->render($bodyTemplate, $context);

    	return $this->sendMail($sender, $recipients, $subject, $body, $failures);
    }

    /**
     * Sends a single template mail
     * @param {array} $sender        Format: ['email@addr' => 'Name']
     * @param {array} $recipientsKey  The property key in the contexts to use as recipients
     * @param {array<array>} $contexts   The context to send as parameter to the template
     * @param {string} $subjectTemplate  The message subject template
     * @param {string} $bodyTemplate     The message body template
     * @param {int} $delay               Delay between mail delivery in seconds.
     *
     * @return the number of email 
     */
    public function sendBulkTemplateMail($sender, $recipientsKey, $contexts, $subjectTemplate, $bodyTemplate, $delay = 2)
    {
    	$failures = array();
    	$errors = array();

    	$sent = 0;
    	$idx = 0;
    	foreach ($contexts as $context) {
    		++$idx;
	    	if (array_key_exists($recipientsKey, $context) && !empty($context[$recipientsKey])) {
		    	$recipients = $context[$recipientsKey];
                if (!is_array($recipients)) {
                    $recipients = array($recipients);
                }
                $invalidEmails = $this->validateEmails($recipients);
                if(empty($invalidEmails)) {
                    $sent += $this->sendTemplateMail($sender, $recipients, $context, $subjectTemplate, $bodyTemplate, $failures);
                } else {
                    $errors[] = 'Context[' . $idx . '] has invalid email: ' . implode(',', $invalidEmails);
                }
		    	sleep($delay);
		    } else {
		    	$errors[] = 'Context[' . $idx . '] does not contain recipients';
		    }
	    }

		$result = array(
			'sent' => $sent,
    		'failures' => $failures,
    		'errors' => $errors
    		);
    	return $result;
    }

    public function validateEmails($emails) {
        $invalids = array();
        foreach ($emails as $email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $invalids[] = $email;
            }
        }
        return (count($invalids) > 0) ? $invalids : null;
    }
}
