<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DocumentationValidator;
use App\Models\Admin\Documentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentationController extends Controller
{
    protected $doc;

    public function __construct(Documentation $doc)
    {
        $this->doc = $doc;
    }

    public function index()
    {
        $data = [
          'docs' => $this->doc->getAllDocumentation()
        ];

        return view('admin.documentation.documentation', $data);
    }

    public function addEditDoc($id = 0)
    {
        $docsObj = $id > 0 ? $this->doc->getFirstColumn($id) : 0;

        $data = [
          'docs' => $docsObj,
          'id'   => $id
        ];

        return view('admin.modals.documentation.add_edit', $data);
    }

    public function addEditDocProcess(DocumentationValidator $request, $id = 0)
    {
        $validated = $request->validator;

        if(isset($validated) && $validated->fails())
        {
            $errors = view('admin.errors.errors', ['errors'=> $validated->errors() ])->render();
            return response()->json(['status'=>'error', 'errors'=>$errors]);
        }
        else
        {
            if($id > 0)
            {
                $docObj = Documentation::find($id);
            }
            else
            {
                $docObj = new Documentation();
            }

            $docObj->title       = request('title');
            $docObj->description = request('description');

            $docObj->save();
            return response()->json(['status' => 'ok']);
        }
    }

    public function delete()
    {
        $this->doc->deleteDocumentation(request('docID'));

        return response()->json(['status' => 'ok']);
    }
}
