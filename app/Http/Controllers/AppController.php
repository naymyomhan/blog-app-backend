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
        $app_data->native_ad = $app_data->app_store;

        return $this->success("App Data", $app_data);
    }

    public function getSliders()
    {
        $sliders = Slider::where('sensitive', 0)->get();
        foreach ($sliders as $slider) {
            $slider->image = env('APP_URL') . "/storage/" . $slider->image;
            unset($slider->created_at);
            unset($slider->updated_at);
        }
        return $this->success("Sliders", $sliders);
    }
}
