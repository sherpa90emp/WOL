<?php

require_once __DIR__.'/Attributes/Route.php';

class Router
{
    private string $controllerDir;

    public function __construct(
        string $controllerDir,
    )
    {
        $this->controllerDir = rtrim($controllerDir, '/');
    }

    public function dispatch(): void
    {
        $requestUri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/', '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $files = glob($this->controllerDir . '/*.php');

        $wrongMethod = false;

        foreach ($files as $file)
        {
            require_once $file;
            $className = pathinfo($file, PATHINFO_FILENAME);

            if (!class_exists($className))
            {
                continue;
            }

            $reflection = new ReflectionClass($className);

            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
            {
                $attributes = $method->getAttributes(Route::class);

                foreach ($attributes as $attribute)
                {
                    $route = $attribute->newInstance();

                    if ($route->path === $requestUri)
                    {
                        if ($route->method === $requestMethod)
                        {
                            $controllerInstance = $this->makeConstructor($className);
                            $methodName = $method->getName();

                            $response = $controllerInstance->$methodName();

                            if ($response !== null)
                            {
                                echo $response;
                                exit;
                            }

                            http_response_code(200);
                            echo json_encode([
                                'warning' => 'Empty Response',
                                'method' => $requestMethod,
                                'uri' => $requestUri,
                            ]);
                            exit;
                        }

                        $wrongMethod = true;
                    }
                }
            }
        }

        if ($wrongMethod)
        {
            http_response_code(405);
            echo json_encode([
                'error' => 'Method Not Allowed',
                'method' => $requestMethod,
                'uri' => $requestUri,
            ]);
            exit;
        }

        http_response_code(404);
        echo json_encode([
            'error' => 'Endpoint Not Found',
            'method' => $requestMethod,
            'uri' => $requestUri,
            ]);
        exit;
    }

    private function makeConstructor(string $class): object
    {
        $constructor = (new ReflectionClass($class))->getConstructor();

        if ($constructor == null)
        {
            return new $class();
        }

        $args = [];
        foreach ($constructor->getParameters() as $param)
        {
            $type = $param->getType();

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin())
            {
                $args[] = $this->makeConstructor($type->getName());
            }
            elseif ($param->isDefaultValueAvailable())
            {
                $args[] = $param->getDefaultValue();
            }
            else
            {
                throw new Exception("Impossibile risolvere il parametro \${$param->getName()} di $class");
            }
        }

        return new $class(...$args);
    }
}