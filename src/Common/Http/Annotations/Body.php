<?php
namespace Common\Http\Annotations;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
readonly class Body
{
    public ?string $format;

    public function __construct(?string $field = null)
    {
        $this->format = $field;
    }
}
