<?php
namespace App\Modules\Pages;

use Common\Http\Traits\DTO;

class HomeDTO
{
    use DTO;

    public string $name;
    public string $message;
}
