<?php namespace HSkrasek;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
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

    }
}
