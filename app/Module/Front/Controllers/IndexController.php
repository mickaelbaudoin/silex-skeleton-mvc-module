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
            
            $data = array('subject' => 'tetetet', 'message' => 'sdsdsd');
            $formBuilder = new \App\Form\FormContact($app, $data);
            $form = $formBuilder->getForm();
            
            $form->bind($request);
            if($request->getMethod() == "POST"){
                if($form->isValid()){
                    $data = $form->getData();
                    $message = array(
                        "to"        => array("mickael.baudoin@gmail.com"),
                        "message"   => (string) $data['message'],
                        "from"      => array("mickael.baudoin@gmail.com" => "mickael baudoin"),
                        "subject"   => (string) $data['subject']
                    );
                    $app['mailer']->send($message); 
                    return $app->redirect('/silex/');
                }
                
            }
                        
            return $app['twig']->render( '@front/mail/contact.html', array('form' => $form->createView()));
        }
}