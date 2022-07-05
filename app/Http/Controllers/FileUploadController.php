<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        $uploads = FileUpload::orderBy('id', 'ASC')->get();

        return view('index', compact('uploads'));
    }

    public function createUploads()
    {
        return view('create');
    }

    public function storeUploads(Request $request)
    {
        $uploads = new FileUpload();

        $uploads->author = $request->input('author');

        if ($request->hasFile('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'image',
            ])->getPublicId();

            $uploads->image = $uploadedFileUrl;
        }

        $uploads->save();
        return redirect()->route('view-upload')->with('status', 'File uploaded successfully');
    }

    public function edit($id)
    {
        $uploads = FileUpload::find($id);

        return view('edit', compact('uploads'));
    }

    public function update(Request $request, $id)
    {
        $uploads = FileUpload::find($id);

        $uploads->author = $request->input('author');

        // $publicId = $uploads->image;
        // $destination = Storage::disk('cloudinary')->fileExists($publicId);
        // dd($destination);

        $publicId = $uploads->image;
        $destination = Storage::disk('cloudinary')->exists($publicId);
        if ($request->hasFile('image')) {
            if ($destination) {
                Cloudinary::destroy($publicId);
            }
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'image',
            ])->getPublicId();

            $uploads->image = $uploadedFileUrl;
        }

        $uploads->update();
        return redirect()->route('view-upload')->with('status', 'File uploaded successfully');
    }

    public function destroy($id)
    {
        $uploads = FileUpload::find($id);

        $uploadedFileUrl = $uploads->image;
        $destination = Storage::disk('cloudinary')->exists($uploadedFileUrl);
        // dd($destination);
        if ($destination) {
            Cloudinary::destroy($uploadedFileUrl);
        }

        $uploads->delete();
        return redirect()->route('view-upload')->with('status_del', 'File deleted successfully');
    }
}
