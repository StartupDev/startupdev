<?php

require_once dirname(__DIR__).'/bootstrap.php';	
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();


// register twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT . '/views',
));

// register swiftmailer
$transport = Swift_SmtpTransport::newInstance(MAIL_HOST, MAIL_PORT, 'ssl')
	        ->setUsername(MAIL_USER)
	        ->setPassword(MAIL_PASS);
$app['swiftmailer'] = Swift_Mailer::newInstance($transport);

// Application
$app->get('/', function () use ($app) {
	return $app['twig']->render('layout.twig');
});

$app->post('/send', function () use ($app) {
	try{
		$request = $app['request'];
		$mailer = $app['swiftmailer'];

		$name = $app->escape($request->get('name'));
		$email = $app->escape($request->get('email'));
		$message = $app->escape($request->get('message'));

		$body = sprintf("Name: %s\nEmail: %s\nMessage: %s", $name, $email, $message);
	
	    $message = Swift_Message::newInstance()
	        ->setSubject('[Startup Dev] Contact')
	        ->setFrom(array( $email ))
	        ->setTo(array( MAIL_USER ))
	        ->setBody($body);


	   	$result = array('success' => false, 'msg' => 'Email not sent.' );
	    if( $mailer->send($message) ){
	    	$result = array('success' => true, 'msg' => 'OK, we will return ASAP =)' );
	    }
	   	die(json_encode($result));
	}catch(\Exception $e){
		$result = array('success' => false, 'msg' => $e->getMessage() );
		die(json_encode($result));
	}
});



$app->run();