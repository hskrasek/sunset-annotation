<?php namespace HSkrasek\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class Sunset
{
    /**
     * @Required
     * @var string
     */
    public $message;
}
