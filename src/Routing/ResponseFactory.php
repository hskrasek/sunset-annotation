<?php namespace HSkrasek\Routing;

use Doctrine\Common\Annotations\SimpleAnnotationReader;
use HSkrasek\Annotations\Sunset;
use Illuminate\Contracts\Routing\ResponseFactory as FactoryContract;
use Illuminate\Routing\ResponseFactory as IlluminateResponseFactory;

class ResponseFactory extends IlluminateResponseFactory implements FactoryContract
{
    public function json($data = [], $status = 200, array $headers = [], $options = 0)
    {
        $trace      = last(debug_backtrace(
            DEBUG_BACKTRACE_PROVIDE_OBJECT, 2
        ));
        $controller = new \ReflectionClass($trace['class']);
        $method     = $controller->getMethod($trace['function']);

        collect(app(SimpleAnnotationReader::class)->getMethodAnnotations($method))->each(function ($annotation) use (&$headers) {
            if ($annotation instanceof Sunset) {
                $headers['X-Sunset'] = $annotation->message;
            }
        });

        return parent::json($data, $status, $headers, $options);
    }
}
