<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function openDocumentation(Request $request)
    {
        $entityType = $request->input('entityType');
        $entityId = $request->input('entityId');

        return view('documentation', ['entityType' => $entityType, 'entityId' => $entityId]);
    }

    public function upload(Request $request)
    {
        if ($request->hasAny('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store(path: 'public/PDF_files');
            $uploadedFile = new File();
            $uploadedFile->file_name = $fileName;
            $uploadedFile->file_path = $filePath;
            $uploadedFile->entity_type = $request->input('entity_type');
            $uploadedFile->entity_id = $request->input('entity_id');
            $uploadedFile->save();

            return response()->json(['success' => true, 'file_path' => $filePath]);
        } else {
            return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
        }
    }

    public function previewPdf(Request $request)
    {
        //if (!Storage::exists($file->file_path)) {
          //  abort(404);
        //}

        return view('PDF_preview', ['file' =>  $request->input('file_id')]);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
