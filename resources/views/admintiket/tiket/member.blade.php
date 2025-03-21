@extends('layouts.admin')
@section('title')
Tiket Member
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div role="alert" class="alert alert-primary alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-ticket-star"></span></div>
            <div class="message">
                <strong>{{ $jumlahTiket }}</strong> Tiket sudah dicetak
            </div>
        </div>

        <button type="button" id="btnCetakTiket" class="btn btn-md btn-fill btn-primary btn-space btn-icon" data-toggle="modal" data-target="#modalTambahCetakTiket"><i class="mdi mdi-plus"></i> Cetak Tiket</button>
        <button type="button" id="btnKustomTiket" class="btn btn-md btn-fill btn-success btn-space btn-icon" data-toggle="modal" data-target="#modalCustomTiket"><i class="mdi mdi-image"></i> Custom Tiket</button>
        <a href="{{ route('admintiket.tiket.member.data') }}" class="btn btn-md btn-fill btn-default btn-space btn-icon"><i class="mdi mdi-accounts-alt"></i> Data Member ({{ $jumlahMember }})</a>
        <a href="{{ route('admintiket.tiket.member.detail') }}" class="btn btn-md btn-fill btn-default btn-space btn-icon"><i class="mdi mdi-accounts-alt"></i> Semua Data Tiket Member</a>


        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Simulasi</th>
                            <th>Jumlah Tiket</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Waktu</th>
                            <th>Simulasi</th>
                            <th>Jumlah Tiket</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($cetakTiket as $cetak)
                        <tr>
                            <td>{{ hariTanggalWaktu($cetak->created_at) }}</td>
                            <td>{{ $cetak->id_simulasi != null ? $cetak->simulasi->judul : "-" }}</td>
                            <td>{{ $cetak->jumlah_tiket }} tiket</td>
                            <td>{{ $cetak->user->nama }}</td>
                            <td class="text-right">
                                <a href="{{ route('admintiket.tiket.member.detail', $cetak->id) }}" class="btn btn-xs btn-default" title="Detail Tiket"><i class="mdi mdi-eye"></i></a>
                                <a href="{{ route('admintiket.tiket.member.print', $cetak->id) }}" class="btn btn-xs btn-default print" title="Cetak Tiket" data-jumlahtiket="{{ $cetak->tiket->count() }}"><i class="mdi mdi-print"></i></a>
                                <a href="{{ route('admintiket.tiket.member.delete', $cetak->id) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="modalTambahCetakTiket" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                <h4 class="modal-title" id="modalFormLabel">Tambah Cetak Tiket</h4>
            </div>
            <form class="modal-body" action="{{ route('admintiket.tiket.member.tambah') }}" method="post">
                @csrf
                <label for="">Masukan jumlah tiket yang ingin dicetak</label>
                <div class="form-group">
                    <input type="number" max="999" class="form-control" placeholder="Jumlah Tiket" name="jumlah" value="{{ old('jumlah') }}" required>
                    @if ($errors->has('jumlah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('jumlah') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-sm">Cetak Tiket Member</button>
            </form>
            <hr>
            <form class="modal-body" action="{{ route('admintiket.tiket.member.importcsv') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="">Import Dari File CSV</label>
                <div class="form-group">
                    <input type="file" max="999" class="form-control" placeholder="Import File CSV" name="file" accept="application/msexcel" value="{{ old('filecsv') }}" required>
                    @if ($errors->has('filecsv'))
                    <span class="help-block">
                        <strong>{{ $errors->first('filecsv') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-sm">Import Tiket Member</button>
            </form>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-fill btn-md" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#datatables');

    $(document).on("click", ".print", function(e) {
        var link = $(this).attr("href");
        var jum  = $(this).data("jumlahtiket");
        e.preventDefault();
        swal({
            title: "Ingin Cetak " + jum + " Tiket?",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn btn-danger btn-fill",
            confirmButtonText: "Ya",
            cancelButtonClass: "btn btn-danger btn-fill",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.value) {
                document.location.href = link;
            }
        });
    });

    @if(!$errors->isEmpty())
    $('#modalForm').modal('show')
    @endif

});

</script>
@endsection
