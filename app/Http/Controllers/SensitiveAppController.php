<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SensitiveAppController extends Controller
{
    use ResponseTrait;
    public function getSliders()
    {
        $sliders = Slider::where('sensitive', 1)->get();
        foreach ($sliders as $slider) {
            $slider->image = env('APP_URL') . "/storage/" . $slider->image;
            unset($slider->created_at);
            unset($slider->updated_at);
        }
        return $this->success("Sliders", $sliders);
    }
}
