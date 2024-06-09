<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function showUploadForm(){
        $files = Storage::disk('public')->files('uploads');
        $files = array_map(function($file) {
            return str_replace('uploads/', '', $file);
        }, $files);
        return view('welcome', compact('files'));
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:pdf,xlx,csv|max:2048',
        ]);
        // Handle the file upload
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // Store the file in the 'uploads' directory in the 'public' disk
            return back()->with('success', 'File uploaded successfully')->with('path', $path);
        }
        return back()->withErrors('File upload failed');
    }

    public function destroy($file){
        $decoded_file = urldecode($file);
        $full_path = 'uploads/' . $decoded_file;
        Storage::disk('public')->delete($full_path);
        return back()->with('success', 'File deleted successfully');
    }
}
