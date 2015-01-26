<?php

namespace App\Module\Front\Controllers;

use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;

class IndexController extends \LibApp\Controllers\AbstractController {

    public function index(Request $request, Application $app)
    {
        $firsts = $this->getRepository("App\Model\Entities\First")->findAll();
        return $this->render('@front/index/index.html', ["firsts" => $firsts]);
    }

    public function testMail(Request $request, Application $app)
    {

        $data = array('subject' => 'tetetet', 'message' => 'sdsdsd');
        $formBuilder = new \App\Form\FormContact($app, $data);
        $form = $formBuilder->getForm();

        $form->bind($request);
        if ($request->getMethod() == "POST") {
            if ($form->isValid()) {
                $data = $form->getData();
                $message = array(
                    "to" => array("mickael.baudoin@gmail.com"),
                    "message" => (string) $data['message'],
                    "from" => array("mickael.baudoin@gmail.com" => "mickael baudoin"),
                    "subject" => (string) $data['subject']
                );
                $this->sendMail($message);
                return $this->redirect('/silex/');
            }
        }

        return $this->render('@front/mail/contact.html', array('form' => $form->createView()));
    }

}
