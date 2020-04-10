<?php

declare(strict_types = 1);

namespace App\Exception;

use Hyperf\Server\Exception\ServerException;

class RequetErrorException extends ServerException
{

    

    public function __construct(string $message = "",int $code=423)
    {  
        parent::__construct($message, $code);
    }

}