<?php
namespace Common\Core\IOC;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Injectable
{
    public function __construct() {}
}
