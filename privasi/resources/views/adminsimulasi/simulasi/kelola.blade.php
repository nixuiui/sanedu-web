@extends('layouts.admin')

@section('title')
Kelola Simulasi
@endsection

@section('content')
<div class="alert alert-{{ $simulasi->is_published ? "success" : "primary" }} alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon"><span class="mdi mdi-mail-send"></span></div>
    <div class="message">
        @if(!$simulasi->is_published)
        <a href="{{ route('adminsimulasi.simulasi.kelola.publish', $simulasi->id) }}" class="btn btn-primary btn-md">Publish Sekarang</a>
        @else

            @if( $simulasi->peserta->count() > 0)
            <p>Jumlah peserta yang mendaftar pada simulasi ini adalah <strong>{{ $simulasi->peserta->count() }} peserta</strong>, <strong><a href="{{ route('adminsimulasi.simulasi.kelola.peserta', $simulasi->id) }}">Lihat peserta</a></strong></p>
            @else
            <p class="">Belum ada peserta yang mendaftar pada simulasi ini.</p>
            @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="panel panel-default" action="{{ route('adminsimulasi.simulasi.edit.post', $simulasi->id) }}" method="post">
            <div class="panel-heading">Informasi Simulasi</div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tingkat Sekolah</label>
                                    <input type="text" class="form-control input-sm" value="{{ $simulasi->tingkatSekolah->nama }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Judul Ujian Simulasi</label>
                                    <input type="text" class="form-control input-sm" placeholder="Ujian Nasional SMA Matematika" name="judul"  value="{{ $simulasi->judul }}" required>
                                    @if($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Instansi Penyelenggara</label>
                                    <input type="text" class="form-control input-sm" placeholder="Study & Fun" name="instansi"  value="{{ $simulasi->instansi }}" required>
                                    @if($errors->has('instansi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instansi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" class="form-control input-sm" placeholder="1000" name="harga"  value="{{ $simulasi->harga }}" required>
                                    @if($errors->has('harga'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harga') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tempat Pelaksanaan</label>
                                    <input type="text" class="form-control input-sm" placeholder="Unila" name="tempat_pelaksanaan"  value="{{ $simulasi->tempat_pelaksanaan }}">
                                    @if($errors->has('tempat_pelaksanaan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tempat_pelaksanaan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Pelaksanaan</label>
                                    <input type="date" class="form-control input-sm" placeholder="60" name="tanggal_pelaksanaan"  value="{{ $simulasi->tanggal_pelaksanaan }}" required>
                                    @if($errors->has('tanggal_pelaksanaan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_pelaksanaan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pilih cogambar untuk dijadikan cover</label> <br>
                            <input type="hidden" name="featured_image">
                            <input class="inputfile" id="file-1" type="file" name="file-1" data-multiple-caption="{count} files selected" multiple="" accept="image/*">
                            <label class="btn-secondary" for="file-1"> <i class="mdi mdi-upload"></i><span>Pilih Foto...</span></label>
                            @if($errors->has('kategori'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kategori') }}</strong>
                            </span>
                            @endif
                        </div>
                        @if($simulasi->featured_image != null)
                        <img id="imagePreview" class="img-fluid" width="200px" src="{{ $simulasi->image_url }}">
                        @else
                        <img id="imagePreview" class="img-fluid" width="200px">
                        @endif
                    </div>
                </div>
                <button type="submit"  class="btn btn-primary btn-fill btn-md btn-icon"><i class="mdi mdi-check"></i>Simpan Perubahan</button>
            </div>
        </form>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('adminsimulasi.simulasi.kelola.agenda.form', $simulasi->id) }}" class="btn btn-default btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Kegiatan</a>
                <div class="panel panel-default panel-table">
                    <div class="panel-body">
                        <table id="datatables" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Agenda</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($simulasi->agenda->count() > 0)
                                @foreach($simulasi->agenda as $agenda)
                                <tr>
                                    <td>
                                        {{ hariTanggal($agenda->waktu) }}<br>
                                        {{ jamMenitA($agenda->waktu) }}
                                    </td>
                                    <td>
                                        <strong>{{ $agenda->nama_agenda }}</strong> <br>
                                        {{ $agenda->deskripsi }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.agenda.form', ['id' => $simulasi->id, 'idAgenda' => $agenda->id]) }}" class="btn btn-xs btn-success" title="Edit Agenda"><i class="mdi mdi-edit"></i></a>
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.agenda.delete', ['id' => $simulasi->id, 'idAgenda' => $agenda->id]) }}" class="btn btn-xs btn-danger delete" title="Hapus Agenda"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="data-is-empty">Belum ada agenda yang dibuat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id) }}" class="btn btn-default btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Ruangan</a>
                <div class="panel panel-default panel-table">
                    <div class="panel-body">
                        <table id="datatables" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ruang</th>
                                    <th>Kursi</th>
                                    <th>Alamat</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($simulasi->ruang->count() > 0)
                                @foreach($simulasi->ruang as $ruang)
                                <tr>
                                    <td>
                                        <strong>{{ $ruang->nama_ruang }}</strong> <br>
                                    </td>
                                    <td><i class="mdi mdi-accounts-alt mr-2"></i>{{ $ruang->kapasitas }} Orang</td>
                                    <td>{{ $ruang->alamat }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', ['id' => $simulasi->id, 'idRuang' => $ruang->id]) }}" class="btn btn-xs btn-default" title="Edit Agenda"><i class="mdi mdi-arrow-right"></i></a>
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', ['id' => $simulasi->id, 'idRuang' => $ruang->id]) }}" class="btn btn-xs btn-success" title="Edit Agenda"><i class="mdi mdi-edit"></i></a>
                                        <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.delete', ['id' => $simulasi->id, 'idRuang' => $ruang->id]) }}" class="btn btn-xs btn-danger delete" title="Hapus Agenda"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="data-is-empty">Belum ada ruangan yang dibuat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
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
