<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use DB;
use App\Http\Controllers\Controller;

use App\Models\SetPustaka;
use App\Models\User;
use App\Models\Ujian;
use App\Models\Soal;
use App\Models\PembelianUjian;
use App\Models\Universitas;
use App\Models\PilihanPassingGrade;
use App\Models\Attempt;
use App\Models\AttemptCorrection;

class AttemptController extends Controller {

    public function reqSoal($idUjian) {
        $soal = Soal::where('id_ujian', $idUjian)->orderBy('created_at', 'asc')->get();
        if(isset($_GET['attempt'])) {
            $idAttempt = $_GET['attempt'];
            $soal = collect(DB::select("
            SELECT
            soal.id,
            soal.soal,
            soal.a,
            soal.b,
            soal.c,
            soal.d,
            soal.e,
            correct.jawaban,
            correct.is_correct
            FROM
            tbl_attempt_correction as correct
            RIGHT JOIN tbl_soal as soal ON
            correct.id_soal=soal.id AND
            soal.id_ujian='" . $idUjian. "' AND
            correct.id_attempt='" . $idAttempt . "'
            WHERE
            soal.id_ujian='" . $idUjian . "' &&
            soal.deleted_at IS NULL &&
            correct.deleted_at IS NULL
            ORDER BY soal.created_at ASC"));
        }
        if($soal->count() > 0)
        return $this->success($soal);
        return $this->error("Soal gagal di load");
    }

    public function sendJawaban(Request $input) {
        $attempt = Attempt::where('id', $input->idAttempt)
                            ->where('id_ujian', $input->idUjian)
                            ->where('id_user', Auth::id())
                            ->first();
        if($attempt == null) return $this->error("Attempt tidak ditemukan");

        $soal = Soal::where('id', $input->idSoal)->where('id_ujian', $input->idUjian)->first();
        if($soal == null) return $this->error("Soal tidak ditemukan");

        $correction = AttemptCorrection::where('id_attempt', $input->idAttempt)->where('id_soal', $input->idSoal)->first();
        if(
            ($input->jawaban != null) ||
            ($input->jawaban == 'a') ||
            ($input->jawaban == 'b') ||
            ($input->jawaban == 'c') ||
            ($input->jawaban == 'd') ||
            ($input->jawaban == 'e')
        ) {
            if($correction == null) {
                $correction = new AttemptCorrection;
                $correction->id = Uuid::generate();
                $correction->id_attempt = $input->idAttempt;
                $correction->jawaban = $input->jawaban;
                $correction->id_soal = $input->idSoal;
                if($input->jawaban == $soal->jawaban)
                $correction->is_correct = 1;
                $correction->save();
                return $this->success("created");
            }
            else {
                $correction->jawaban = $input->jawaban;
                if($input->jawaban == $soal->jawaban)
                $correction->is_correct = 1;
                $correction->save();
                return $this->success("updated");
            }
        }
        else {
            if($correction != null) {
                $correction->forceDelete();
                return $this->success("deleted");
            }
            else return $this->error("Terjadi kesalahan");
        }
    }

}
