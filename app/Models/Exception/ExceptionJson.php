<?php

namespace App\Models\Exception;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ExceptionJson {

    private $exception;

    public function __construct(Exception $e)
    {
        $this->exception = $e;
    }

    private function getStatusCode()
    {
        if ($this->exception instanceof \Illuminate\Validation\ValidationException){
            return 400;
        }
        else{
            return 500;
        }
    }

    private function toJsonObject()
    {
        $error = [];
        if ($this->exception instanceof \Illuminate\Validation\ValidationException){
            $validationErrors = $this->exception->validator->errors();
            foreach ($validationErrors->keys() as $key){
                $error[] = [
                    'type' => 'validation',
                    'field' => $key,
                    'description' => join(' ', $validationErrors->get($key))
                ];
            }
        }
        else if ($this->exception instanceof QueryException){
            $error['type'] = 'database';
            $error['description'] = 'There was a database error';
        }
        else if ($this->exception instanceof ModelNotFoundException){
            $error['type'] = 'missing';
            $error['description'] = 'No results found';
        }
        else{
            $error['type'] = get_class($this->exception);
            $error['description'] = $this->exception->getMessage();
        }
        return $error;
    }

    public function getResponse()
    {
        return response()->json($this->toJsonObject(), $this->getStatusCode());
    }
}