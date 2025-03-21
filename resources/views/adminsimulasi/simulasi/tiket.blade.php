@extends('layouts.admin')
@section('title')
Tiket Peserta {{ $simulasi->judul }}
@endsection
@section('content')
<a href="{{ route('adminsimulasi.simulasi.kelola', ['id' => $simulasi->id]) }}"
    class="btn btn-default btn-space btn-icon"><i class="mdi mdi-arrow-back"></i>Kembali</a>
<div class="row">
    <div class="col-md-12">
        <div role="alert" class="alert alert-primary alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-ticket-star"></span></div>
            <div class="message">
                @if($jumlahTiket > 0)
                <strong>{{ $jumlahTiket }}</strong> Tiket sudah dicetak
                @else
                Belum ada tiket dicetak
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <button type="button" id="btnCetakTiket" class="btn btn-md btn-fill btn-primary btn-space btn-icon"
                    data-toggle="modal" data-target="#modalTambahCetakTiket"><i class="mdi mdi-plus"></i> Cetak
                    Tiket</button>
                <button type="button" id="btnKustomTiket" class="btn btn-md btn-fill btn-success btn-space btn-icon"
                    data-toggle="modal" data-target="#modalCustomTiket"><i class="mdi mdi-image"></i> Custom
                    Tiket</button>
                <a href="{{ route('adminsimulasi.simulasi.kelola.peserta', $simulasi->id) }}"
                    class="btn btn-md btn-fill btn-default btn-space btn-icon"><i class="mdi mdi-accounts-alt"></i> Data
                    Peserta ({{ $jumlahPeserta }})</a>
                <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.detail', $simulasi->id) }}"
                    class="btn btn-md btn-fill btn-default btn-space btn-icon"><i class="mdi mdi-accounts-alt"></i> Data
                    Semua Tiket ({{ $simulasi->tiket->count() }})</a>
            </div>
            <div class="col-md-4">
                <form action="{{ route('adminsimulasi.simulasi.kelola.tiket.detail', $simulasi->id) }}"
                    class="input-group input-group-sm xs-mb-15" method="GET">
                    <input type="text" class="form-control" placeholder="16 DIGIT PIN TIKET" name="pin"><span
                        class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Cari Tiket</button></span>
                </form>
            </div>
        </div>

        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Simulasi</th>
                            <th>Jumlah Tiket</th>
                            <th>Kategori</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Waktu</th>
                            <th>Simulasi</th>
                            <th>Jumlah Tiket</th>
                            <th>Kategori</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($cetakTiket as $cetak)
                        <tr>
                            <td>{{ hariTanggalWaktu($cetak->created_at) }}</td>
                            <td>{{ $cetak->simulasi->judul }}</td>
                            <td>{{ $cetak->jumlah_tiket }} tiket</td>
                            <td>{{ $cetak->kategoriTiket->nama }}</td>
                            <td>{{ $cetak->user->nama }}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <button type="button" data-toggle="dropdown"
                                        class="btn btn-xs btn-default dropdown-toggle">
                                        <i class="icon icon-left mdi mdi-print mr-3"></i> Cetak
                                        <span class="icon-dropdown mdi mdi-chevron-down"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.print', ['id' => $simulasi->id, 'idCetak' => $cetak->id]) }}"
                                                class="print" title="Cetak Tiket"
                                                data-jumlahtiket="{{ $cetak->tiket->count() }}">
                                                68/A4
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.print', ['id' => $simulasi->id, 'idCetak' => $cetak->id, 'paperSize' => 'a4_2']) }}"
                                                class="print" title="Cetak Tiket"
                                                data-jumlahtiket="{{ $cetak->tiket->count() }}">
                                                20/A4
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.print', ['id' => $simulasi->id, 'idCetak' => $cetak->id, 'paperSize' => 'a3']) }}"
                                                class="print" title="Cetak Tiket"
                                                data-jumlahtiket="{{ $cetak->tiket->count() }}">
                                                100/A3
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.detail', ['id' => $simulasi->id, 'idCetak' => $cetak->id]) }}"
                                    class="btn btn-xs btn-default" title="Detail Tiket"><i class="mdi mdi-eye"></i></a>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.tiket.delete', ['id' => $simulasi->id, 'idCetak' => $cetak->id]) }}"
                                    class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->


<!-- MODAL TAMBAH TIKET -->
<div class="modal fade" id="modalTambahCetakTiket" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-close"></i></button>
                <h4 class="modal-title" id="modalFormLabel">Tambah Cetak Tiket</h4>
            </div>
            <form class="modal-body" action="{{ route('adminsimulasi.simulasi.kelola.tiket.tambah', $simulasi->id) }}"
                method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Jumlah Tiket</label>
                            <input type="number" max="999" class="form-control input-sm" placeholder="Jumlah Tiket"
                                name="jumlah" value="{{ old('jumlah') }}" required>
                            @if ($errors->has('jumlah'))
                            <span class="help-block">
                                <strong>{{ $errors->first('jumlah') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">&nbsp;</label>
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-sm">Buat Cetak
                            Tiket</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-fill btn-md" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CUSTOM TIKET -->
<div class="modal fade" id="modalCustomTiket" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="fa fa-close"></i></button>
                <h4 class="modal-title" id="modalFormLabel">Tambah Cetak Tiket</h4>
            </div>
            <form class="modal-body" action="{{ route('adminsimulasi.simulasi.kelola.tiket.custom', $simulasi->id) }}"
                method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="featured_image">
                    <input class="inputfile" id="file-1" type="file" name="file-1"
                        data-multiple-caption="{count} files selected" multiple="" accept="image/*">
                    <label class="btn-secondary" for="file-1">
                        <i class="mdi mdi-upload"></i><span>Pilih Foto (Ukuran <strong>584x181</strong>)</span>
                    </label>
                    @if($errors->has('featured_image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('featured_image') }}</strong>
                    </span>
                    @endif
                </div>
                <div>
                    <img id="imagePreview" src="{{ $simulasi->tiket_url }}" alt="">
                </div>
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-block btn-sm mt-4">
                    Simpan Desain Tiket
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

    $("input[type=file]").click(function(){
        $(this).val("");
    });

    $("input[type=file]").change(function(){
        var file = $(this)[0].files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            $("#imagePreview").attr("src", reader.result);
            $("input[name=featured_image]").val(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    });

});

</script>
@endsection