<?php
namespace App\Module\Front\Controllers;
use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;

class IndexController extends \LibApp\Controllers\AbstractController{

	public function index(Request $request, Application $app){
		$firsts = $app['orm.em']->getRepository("App\Model\Entities\First")->findAll();
		return $app['twig']->render( '@front/index/index.html', ["firsts" => $firsts]);
	}
}