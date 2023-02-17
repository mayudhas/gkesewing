<?php
namespace App\Services;

use CodeIgniter\CodeIgniter as BaseCodeIgniter;
use Config\Services;
use ReflectionMethod;
use ReflectionNamedType;

final class CodeIgniter extends BaseCodeIgniter
{
    /**
     * @throws \ReflectionException
     */
    protected function createController(...$args)
    {
        $r = new ReflectionMethod($this->controller, '__construct');
        $parameters = [];
        foreach ($r->getParameters() as $parameter) {
            /** @var ReflectionNamedType */
            $reflectionNamedType = $parameter->getType();
            $parameters[] = new ($reflectionNamedType->getName())();
        }
        $class = new $this->controller(...$parameters);
        $class->initController($this->request, $this->response, Services::logger());
        $this->benchmark->stop('controller_constructor');
        return $class;
    }
}