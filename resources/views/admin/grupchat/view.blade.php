@extends('layouts.admin')
@section('title')
Grup Chat
@endsection
@section('content')
<a href="{{ route('admin.grupchat') }}" class="btn btn-md btn-default btn-space btn-icon"> <i class="mdi mdi-arrow-left"></i> Kembali</a>
<a href="{{ $grup->link }}" target="_blank" class="btn btn-md btn-primary btn-space btn-icon"> <i class="mdi mdi-open-in-new"></i> Link Grup Chat</a>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Member {{ $grup->nama }}
            </div>
            <div class="panel-body">
                <table id="datatables" class="table table-striped datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Member</th>
                            <th>Nomor Telp</th>
                            <th>Sekolah</th>
                            <th>Tanggal Bergabung</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Member</th>
                            <th>Sekolah</th>
                            <th>Tanggal Bergabung</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($member as $no => $w)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $w->user->nama }}</td>
                            <td>{{ $w->user->no_hp }}</td>
                            <td>{{ $w->user->id_sekolah != null ? $w->user->sekolah->nama : "" }}</td>
                            <td>{{ hariTanggalWaktu($w->created_at) }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.grupchat.member.kick', $w->id) }}" class="btn btn-xs btn-danger delete btn-icon"><i class="mdi mdi-delete"></i> keluarkan dari grub</a>
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
