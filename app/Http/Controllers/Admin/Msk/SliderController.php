<?php

namespace App\Http\Controllers\Admin\Msk;

use App\Http\Requests\SliderValidator;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $data = [
            'sliders' => $this->slider->getAllSliders()
        ];

        return view('admin.msk.slider', $data);
    }

    public function addEditSlider($id = 0)
    {
        $sliders = $id > 0 ? $this->slider->getFirstColumn($id) : 0;

        $data = [
           'sliders' => $sliders,
           'id' => $id
        ];

        return view('admin.modals.msk.slider_add_edit', $data);
    }

    public function addEditSliderProcess(SliderValidator $request, $id = 0)
    {
        $validated = $request->validator;

        if(isset($validated) && $validated->fails())
        {
            $errors = view('admin.errors.errors', ['errors'=> $validated->errors() ])->render();
            return response()->json(['status'=>'error', 'errors'=>$errors]);
        }
        else
        {
            if($id == 0) {
                $sliderObj = new Slider();
            }
            else {
                $sliderObj = Slider::find($id);

                if(request()->hasFile('file'))
                    $this->slider->deleteFile($sliderObj->image_path);
            }

            $sliderObj->title = request('title');
            $sliderObj->description = request('description');
            $sliderObj->is_checked = request('is_checked');

            if(request()->hasFile('file'))
            {
                $fileName = request()->file('file');
                $filePath = Storage::disk('s3')->put("sliders",$fileName,'public');

                $sliderObj->image_path = $filePath;
            }

            $sliderObj->save();

            return response()->json(['status' => 'ok']);
        }
    }

    public function sliderDelete()
    {
        $this->slider->deleteSlider(request('id'));
    }

    public function sliderChecked()
    {
        $this->slider->updateChecked(request('id'), request('is_checked'));
    }

}
