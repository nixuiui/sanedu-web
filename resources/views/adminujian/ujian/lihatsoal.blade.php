@extends('layouts.admin')

@section('title')
Soal Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table class="table table-bordered">
                        <tr>
                            <td colspan="3"><strong>SOAL</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">{!! $soal->soal !!}</td>
                        </tr>
                        <tr>
                            <td colspan="3"> <strong>JAWABAN</strong> </td>
                        </tr>
                        <tr>
                            <td width="50px" class="text-valign-center">{!! $soal->jawaban == 'a' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td width="50px" class="text-valign-center">A</td>
                            <td style="padding: 15px;">{!! $soal->a !!}</td>
                        </tr>
                        <tr>
                            <td width="50px" class="text-valign-center">{!! $soal->jawaban == 'b' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td width="50px" class="text-valign-center">B</td>
                            <td style="padding: 15px;">{!! $soal->b !!}</td>
                        </tr>
                        <tr>
                            <td width="50px" class="text-valign-center">{!! $soal->jawaban == 'c' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td width="50px" class="text-valign-center">C</td>
                            <td style="padding: 15px;">{!! $soal->c !!}</td>
                        </tr>
                        <tr>
                            <td width="50px" class="text-valign-center">{!! $soal->jawaban == 'd' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td width="50px" class="text-valign-center">D</td>
                            <td style="padding: 15px;">{!! $soal->d !!}</td>
                        </tr>
                        <tr>
                            <td width="50px" class="text-valign-center">{!! $soal->jawaban == 'e' ? "<i class='mdi mdi-check-circle text-success'></i>" : "" !!}</td>
                            <td width="50px" class="text-valign-center">E</td>
                            <td style="padding: 15px;">{!! $soal->e !!}</td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->
@endsection

@section('script')
@endsection
