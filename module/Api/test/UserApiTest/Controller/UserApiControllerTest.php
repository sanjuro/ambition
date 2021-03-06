<?php

namespace UserApiTest\Controller;

use UserApiTest\Bootstrap;
use UserApiTest\Controller\UserRestTestController;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class UserApiControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new UserRestController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }

    public function testGetListCanBeAccessed()
    {
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
         
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetCanBeAccessed()
    {
        $this->routeMatch->setParam('id', '1');
         
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
         
        $this->assertEquals(200, $response->getStatusCode());
    }
     
    public function testCreateCanBeAccessed()
    {
        $this->request->setMethod('post');
        $this->request->getPost()->set('first_name', 'foo');
        $this->request->getPost()->set('last_name', 'bar');
         
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
         
        $this->assertEquals(200, $response->getStatusCode());
    }
     
    public function testUpdateCanBeAccessed()
    {
        $this->routeMatch->setParam('id', '1');
        $this->request->setMethod('put');
         
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
         
        $this->assertEquals(200, $response->getStatusCode());
    }
 
    public function testDeleteCanBeAccessed()
    {
        $this->routeMatch->setParam('id', '1');
        $this->request->setMethod('delete');
         
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
         
        $this->assertEquals(200, $response->getStatusCode());
    }
}