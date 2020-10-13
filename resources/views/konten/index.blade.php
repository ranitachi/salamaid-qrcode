@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Konten</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <a href="{{ route('konten.create') }}" class="btn btn-md btn-info pull-right" style="float:right;margin-bottom:5px;color:white"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                        </div>
                        @if (Session::has('message'))
                            <div class="col-md-12">
                                <div class="alert alert-{{ Session::get('type') }}">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <strong>{{ Session::get('message') }}</strong>.
                                </div>
                            </div>
                        @endif
                    </div>
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                if($page==1)
                                    $hal = 1;
                                else
                                    $hal =  10 * $page - 9;
                            @endphp
                            @foreach ($konten as $no => $item)
                                <tr>
                                    <td class="text-center">{{ $hal }}</td>
                                    <td class="text-left">{{ $item->judul }}</td>
                                    <td class="text-left">{{ date('d F Y',strtotime($item->created_at)) }}</td>
                                    <td class="text-center">
                                        @if ($item->status==0)
                                            <span class="label label-danger">Tidak Aktif</span>
                                        @else
                                            <span class="label label-success">Aktif</span>    
                                        @endif    
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('konten.edit',$item->id) }}" class="btn btn-xs btn-info">Edit</a>
                                        <a href="javascript:hapus({{ $item->id }})" class="btn btn-xs btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @php
                                    $hal++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $konten->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="delete-form" method="post">
    @csrf
    @method('DELETE')
</form>
@endsection
@section('footscript')
    <script>
        function hapus(id)
        {
            var c = confirm('Apakah Yakin Ingin di Hapus ?');
            if(c)
            {
                $('#delete-form').attr('action','{{ url("/") }}/konten/'+id);
                $('#delete-form').submit();
            }
        }
    </script>
@endsection