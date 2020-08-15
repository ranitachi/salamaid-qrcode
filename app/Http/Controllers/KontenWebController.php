<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\KontenWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KontenWebController extends Controller
{
    public function index(){
        $konten = KontenWeb::orderBy('created_at','desc')->paginate(10);
        return view('konten.index',compact('konten'));
    }

    public function create()
    {
        return view('konten.create');
    }
    
    public function edit($id)
    {
        $konten = KontenWeb::find($id);
        return view('konten.edit',compact('id','konten'));
    }

    public function store(Request $request)
    {
        // return ($request->all());
        try{
            DB::beginTransaction();
            $file = null;
            if($request->has('file'))
            {
                $get = $request->file;
                $name = time().'.'.$get->getClientOriginalExtension();
                $filename = $get->storeAs('konten',$name);
            }

            $konten = new KontenWeb;
            $konten->judul = $request->judul;
            $konten->tanggal = date('Y-m-d');
            $konten->konten = $request->summernote;
            $konten->file = $filename;
            $konten->status = $request->status;
            $konten->save();
            DB::commit();

            Session::flash('message','Data Berhasil Disimpan');
            Session::flash('type','success');
            return redirect()->route('konten.index');
        }
        catch(Exception $e)
        {
            DB::rollback();

            Session::flash('message','Data Gagal Di Simpan');
            Session::flash('type','danger');
            return redirect()->route('konten.index');
        }
        
    }
    public function update(Request $request,$id)
    {
        // return ($request->all());
        try{
            DB::beginTransaction();
            $file = null;
            

            $konten = KontenWeb::find($id);
            $konten->judul = $request->judul;
            $konten->tanggal = date('Y-m-d');
            $konten->konten = $request->summernote;
            if($request->has('file'))
            {
                $get = $request->file;
                $name = time().'.'.$get->getClientOriginalExtension();
                $filename = $get->storeAs('konten',$name);
                $konten->file = $filename;
            }
            $konten->status = $request->status;
            $konten->save();
            DB::commit();

            Session::flash('message','Update Data Berhasil Disimpan');
            Session::flash('type','success');
            return redirect()->route('konten.index');
        }
        catch(Exception $e)
        {
            DB::rollback();

            Session::flash('message','Update Data Gagal Di Simpan');
            Session::flash('type','danger');
            return redirect()->route('konten.index');
        }
        
    }

    public function destroy($id)
    {
        // return ($request->all());
        try{
            DB::beginTransaction();
            
            $konten = KontenWeb::find($id);
            $konten->delete();
            DB::commit();

            Session::flash('message','Hapus Data Berhasil Disimpan');
            Session::flash('type','success');
            return redirect()->route('konten.index');
        }
        catch(Exception $e)
        {
            DB::rollback();

            Session::flash('message','Hapus Data Gagal Di Simpan');
            Session::flash('type','danger');
            return redirect()->route('konten.index');
        }
        
    }
}
