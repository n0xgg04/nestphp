<?php

namespace Common\Core;

use AllowDynamicProperties;
use Closure;

#[AllowDynamicProperties]
class ContextualBindingBuilder
{
    protected Container $container;
    protected string $concrete;

    public function __construct(Container $container, string $concrete)
    {
        $this->container = $container;
        $this->concrete = $concrete;
    }

    public function needs(string $abstract): self
    {
        $this->abstract = $abstract;
        return $this;
    }

    public function give(string|Closure $implementation): void
    {
        $this->container->contextualBindings[$this->abstract] = $implementation;
    }
}
