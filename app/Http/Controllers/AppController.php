<?php

namespace App\Http\Controllers;

use App\Models\AppData;
use App\Models\Slider;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AppController extends Controller
{
    use ResponseTrait;
    public function getAppData()
    {
        $app_data = AppData::first();
        $app_data->native_ad = (int)$app_data->app_store;

        return $this->success("App Data", $app_data);
    }
}
