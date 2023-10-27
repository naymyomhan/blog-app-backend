<?php

namespace App\Http\Controllers;

use App\Models\AppData;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AppController extends Controller
{
    use ResponseTrait;
    public function getAppData()
    {
        $app_data = AppData::first();

        return $this->success("App Data", $app_data);
    }
}
