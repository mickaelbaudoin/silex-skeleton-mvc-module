<?php
namespace App\Module\Front\Controllers;
use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;

class IndexController extends \LibApp\Controllers\AbstractController{

	public function index(Request $request, Application $app){
            $firsts = $app['orm.em']->getRepository("App\Model\Entities\First")->findAll();
            return $app['twig']->render( '@front/index/index.html', ["firsts" => $firsts]);
	}
        
        public function testMail(Request $request, Application $app){
            $message = array(
                "to"        => array("mickael.baudoin@gmail.com"),
                "message"   => "Test envoi mail avec silex skeleton",
                "from"      => array("mickael.baudoin@gmail.com" => "mickael baudoin"),
                "subject"   => "Test envoi mail avec silex skeleton"
            );
            $app['mailer']->send($message);
            
            return $app['twig']->render( '@front/mail/contact.html');
        }
}