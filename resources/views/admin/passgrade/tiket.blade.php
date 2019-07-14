@extends('layouts.adminnopadding')

@section('title')
Voucher Passing Grade
@endsection

@section('navigation')
@include('admin.passgrade.menu')
@endsection

@section('content')
<div class="email-inbox-header">
    <div class="row">
        <div class="col-md-12">
            <div class="email-title">
                <span class="icon mdi mdi-ticket-star mr-3"></span> Voucher Passing Grade
            </div>
        </div>
    </div>
</div>
<div class="panel no-border no-radius mb-0">
    <div class="panel-body">
        @include('partials.admin.helpers.alert')
        <div class="row">
            <div class="col-md-6">
                @if($jumlahVoucher > 0)
                <strong>{{ $jumlahVoucher }}</strong> Tiket sudah dicetak
                @else
                Belum ada tiket dicetak
                @endif
            </div>
            <div class="col-md-6 text-right">
                <button type="button" id="btnCetakTiket"
                    class="btn btn-md btn-rounded btn-fill btn-primary btn-space btn-icon" data-toggle="modal"
                    data-target="#modalTambahCetakTiket"><i class="mdi mdi-plus"></i> Cetak Tiket</button>
                <button type="button" id="btnKustomTiket"
                    class="btn btn-md btn-rounded btn-fill btn-success btn-space btn-icon" data-toggle="modal"
                    data-target="#modalCustomTiket"><i class="mdi mdi-image"></i> Custom Tiket</button>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default panel-table table-responsive no-border mb-0">
    <div class="panel-body">
        <table id="datatables" class="table table-striped">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Harga</th>
                    <th>Jumlah Voucher</th>
                    <th>Dibuat Oleh</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Waktu</th>
                    <th>Harga</th>
                    <th>Jumlah Voucher</th>
                    <th>Dibuat Oleh</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($cetak as $data)
                <tr>
                    <td>{{ hariTanggalWaktu($data->created_at) }}</td>
                    <td>{{ formatUang($data->harga) }}</td>
                    <td>{{ $data->jumlah_voucher }} voucher</td>
                    <td>{{ $data->user->nama }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.passgrade.tiket.detail', ['idCetak' => $data->id]) }}"
                            class="btn btn-xs btn-default" title="Detail Voucher"><i class="mdi mdi-eye"></i></a>
                        <a href="{{ route('admin.passgrade.tiket.print', ['idCetak' => $data->id]) }}"
                            class="btn btn-xs btn-default print" title="Cetak Voucher"
                            data-jumlahtiket="{{ $data->vouchers->count() }}">A4</a>
                        <a href="{{ route('admin.passgrade.tiket.print', ['idCetak' => $data->id, 'paperSize' => 'a3']) }}"
                            class="btn btn-xs btn-default print" title="Cetak Voucher"
                            data-jumlahtiket="{{ $data->vouchers->count() }}">A3</a>
                        <a href="{{ route('admin.passgrade.tiket.delete', ['idCetak' => $data->id]) }}"
                            class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahCetakTiket" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-close"></i></button>
                <h4 class="modal-title" id="modalFormLabel">Tambah Cetak Tiket</h4>
            </div>
            <form class="modal-body" action="{{ route('admin.passgrade.tiket.tambah') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Jumlah Voucher</label>
                    <input type="number" max="999" class="form-control input-sm" placeholder="Jumlah Tiket"
                    name="jumlah" value="{{ old('jumlah') }}" required>
                    @if ($errors->has('jumlah'))
                    <span class="help-block">
                        <strong>{{ $errors->first('jumlah') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <select name="harga" class="form-control input-sm">
                        <option value="2000">2000</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="20000">20000</option>
                        <option value="50000">50000</option>
                    </select>
                </div>
                <label for="">&nbsp;</label>
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-sm">Buat Cetak
                    Tiket
                </button>
            </form>
            <hr>
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