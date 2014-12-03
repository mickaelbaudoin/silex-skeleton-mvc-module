<?php
namespace Flashweb\Module\Admin\Controllers;
use \Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends \Baudoin\Controllers\AbstractController{

	public function index(Request $request, Application $app){
		return $app['twig']->render( '@admin/index/index.html', array());
	}
}