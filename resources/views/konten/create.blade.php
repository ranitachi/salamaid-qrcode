@extends('layouts.app')

@section('link')
  
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Konten</div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('konten.index') }}" class="btn btn-md btn-info pull-right" style="float:right;margin-bottom:5px;color:white">Kembali</a>
                        </div>
                        <div class="col-md-12">

                            <form method="POST" action="{{ route('konten.store') }}" enctype="multipart/form-data">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label text-md-right">Judul</label>
        
                                    <div class="col-md-9">
                                        <input id="judul" type="judul" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required>
        
                                        @error('judul')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label text-md-right">Konten</label>
        
                                    <div class="col-md-9">
                                        <textarea name="summernote" id="summernote" class="summernote"></textarea>
                                        <input type="hidden" name="konten" id="konten">
                                        @error('konten')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label text-md-right">File Gambar (png,jpg)</label>
        
                                    <div class="col-md-9">
                                        <input id="" type="file" class="form-control @error('file') is-invalid @enderror" name="file" accept=".jpg,.png,.jpeg">
        
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label text-md-right">Aktif</label>
        
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" required>
                                            <option value="">-Pilih-</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
        
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button>
        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footscript')
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    //   $(document).ready(function() {
            $('#summernote').summernote({
                height: 350,
            });
        // });
    </script>
@endsection