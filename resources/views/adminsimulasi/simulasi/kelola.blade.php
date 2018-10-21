@extends('layouts.admin')

@section('title')
Kelola Simulasi
@endsection

@section('content')
<div class="alert alert-primary alert-icon alert-icon-border alert-dismissible" role="alert">
    <div class="icon"><span class="mdi mdi-mail-send"></span></div>
    <div class="message">
        @if($simulasi->id_status == 1901)
        <a href="{{ route('adminsimulasi.simulasi.kelola.publish', $simulasi->id) }}" class="btn btn-primary btn-md">Publish Sekarang</a>
        @elseif($simulasi->id_status == 1902 || $simulasi->id_status == 1903)
        @if( $simulasi->peserta->count() > 0)
        <p>Jumlah peserta yang mendaftar pada simulasi ini adalah <strong>{{ $simulasi->peserta->count() }} peserta</strong>, <strong><a href="{{ route('adminsimulasi.simulasi.kelola.peserta', $simulasi->id) }}">Lihat peserta</a></strong></p>
        @else
        <p class="">Belum ada peserta yang mendaftar pada simulasi ini.</p>
        @endif
        <hr>
        @if($simulasi->id_status == 1902)
        <a href="{{ route('adminsimulasi.simulasi.kelola.closereg', $simulasi->id) }}" class="btn btn-default btn-md">Tutup Pendaftaran</a>
        @else
        <span class="text-muted">PENDAFTARAN TELAH DITUTUP</span>
        @endif
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <a href="#" class="btn btn-sm btn-default btn-space disabled"><i class="mdi mdi-eye mr-3"></i>Lihat Hasil Sementara</a>
        <a href="#" class="btn btn-sm btn-default btn-space disabled"><i class="mdi mdi-assignment-check mr-3"></i>Tentukan Kriteria Soal</a>
        <a href="#" class="btn btn-sm btn-default btn-space disabled"><i class="mdi mdi-download mr-3"></i>Download Hasil Sementara</a>
        <a href="#" class="btn btn-sm btn-default btn-space disabled"><i class="mdi mdi-download mr-3"></i>Download Hasil Akhir</a>
        <a href="#" class="btn btn-sm btn-default btn-space disabled"><i class="mdi mdi-download mr-3"></i>Download Borang Rekomendasi</a>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Pengumuman</label>
                                    <input type="date" class="form-control input-sm" placeholder="60" name="tanggal_pengumuman"  value="{{ $simulasi->tanggal_pengumuman }}" required>
                                    @if($errors->has('tanggal_pengumuman'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal_pengumuman') }}</strong>
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
                                    <label>Link Soal</label>
                                    <input type="url" class="form-control input-sm" placeholder="http://domain.com/download_soal" name="link_soal"  value="{{ $simulasi->link_soal }}">
                                    @if($errors->has('link_soal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_soal') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Link Pembahasan</label>
                                    <input type="url" class="form-control input-sm" placeholder="http://domain.com/download_pembahasan" name="link_pembahasan"  value="{{ $simulasi->link_pembahasan }}">
                                    @if($errors->has('link_pembahasan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_pembahasan') }}</strong>
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
                    <div class="panel-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="4" class="text-center">KEGIATAN</th>
                                </tr>
                                <tr>
                                    <th>Waktu & Tempat</th>
                                    <th>Tempat</th>
                                    <th>Agenda</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($simulasi->agenda->count() > 0)
                                @foreach($simulasi->agenda as $agenda)
                                <tr>
                                    <td>{{ jamMenit($agenda->waktu_mulai) }} - {{ jamMenit($agenda->waktu_selesai) }}</td>
                                    <td>{{ $agenda->tempat }}</td>
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
                <div class="panel panel-default panel-table">
                    <div class="panel-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">KUOTA</th>
                                </tr>
                                <tr>
                                    <th>SAINTEK</th>
                                    <th>SOSHUM</th>
                                    <th>CAMPUR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $simulasi->ruang->where('id_mapel', 1516)->sum('jumlah_peserta') }}/{{ $simulasi->ruang->where('id_mapel', 1516)->sum('kapasitas') }} TIKET</td>
                                    <td>{{ $simulasi->ruang->where('id_mapel', 1517)->sum('jumlah_peserta') }}/{{ $simulasi->ruang->where('id_mapel', 1517)->sum('kapasitas') }} TIKET</td>
                                    <td>{{ $simulasi->ruang->where('id_mapel', 1518)->sum('jumlah_peserta') }}/{{ $simulasi->ruang->where('id_mapel', 1518)->sum('kapasitas') }} TIKET</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', $simulasi->id) }}" class="btn btn-default btn-md btn-icon btn-space"><i class="mdi mdi-plus"></i>Tambah Ruangan</a>
                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang', $simulasi->id) }}" class="btn btn-default btn-md btn-vspace pull-right">Lihat Semua<i class="mdi mdi-arrow-right ml-3"></i></a>
                <div class="panel panel-default panel-table">
                    <div class="panel-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="6" class="text-center">RUANG</th>
                                </tr>
                                <tr>
                                    <th>Ruang</th>
                                    <th>Mapel</th>
                                    <th>Kuota</th>
                                    <th>Pengawas</th>
                                    <th>Alamat</th>
                                    <th class="text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($simulasi->ruang->count() > 0)
                                    @foreach($ruang as $index => $data)
                                        @if($index >= 5)
                                            <tr>
                                                <td colspan="6" class="text-center text-bold"><a href="{{ route('adminsimulasi.simulasi.kelola.ruang', $simulasi->id) }}">Lihat Semua Ruang</a></td>
                                            </tr>
                                            @break
                                        @else
                                        <tr>
                                            <td><a href="{{ route('adminsimulasi.simulasi.kelola.ruang', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}"><strong>{{ $data->nama }}</strong></a></td>
                                            <td>{{ $data->ruangMapel->nama }}</td>
                                            <td><i class="mdi mdi-accounts-alt mr-2"></i>{{ $data->jumlah_peserta }}/{{ $data->kapasitas }} Orang</td>
                                            <td>{{ $data->pengawas->count() }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.form', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}" class="btn btn-xs btn-success" title="Edit Agenda"><i class="mdi mdi-edit"></i></a>
                                                <a href="{{ route('adminsimulasi.simulasi.kelola.ruang.delete', ['id' => $simulasi->id, 'idRuang' => $data->id]) }}" class="btn btn-xs btn-danger delete" title="Hapus Agenda"><i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="data-is-empty">Belum ada ruangan yang dibuat</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="data-card">
                                <i class="mdi mdi-assignment mb-3"></i>
                                <p>{{ $simulasi->kunciJawaban->count() <= 0 ? "KUNCI JAWABAN & SOAL BELUM DIBUAT" : "KELOLA KUNCI JAWABAN & SOAL" }}</p>
                                <a href="{{ route('adminsimulasi.simulasi.kelola.kunci.jawaban', $simulasi->id) }}" class="btn btn-md {{ $simulasi->kunciJawaban->count() <= 0 ? 'btn-warning' : 'btn-default' }}">{{ $simulasi->kunciJawaban->count() <= 0 ? "BUAT KUNCI JAWABAN" : "UBAH KUNCI JAWABAN" }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="data-card">
                                <i class="mdi mdi-account-box mb-3"></i>
                                <p>{{ $simulasi->pengawas->count() <= 0 ? "BELUM ADA PENGAWAS" : "SUDAH ADA " . $simulasi->pengawas->count() . " PENGAWAS" }}</p>
                                @if($simulasi->pengawas->count() <= 0)
                                <a href="{{ route('adminsimulasi.simulasi.kelola.pengawas.form', $simulasi->id) }}" class="btn btn-md btn-warning">TAMBAH PENGAWAS</a>
                                @else
                                <a href="{{ route('adminsimulasi.simulasi.kelola.pengawas', $simulasi->id) }}" class="btn btn-md btn-default">KELOLA PENGAWAS</a>
                                @endif
                            </div>
                        </div>
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
