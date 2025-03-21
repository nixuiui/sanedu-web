@extends('layouts.admin')
@section('title')
Grup Chat
@endsection
@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola.grupchat.tambah', $simulasi->id) }}" class="btn btn-md btn-primary btn-space btn-icon"> <i class="mdi mdi-plus"></i> Tambah Grup Chat</a>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                WhatsApp
            </div>
            <div class="panel-body">
                <table id="datatables" class="table table-striped datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Grup</th>
                            <th>Member</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Grup</th>
                            <th>Member</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($grub as $no => $w)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>
                                {{ $w->nama }} <br>
                                <small><span class="text-muted">{{ hariTanggalWaktu($w->created_at) }}</span></small>
                            </td>
                            <td>{{ $w->jumlah_member }} Member</td>
                            <td class="text-right">
                                <a href="{{ route('adminsimulasi.simulasi.kelola.grupchat.view', ['id' => $simulasi->id, 'idGrup' => $w->id]) }}" class="btn btn-xs btn-primary print" title="Cetak Tiket"><i class="mdi mdi-open-in-new"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.grupchat.edit', ['id' => $simulasi->id, 'idGrup' => $w->id]) }}" class="btn btn-xs btn-default print" title="Cetak Tiket"><i class="mdi mdi-edit"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.grupchat.delete', ['id' => $simulasi->id, 'idGrup' => $w->id]) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection
