<?php

class MailerTest extends PHPUnit_Framework_TestCase {

	private $config;

	protected function setUp()
    {
    	$this->config = array(
    		'server' => 'smtp.gmail.com:465',
    		//'host' => 'smtp.gmail.com',
			//'port' => 465,
			'username' => 'kineart',
			'password' => 'cocobolo1',
			);
    }

	/**
	 * Test updating an empty policy
	 */
	public function testSendMail()
	{
		$this->markTestSkipped();

		$mailer = new Altenia\Ecofy\Util\Mailer($this->config);
        
        $sender = array('kineart@gmail.com' => 'YS from Kine');
        $recipients = array('ys.ahnpark@gmail.com');
        $failures = array();
        $result = $mailer->sendMail($sender, $recipients, 'Ecofy UTest: SendMail', 'Send success', $failures);
        $this->assertEquals(1, $result);
	}

	public function testSendTemplateMail()
	{
		$this->markTestSkipped();
		$mailer = new Altenia\Ecofy\Util\Mailer($this->config);
        
        $sender = array('kineart@gmail.com' => 'Kineart');
        $recipients = array('ys.ahnpark@gmail.com');
        $context = array('var' => 'Hello');
        $failures = array();
        $result = $mailer->sendTemplateMail($sender, $recipients, $context, 'Ecofy UTest2: SendTemplateMail {{var}}', 'Template with variable: {{var}}', $failures);
        $this->assertEquals(1, $result);
	}

	public function testBulkSendTemplateMail()
	{
		//$this->markTestSkipped();
		
		$mailer = new Altenia\Ecofy\Util\Mailer($this->config);
        
        $sender = array('kineart@gmail.com' => 'Kineart');
        $recipients = array('ys.ahnpark@gmail.com');
        $contexts = array(
        	array('rcv'=> 'ys.ahnpark@gmail.com', 'var' => 'HAHA'),
        	array('rcv'=> 'kineart@gmail.com', 'var' => 'HOHO'),
        	array('rcv'=> 'invalidemail', 'var' => 'NANO')
        	//array('rcv'=> 'noone@nonexistentdomain.com', 'var' => 'NANA'),
        	);
        $failures = array();
        $result = $mailer->sendBulkTemplateMail($sender, 'rcv', $contexts, 'Ecofy UTest: BulkSendTemplateMail {{var}}', 'Template with variable: {{var}}');
        //print_r($result);
        $this->assertEquals(2, $result['sent']);
        $this->assertEquals(1, count($result['errors']));
        //$this->assertEquals(1, count($result['failures']));
	}
}