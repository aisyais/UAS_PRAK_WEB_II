<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

abstract class Controller
{
    // Handle incoming requests and return a response
    public function handleRequest(Request $request)
    {
        // Log the request
        $this->logRequest($request);

        // Process the request (to be implemented by child classes)
        return $this->processRequest($request);
    }

    // Log the details of the request
    protected function logRequest(Request $request)
    {
        Log::info('Request received', [
            'url' => $request->url(),
            'method' => $request->method(),
            'params' => $request->all(),
        ]);
    }

    // Abstract method to be implemented by child classes
    abstract protected function processRequest(Request $request);
}
