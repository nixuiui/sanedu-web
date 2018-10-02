@extends('layouts.admin')

@section('title')
Simulasi - {{ $simulasi->judul }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Agenda
            </div>
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
<<<<<<< HEAD
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
=======
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
>>>>>>> bf3a318d076c15c867df6b170f094abcdedac617
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
</div>
@endsection
