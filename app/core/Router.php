<?php

// The Router connects incoming URLs to the right controller method.
// Without this, every page would need its own .php file, like we did before with index.php, contact.php, about-us.php. Now we define routes in config/routes.php
// and the router figures out which controller and method to call based on the URL and request method.

class Router {
    // Stores all registered routes as [method, path, [controller, action]]
    protected array $routes = [];

    // Register a route for each HTTP method
    public function get(string $path, array $handler): void {
        $this->routes[] = ['GET', $path, $handler];
    }

    public function post(string $path, array $handler): void {
        $this->routes[] = ['POST', $path, $handler];
    }

    public function put(string $path, array $handler): void {
        $this->routes[] = ['PUT', $path, $handler];
    }

    public function patch(string $path, array $handler): void {
        $this->routes[] = ['PATCH', $path, $handler];
    }

    public function delete(string $path, array $handler): void {
        $this->routes[] = ['DELETE', $path, $handler];
    }

    // Called on every request — strips the query string from the URL, then loops through all routes to find a match
    public function dispatch(string $uri, string $method): void {
        $path = '/' . trim(strtok(urldecode($uri), '?'), '/');

        foreach ($this->routes as [$routeMethod, $routePath, [$class, $action]]) {
            if ($method !== $routeMethod) {
                continue;
            }

            $params = $this->match($routePath, $path);
            if ($params === null) {
                continue;
            }

            $controller = new $class();
            if (!method_exists($controller, $action)) {
                http_response_code(500);
                echo '500 - Methode niet gevonden';
                return;
            }

            // Call the controller method and pass any URL parameters (e.g. {id}) as arguments
            $controller->$action(...array_values($params));
            return;
        }

        http_response_code(404);
        echo '404 - Pagina niet gevonden';
    }

    // Compares the registered route path against the actual URL segment by segment — returns the URL params if it matches, null if it doesn't
    private function match(string $routePath, string $requestPath): ?array {
        $routeSegments   = explode('/', trim($routePath, '/'));
        $requestSegments = explode('/', trim($requestPath, '/'));

        if (count($routeSegments) !== count($requestSegments)) {
            return null;
        }

        $params = [];

        foreach ($routeSegments as $index => $routeSegment) {
            $requestSegment = $requestSegments[$index];

            if (str_starts_with($routeSegment, '{')) {
                $params[$paramName] = $requestSegment;
            } elseif ($routeSegment !== $requestSegment) {
                return null;
            }
        }

        return $params;
    }
}
