<?php

namespace Common\Routing\Annotations;

use Attribute;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @Attributes({
 *     @Attribute("name", type="string")
 * })
 * @NamedArgumentConstructor
 * @RequiredAttributes({"name"})
 * @Target({"CLASS", "METHOD"})
 * Class Controller
 * @package Common\Routing\Annotations
 * @version 1.0
 * @since 1.0
 * @api
 *
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class Controller
{
    public function __construct(public ?string $name = "") {}
}
