<?php

namespace Common\Routing\Annotations\Methods;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Delete
{
    public function __construct(public string $path) {}
}
