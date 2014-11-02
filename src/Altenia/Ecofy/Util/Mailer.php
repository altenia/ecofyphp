<?php namespace Altenia\Ecofy\Util;

use Altenia\Ecofy\Service\BaseService;
use Altenia\Ecofy\Util\TemplateEngineMustache;

/**
 * Service class that provides business logic for Mail
 */
class Mailer {

	public $mailConfig = null;

    public $transport = null;
    public $mailer = null;

    public $templateEngine = null;

    /**
     * Constructor
     * @param {string} $id
     * @param {string} $mailConfig contains: 
     */
    public function __construct($mailConfig)
    {
        $this->mailConfig = $mailConfig;

        $smtpServer = $this->mailConfig['server']; // 'smtp.gmail.com';
        
        $colonPos = strrpos($smtpServer, ':');
        if ($colonPos === false) {
            $smtpHost = $smtpServer;
            $smtpPort = 25;
        } else {
            $smtpHost = substr($smtpServer, 0, $colonPos);
            $smtpPort = intval(substr($smtpServer, $colonPos+1));
        }

        if (array_key_exists('host', $this->mailConfig))
            $smtpHost = $this->mailConfig['host']; // 'smtp.gmail.com';
        if (array_key_exists('port', $this->mailConfig))
            $smtpPort = $this->mailConfig['port']; // 465;

        $serverUsername = $this->mailConfig['username'];
        $serverPassword = $this->mailConfig['password'];

        $this->transport = \Swift_SmtpTransport::newInstance($smtpHost, $smtpPort, "ssl")
            ->setUsername($serverUsername)
            ->setPassword($serverPassword);

        $this->mailer = \Swift_Mailer::newInstance($this->transport);

    }
    
    /**
     * Returns the template engine for the template 
     */
    public function getTemplateEngine() 
    {
        $te = new TemplateEngineMustache();
        $te->init();
        return $te; 
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

		$message = \Swift_Message::newInstance($subject)
			->setFrom($sender)
			->setTo($recipients)
			->setBody($body);

		$result = $this->mailer->send($message, $failuress);

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
    	$te = $this->getTemplateEngine();
        
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
    public function sendBulkTemplateMail($sender, $recipientsKey, $contexts, $subjectTemplate, $bodyTemplate, $delay = 3)
    {
    	$failures = array();
    	$errors = array();

    	$sent = 0;
    	$idx = 0;
    	foreach ($contexts as $context) {
    		++$idx;
	    	if (!empty($context[$recipientsKey])) {
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
