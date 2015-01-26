<?php

namespace LibApp\Controllers;
use \Silex\Application;

abstract class AbstractController{
    
    /**
     *
     * @var Silex\Application $app
     */
    protected $app;
    
    /**
     * Constructor.
     * 
     * @param \Silex\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * Return view partial
     * @param string $view
     * @param array $params
     */
    protected function render($view, array $params)
    {
        return $this->app['twig']->render($view, $params);
    }
    
    /**
     * Return repository 
     * @param string $entity
     * @return App\Model\Entities;
     */
    protected function getRepository($entity)
    {
         return $this->app['orm.em']->getRepository($entity);
    }
    
    /**
     * Send mail
     * 
     * "to" => array("mail@example.com"),
     * "message" => (string),
     * "from" => array("example@example.com" => "mickael baudoin"),
     * "subject" => (string)
     * 
     * @param array $message
     */
    protected function sendMail(array $message)
    {
        $this->app['mailer']->send($message);
    }
    
    /**
     * Redirect
     * @param string $url
     */
    protected function redirect($url)
    {
        return $this->app->redirect($url);
    }
}