<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class Handler extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
        return "No";
    }
 
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response("no");
    }
}
