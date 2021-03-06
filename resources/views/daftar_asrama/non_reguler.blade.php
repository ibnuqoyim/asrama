@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Daftar Penghuni Non Reguler</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('daftar_non_reguler') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="asrama" class="col-md-3 control-label">Asrama</label>
                            <div class="col-md-9">
                                <select id="asrama" class="form-control" name="asrama" required>
                                    <option></option>
                                    @foreach ($list_asrama as $asrama)
                                        <option>{{ $asrama->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk" class="col-md-3 control-label">Tanggal Masuk</label>
                            <div class="col-md-3" style="width:28%">
                                <input id="tanggal_masuk" type="date" class="form-control" name="tanggal_masuk" required>
                            </div>

                            <label for="tanggal_keluar" class="col-md-3 control-label" style="width:19%">Tanggal Keluar</label>
                            <div class="col-md-3" style="width:28%">
                                <input id="tanggal_keluar" type="date" class="form-control" name="tanggal_keluar" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-5">
                                <a class="btn btn-default" href="{{ url('/dashboard') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                <button type="submit" class="btn btn-primary">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
