<?php

    namespace Common\Http\Enums;

    enum HttpMethod: string
    {
      case GET = 'GET';
        case POST = 'POST';
        case PUT = 'PUT';
        case DELETE = 'DELETE';
        case PATCH = 'PATCH';
        case OPTIONS = 'OPTIONS';
        case HEAD = 'HEAD';
        case ANY  = 'ANY';
    }
