@extends('layouts.admin')
@section('title')
Penempatan Peserta Simulasi
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('adminsimulasi.simulasi.tambah') }}" class="btn btn-md btn-fill btn-primary btn-space btn-icon"><i class="mdi mdi-plus"></i> Buat Simulasi Baru</a>

        <div class="panel panel-default panel-table">
            <div class="panel-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Ruang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>adsdas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

@endsection

@section('script')
@endsection
