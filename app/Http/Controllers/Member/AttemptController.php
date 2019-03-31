<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Auth;
use Uuid;
use DB;
use App\Http\Controllers\Controller;

use App\Models\Ujian;
use App\Models\Soal;
use App\Models\Attempt;
use App\Models\AttemptCorrection;
use App\Models\AttemptGroup;

class AttemptController extends Controller {

    public function reqSoal($idUjian) {
        $soal = Soal::where('id_ujian', $idUjian)->orderBy('created_at', 'asc')->get();
        $ujian = Ujian::find($idUjian);
        if(isset($_GET['attempt'])) {
            $idAttempt = $_GET['attempt'];
            $data = [];
            if($ujian->is_grouped) {
                $no = 0;
                foreach($ujian->group as $key => $group) {
                    $attempGroup = AttemptGroup::select(["id as id_attempt_group","id_ujian_group","start_attempt","end_attempt"])
                                                ->where("id_attempt", $idAttempt)
                                                ->where("id_ujian_group", $group->id)
                                                ->first();
                    $soal = collect(DB::select("
                        SELECT
                            soal.id,
                            soal.soal,
                            soal.a,
                            soal.b,
                            soal.c,
                            soal.d,
                            soal.e,
                            correct.jawaban
                        FROM
                            tbl_attempt_correction as correct
                                RIGHT JOIN tbl_soal as soal ON
                                    correct.id_soal=soal.id AND
                                    soal.id_ujian='$idUjian' AND
                                    correct.id_attempt='$idAttempt'
                        WHERE
                            soal.id_ujian='$idUjian' &&
                            soal.id_ujian_group='$group->id' &&
                            soal.deleted_at IS NULL &&
                            correct.deleted_at IS NULL
                        ORDER BY soal.created_at ASC"
                    ));
                    $attempGroup->nama = $group->nama;
                    $attempGroup->jumlah_soal = $group->jumlah_soal;
                    $attempGroup->durasi = $group->durasi;
                    $attempGroup->waktu = gmdate("H:i:s", $group->durasi);
                    $attempGroup->is_finished = strtotime($attempGroup->end_attempt) < time() ? 1 : 0;
                    $attempGroup->no_start = ++$no;
                    $attempGroup->no_end = $no += ($group->jumlah_soal-1);
                    $attempGroup->soal = $soal;
                    $data[$key] = $attempGroup;
                }
            }
            else {
                $data = collect(DB::select("
                    SELECT
                        soal.id,
                        soal.soal,
                        soal.a,
                        soal.b,
                        soal.c,
                        soal.d,
                        soal.e,
                        correct.jawaban
                    FROM
                        tbl_attempt_correction as correct
                            RIGHT JOIN tbl_soal as soal ON
                                correct.id_soal=soal.id AND
                                soal.id_ujian='$idUjian' AND
                                correct.id_attempt='$idAttempt'
                    WHERE
                        soal.id_ujian='$idUjian' &&
                        soal.deleted_at IS NULL &&
                        correct.deleted_at IS NULL
                    ORDER BY soal.created_at ASC"
                ));
            }
        }
        if(count($data) > 0)
            return $this->success($data);
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

    public function nextGroupSoal(Request $input) {
        $attempt = Attempt::findOrFail($input->idAttempt);
        $now = date('Y-m-d H:i:s');

        // ATTEMPT NOW
        $attemptGroupNow = AttemptGroup::where("id", $input->idAttemptGroupNow)
                                        ->where("id_attempt", $attempt->id)
                                        ->first();
        $attemptGroupNow->end_attempt = $now;
        $attemptGroupNow->save();

        $attemptGroup = AttemptGroup::where("id_attempt", $attempt->id)
                                    ->where("end_attempt", ">", $now)
                                    ->get();
        
        $startPointTime = plusSecond($now, 1);
        foreach($attemptGroup as $group) {
            $group->start_attempt = $startPointTime;
            $startPointTime = plusSecond($startPointTime, $group->ujianGroup->durasi);
            $group->end_attempt = $startPointTime;
            $startPointTime = plusSecond($startPointTime, 1); 
            $group->save();
        }
        $attempt->end_attempt = $startPointTime;
        $attempt->save();

        // ATTEMPT NEXT
        $attemptGroupNext = AttemptGroup::where("id", $input->idAttemptGroupNext)
                                        ->where("id_attempt", $attempt->id)
                                        ->first();

        return $this->success($attemptGroupNext);
    }

}