<?php

namespace App\Http\Controllers\Extendables;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected function jsonResponse($data, $code)
    {
        return response()->json($this->convertDataToJsonObject($data), $code);
    }

    private function convertDataToJsonObject($data)
    {
        $convertedData = null;
        if (is_array($data)){
            $convertedData = $data;
        }
        else if ($data instanceof \Illuminate\Database\Eloquent\Collection){
            foreach ($data as $model){
                $convertedData[] = $model->toArray();
            }
        }
        else if ($data instanceof \Illuminate\Database\Eloquent\Model){
            $convertedData = $data->toArray();
        }

        return ['data' => $convertedData];
    }
}
