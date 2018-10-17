@extends('layouts.admin')
@section('title')
Kelola Pengguna
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <button type="button" id="btnTambah" class="btn btn-md btn-fill btn-primary btn-space btn-icon" data-toggle="modal" data-target="#modalForm"><i class="mdi mdi-plus"></i> Tambah User</button>
                <a href="" class="btn btn-md btn-success btn-fill btn-space btn-icon"><i class="mdi mdi-download"></i> Export Excel</a>
            </div>
            <div class="col-md-6 pull-right text-right">
                <form action="{{ route('superadmin.user') }}" method="get">
                    <div class="row">
                        <div class="col-md-2 pull-right text-right">
                            <button type="submit" class="btn btn-block btn-md btn-primary btn-fill btn-md">Filter</button>
                        </div>
                        <div class="col-mdcol-md-8 pull-right text-right">
                            <select class="form-control input-xs" name="role">
                                <option value="">Semua Role</option>
                                @foreach($roles as $role)
                                @if(isset($_GET['role']))
                                <option value="{{ $role->id }}" {{ $_GET['role'] == $role->id ? "selected" : ""}}>{{ $role->nama }}</option>
                                @else
                                <option value="{{ $role->id }}">{{ $role->nama }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                Pengguna
                <div class="tools dropdown">
                    <a href="#" type="button" data-toggle="dropdown" class="dropdown-toggle"><span class="icon mdi mdi-more-vert"></span></a>
                    <ul role="menu" class="dropdown-menu pull-right">
                        <li><a href="{{ count($_GET) > 0 ? route('superadmin.user.export') . "?" . $_SERVER['QUERY_STRING'] : route('superadmin.user.export') }}"><i class="mdi mdi-download"></i> Ekspor ke Excel</a></li>
                        <li><a id="btnTambah" href="#" class="" data-toggle="modal" data-target="#modalForm"><i class="mdi mdi-plus"></i> Tambah User</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <table id="datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>PIN</th>
                            <th>KAP</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $data)
                        <tr>
                            <td class="user-avatar">
                                <img src="{{ srcPhotoProfil($data->foto) }}">
                                {{ $data->nama }}
                            </td>
                            <td>{{ $data->pin }}</td>
                            <td>{{ $data->kap }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->role->nama }}</td>
                            <td class="text-right">
                                <button type="button" href="#" class="btn btn-xs btn-default edit" title="Ubah User" data-id="{{ $data->id }}" data-toggle="modal" data-target="#modalForm"><i class="mdi mdi-edit"></i></button>
                                <a href="{{ route('superadmin.user.hapus', ['idUser' => $data->id]) }}" class="btn btn-xs btn-danger delete"><i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content" id="formTambah" action="{{ route('superadmin.user.tambah.post') }}" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                <h4 class="modal-title" id="modalFormLabel">Tambah User</h4>
            </div>
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Role</span>
                            <select class="form-control" name="role" id="inputRole">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role') ==  $role->id ? 'selected' : '' }}>{{ $role->nama }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role'))
                            <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Nama Lengkap</span>
                            <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" id="inputName" value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Email</span>
                            <input type="email" class="form-control" placeholder="email" name="email" id="inputEmail" value="{{ old('email') }}">
                            @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Username</span>
                            <input type="text" class="form-control" placeholder="Username" name="username" id="inputUsername" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Password</span>
                            <input type="password" class="form-control" placeholder="password" name="password" id="inputPassword">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Ulangi Password</span>
                            <input type="password" class="form-control" placeholder="Ulangi Password" name="password_confirmation" id="inputPasswordConfirmation">
                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-fill btn-sm">Tambah User</button>
                <button type="submit" class="btn btn-danger btn-fill btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#datatables');
    // Edit record
    $(document).on("click", ".edit", function(e) {
        var id = $(this).data('id');
        var url = "{{ route('superadmin.user.get', ['idUser' => ':id']) }}";
        url     = url.replace(':id', id);
        var urlEdit     = "{{ route('superadmin.user.ubah.post', ['idUser' => ':id']) }}";
        $.ajax({
            type: 'get',
            url: url,
            data: {
            },
            success: function(data) {
                var json = jQuery.parseJSON(data);
                console.log(data);
                if(json.success) {
                    urlEdit = urlEdit.replace(':id', json.data.id);
                    $("#formTambah").attr('action', urlEdit);
                    $("#inputRole").val(json.data.id_role);
                    $("#inputName").val(json.data.nama);
                    $("#inputEmail").val(json.data.email);
                    $("#inputUsername").val(json.data.username);
                    $("#btnSubmit").html("Ubah");
                }
                else {
                    elUniv.html("");
                    elUniv.append("<option>Belum Ada Kelurahan</option>");
                }
            },
        });
    });

    $(document).on("click", "#btnTambah", function(e) {
        var urlTambah   = "{{ route('superadmin.user.tambah.post') }}";
        $("#formTambah").attr('action', urlTambah);
        $("#inputRole").val("");
        $("#inputName").val("");
        $("#inputEmail").val("");
        $("#inputUsername").val("");
        $("#inputPasswordConfirmation").val("");
        $("#inputPassword").val("");
        $("#btnSubmit").html("Tambah");
        $(".help-block").remove();
    });

    @if(!$errors->isEmpty())
    $('#modalForm').modal('show')
    @endif

});

</script>
@endsection
