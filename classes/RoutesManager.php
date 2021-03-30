<?php

namespace JosephCrowell\OcRestApi\Classes;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use JosephCrowell\OcRestApi\Models\Resource;
use Tymon\JWTAuth\Http\Middleware\Authenticate;

class RoutesManager
{
    private const ROUTE_PATH = __DIR__ . '/../routes.php';
    private const ROUTE_TEMPLATE_PATH = __DIR__ . '/../templates/route.tpl';
    private const ROUTE_TEMPLATE_PLACEHOLDERS = [
        '%router_method%',
        '%base_endpoint%',
        '%controller_class%',
        '%options%',
        '%route_methods%',
    ];

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $routeTemplate;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->routeTemplate = $this->filesystem->get(self::ROUTE_TEMPLATE_PATH);
    }

    public function syncRoutes(Collection $resources): bool
    {
        $routesString = "<?php\n\n";

        foreach ($resources as $resource) {
            $routesString .= $this->compileRoute($resource);
        }

        return $this->filesystem->put(self::ROUTE_PATH, $routesString);
    }

    private function compileRoute(Resource $resource): string
    {
        $actionMethod = $resource->controller_method ? '@' . $resource->controller_method : '';
        $replacements = [
            $resource->router_method,
            $resource->base_endpoint,
            ApiControllersManager::getFullyQualifiedControllerClass($resource) . $actionMethod,
            $this->getOptions($resource),
            $this->getRouteMethods($resource),
        ];

        return str_replace(self::ROUTE_TEMPLATE_PLACEHOLDERS, $replacements, $this->routeTemplate);
    }

    private function getOptions(Resource $resource): string
    {
        if ($this->isApiResourceRouteMethod($resource) && $resource->is_auth_required) {
            return ", ['middleware' => '" . Authenticate::class . "']";
        }

        return '';
    }

    private function getRouteMethods(Resource $resource): string
    {
        if (!$this->isApiResourceRouteMethod($resource) && $resource->is_auth_required) {
            return sprintf("->middleware('%s')", Authenticate::class);
        }

        return '';
    }

    private function isApiResourceRouteMethod(Resource $resource): bool
    {
        return $resource->router_method === 'apiResource';
    }
}
