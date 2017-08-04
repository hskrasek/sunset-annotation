<?php namespace HSkrasek;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use HSkrasek\Routing\ResponseFactory;
use Illuminate\Contracts\Routing\ResponseFactory as ResponseFactoryContract;
use Illuminate\Contracts\View\Factory as ViewFactoryContract;
use Illuminate\Support\ServiceProvider;

class SunsetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(SimpleAnnotationReader::class, function () {
            /** @var SimpleAnnotationReader $annotationReader */
            $annotationReader = new SimpleAnnotationReader;
            $annotationReader->addNamespace('HSkrasek\\Annotations');

            return $annotationReader;
        });

        AnnotationRegistry::registerLoader('class_exists');
    }

    public function register()
    {
        $this->app->singleton(ResponseFactoryContract::class, function ($app) {
            return new ResponseFactory($app[ViewFactoryContract::class], $app['redirect']);
        });
    }
}
