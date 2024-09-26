<?php
    require __DIR__.'/launch.php';

    const APP_DIRECTORY = __DIR__;

    use Symfony\Component\Routing\RequestContext;
    use Symfony\Component\Routing\Matcher\UrlMatcher;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;

    class AppKernel
    {
        private $router;

        public function __construct($router)
        {
            $this->router = $router;
        }

        public function hadle(Request $request): JsonResponse
        {
            try {
                $context = new RequestContext();
                $context->fromRequest($request);
                $matcher = new UrlMatcher($this->router, $context);

                $parameters = $matcher->match($request->getPathInfo());
                $controller = $parameters['_controller'];
                $reponse = new JsonResponse($controller);
                $response->setStatusCode($controller['status']);
            } catch (\Exception $exception) {
                $response = new JsonResponse([
                    'response' => $exception->getMessage(),
                    'status' => $exception->getCode() ?: 500,
                ]);
            }

            return $reponse;
        }
    }

    $router = include __DIR__.'/config/routes.php';
    $appkernel = new AppKernel($router);
    $request = Request::createFromGlobals();
    $response = $appkernel->handle($request);
    $response->send();
?>