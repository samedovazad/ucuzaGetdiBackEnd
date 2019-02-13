<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use SoftDeletes;

    public function getAllSliders()
    {
        return $this->orderBy('created_at', 'desc')->paginate(6);
    }

    public function slidersFile()
    {
        return Storage::url($this->image_path);
    }

    public function getFirstColumn($id)
    {
        return $this->where('id', $id)->first();
    }

    public function deleteSlider($id)
    {
        $sliderObj = $this::find($id);
        $this->deleteFile($sliderObj->image_path);
        $sliderObj->delete();
    }

    public function updateChecked($id, $val)
    {
        return $this->where('id', $id)->update(['is_checked' => $val]);
    }

    public function deleteFile($path)
    {
        Storage::disk('s3')->delete($path);
    }
}
