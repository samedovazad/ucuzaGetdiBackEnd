<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentation extends Model
{
    use SoftDeletes;

    public function getAllDocumentation()
    {
        return $this->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getFirstColumn($id)
    {
        return $this->where('id', $id)->first();
    }

    public function deleteDocumentation($id)
    {
        return $this::find($id)->delete();
    }
}
