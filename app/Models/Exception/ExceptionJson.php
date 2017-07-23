<?php

namespace App\Models\Exception;

use Exception;

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
                    'type' => get_class($this->exception),
                    'field' => $key,
                    'description' => join(' ', $validationErrors->get($key))
                ];
            }
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