<?php

namespace App\Http\Controllers\Api;

//import model sekolah
use App\Models\Sekolah;

use App\Http\Controllers\Controller;
//import resource sekolahResource
use App\Http\Resources\SekolahResource;

//import resources sekolahesource
use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{    
    public function index()
    {
        //get all posts
        $sekolahs = Sekolah::latest()->paginate(5);

        //return collection of posts as a resource
        return new SekolahResource(true, 'List Data Pasien', $sekolahs);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kode_unik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $sekolahs = Sekolah::create([
            'nama'     => $request->nama,
            'kode_unik'     => $request->kode_unik,
            'alamat'   => $request->alamat,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'email'   => $request->email,
        ]);

        //return response
        return new SekolahResource(true, 'Data Siswa Berhasil Ditambahkan!', $sekolahs);
    }

    public function show($id)
    {
        //find post by ID
        $sekolahs = Sekolah::find($id);

        //return single post as a resource
        return new SekolahResource(true, 'Detail Data Siswa!', $sekolahs);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kode_unik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $sekolahs = Sekolah::find($id);

            //update post with new image
            $sekolahs->update([
                'nama'     => $request->nama,
                'kode_unik'     => $request->kode_unik,
                'alamat'   => $request->alamat,
                'jenis_kelamin'   => $request->jenis_kelamin,
                'email'   => $request->email,
            ]);

        //return response
        return new SekolahResource(true, 'Data Siswa Berhasil Diubah!', $sekolahs);
    }

    public function destroy($id)
    {

        //find post by ID
        $sekolahs = Sekolah::find($id);

        //delete image
        Storage::delete('public/posts/'.basename($sekolahs->nama));

        //delete post
        $sekolahs->delete();

        //return response
        return new SekolahResource(true, 'Data Siswa Berhasil Dihapus!', null);
    }
}