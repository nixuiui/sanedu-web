@extends('layouts.landing')
@section('title')
Hubungi Kami
@endsection
@section('content')
<section id="about-us" class="about-us">
    <div class="overlay">
        <div class="container padding-top-large">
            <h2>
                <strong class="bold-text">Tentang</strong>
                <span class="light-text main-color">SANEDU</span>
            </h2>
            <div class="line main-bg"></div>
            <div class="row margin-bottom-medium">
                <div class="col-md-7">
                    <div class="jumbo-text light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
                        Bimbingan belajar pertama yang menerapkan metode <strong class="bold-text">Multiple Intelligence System</strong> dan <strong class="bold-text">Electronic System</strong>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('asset-landing/img/main/multiple-intel.png')}}" alt="About Us" class="center-block img-responsive">
                </div>
                <div class="clearfix"></div>
            </div>
            <p class="margin-bottom-medium wow slideInUp">
                Bimbingan belajar SAN merupakan bimbingan belajar yang menerapkan strategi pembelajaran multiple Intelligence sebagai upaya untuk mencapai kompetensi dalam pembelajaran dengan cara mengoptimalkan delapan jenis kecerdasan yang dimiliki setiap siswa, karena pada dasarnya setiap anak terlahir memiliki kecendrungan kecerdasan. Selain itu bimbingan belajar SAN juga menerapkan konsep digitalisasi sarana pendidikan sebagai penunjang proses belajar siswa seperti E-Modul, Aplikasi Belajar berplatform android, lab multimedia, materi visual dan juga musik.
            </p>
            <div class="row margin-top-large" id="informasi">
                <div class="col-md-8">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <!-- =========================
                        Collapsible Panel 1
                        ============================== -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <div class="panel-title">
                                    <a href="#collapseOne" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="state"><strong>-</strong></span>
                                        <strong>KELEBIHAN 1</strong>
                                    </a>
                                </div>
                            </div> <!-- *** end panel-heading *** -->
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    Menerapkan strategi pembelajaran multiple Inteligence dalam proses belajar mengajar, yang dapat menyesuaikan metode belajar dengan kecendrungan kecerdasan siswa, sehingga mendorong para tutor berinovasi dalam mengajar serta mendorong siswa untuk aktif dalam proses belajar mengajar.
                                </div>
                            </div> <!-- *** end collapsed item *** -->
                        </div> <!-- *** end panel *** -->

                        <!-- =========================
                        Collapsible Panel 2
                        ============================== -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <div class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="state"><strong>+</strong></span>
                                        <strong>KELEBIHAN 2</strong>
                                    </a>
                                </div>
                            </div> <!-- *** end panel-heading *** -->
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    Menggunakan digital sistem dalam proses belajar mengajar yang meliputi :
                                    <ul>
                                        <li>1. Aplikasi belajar berbasis Android</li>
                                        <li>2. Pembelajaran melalui Visual dan Musik</li>
                                        <li>3. E-Modul yang dapat diakses melalui smartphone siswa</li>
                                        <li>4. Tutorial Streaming</li>
                                        <li>5. Ujian berbasis computer</li>
                                    </ul>
                                </div>
                            </div> <!-- *** end collapsed item *** -->
                        </div> <!-- *** end panel *** -->

                        <!-- =========================
                        Collapsible Panel 3
                        ============================== -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <div class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="state"><strong>+</strong></span>
                                        <strong>KELEBIHAN 3</strong>
                                    </a>
                                </div>
                            </div> <!-- *** end panel-heading *** -->
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    Membuka layanan konsultasi kapanpun dan dimanapun terkait pembelajaran dengan tutor yang dapat dilakukan secara langsung (face to face) ataupun dengan menu chat yang terdapat pada Apps, sehingga dapat memudahkan siswa dalam berkonsultasi.
                                </div>
                            </div> <!-- *** end collapsed item *** -->
                        </div> <!-- *** end panel *** -->
                    </div> <!-- *** end panel-group *** -->
                </div> <!-- *** end col-md-8 *** -->
                <div class="photo-samping-kelebihan">
                    <img src="{{ asset('asset-landing/img/people/Untitled.png')}}" class="center-block img-responsive" alt="Case Study">
                </div>
            </div>
        </div>
    </div>
</section> <!-- *** end About Us *** -->

<!-- =========================
Case Study
============================== -->
<section id="case-study" class="case-study">
    <div class="row mar-none mat-none">

        <!-- *****  Case Study Left ***** -->
        <div class="col-md-12 case-study-left wow slideInRight">
            <div class="overlay padding-large">
                <div class="description">
                    <h1 class="margin-bottom-medium light-text">Multiple Intelligence System</h1>
                    <p>
                        Multiple Intelligence merupakan cara untuk menggali kompetensi melalui delapan jalur kecerdasan yang dimiliki setiap siswa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section> <!-- *** end Case Study *** -->

<!-- =========================
Kenapa harus SANEDU ?
============================== -->
<section id="why-choose-us" class="why-choose-us">
    <div class="container margin-top-large">
        <h2>
            Kenapa
            <strong class="bold-text">harus</strong>
            <span class="light-text main-color">SANEDU</span>
        </h2>
        <div class="line main-bg margin-bottom-large"></div>

        <div class="row text-center">

            <!-- *****  Service Single ***** -->
            <div class="col-md-4">
                <div class="service wow slideInLeft">
                    <div class="icon"><i class="icon-idea"></i></div>
                    <h4>Multiple Intelligence <strong>System</strong></h4>
                    <p>Menerapkan metode multiple Inteligence dalam proses belajar mengajar, serta setiap siswa akan mendapatkan laporan hasil tes Multiple  Intelligence.</p>
                </div>
            </div>

            <!-- *****  Service Single ***** -->
            <div class="col-md-4">
                <div class="service wow fadeInUp">
                    <div class="icon"><i class="icon-heart"></i></div>
                    <h4>Lingkungan belajar <strong>Kekeluargaan</strong></h4>
                    <p>Satu kelas Max terdiri dari 6 siswa (semi private), sehingga tutor dan siswa lebih leluasa dalam berinteraksi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service wow slideInRight">
                    <div class="icon"><i class="icon-office"></i></div>
                    <h4><strong>Metode</strong> Berbeda</h4>
                    <p>Metode belajar menyesuaikan dengan kecendrungan kecerdasan siswa, selain itu bimbingan belajar san juga menerapkan pembelajaran berbasis Praktikum serta bimbingan belajar pertama yang menerapkan Ujian Berbasis Komputer.</p>
                </div>
            </div>

            <!-- *****  Service Single ***** -->
            <div class="col-md-4">
                <div class="service wow slideInLeft">
                    <div class="icon"><i class="icon-mobile"></i></div>
                    <h4><strong>Support</strong> Mobile Apps</h4>
                    <p>Bimbingan Belajar SAN mengembangan Mobile Apps yang diberi nama SANEDU yang dapat menunjang siswa untuk mendapatkan informasi dan fasilitas pendidikan yang meliputi modul pembelajaran, data Passinggrade dari jenjang SMP s/d Perguruan Tinggi Negeri (PTN), Try Out Bulanan, Latihan Ujian Nasional Berbasis Komputer, Simulasi SBMPTN Berbasis Komputer, dll. Mobile Apps dapat diunduh secara gratis melalui Play store.</p>
                </div>
            </div>

            <!-- *****  Service Single ***** -->
            <div class="col-md-4">
                <div class="service wow fadeInUp">
                    <div class="icon"><i class="icon-code"></i></div>
                    <h4><strong>Online</strong> System</h4>
                    <p>Selain Mobile Apps, Bimbingan Belajar SAN juga mengembangkan website yang dapat diakses oleh setiap siswa untuk mendapatkan informasi terkait pembelajaran.</p>
                </div>
            </div>

            <!-- *****  Service Single ***** -->
            <div class="col-md-4">
                <div class="service wow slideInRight">
                    <div class="icon"><i class="icon-discussion"></i></div>
                    <h4><strong>Diskusi</strong> Kapanpun</h4>
                    <p>Bimbingan Belajar SAN membuka layanan diskusi terkait pembelajaran dengan tutor yang dapat dilakukan secara langsung (face to face) ataupun dengan menu chat yang terdapat pada Apps, sehingga dapat memudahkan siswa dalam berkonsultasi. </p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- *** end row *** -->
    </div> <!-- *** end container *** -->
</section> <!-- *** end Why Choose Us *** -->


<!-- =========================
Our Skills
============================== -->
<section id="our-skills" class="our-skills">
    <div class="container padding-top-large">
        <h2>
            Kemampuan
            <strong class="bold-text">membimbing</strong>
            <span class="light-text main-color">Kami</span>
        </h2>
        <div class="line main-bg margin-bottom-medium"></div>
        <div class="row">
            <div class="col-md-7">
                <ul class="skill-bar">
                    <li>
                        <p>Sekolah Menengah Atas (SMA)</p>
                        <div class="wrapper"><span data-width="90"></span></div>
                    </li>
                    <li>
                        <p>Sekolah Menengah Pertama (SMP)</p>
                        <div class="wrapper"><span data-width="80"></span></div>
                    </li>
                    <li>
                        <p>Sekolah Dasar (SD)</p>
                        <div class="wrapper"><span data-width="85"></span></div>
                    </li>
                    <li>
                        <p>Umum (SMK/SMEA)</p>
                        <div class="wrapper"><span data-width="65"></span></div>
                    </li>
                </ul>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('asset-landing/img/people/Untitled2.png')}}" class="center-block img-responsive" alt="Our Skills are excellent">
            </div>
            <div class="clearfix"></div>
        </div> <!-- *** end row *** -->
    </div> <!-- *** end container *** -->
</section> <!-- *** end Our Skills *** -->



<!-- =========================
Processes
============================== -->
<section id="processes" class="processes">
    <div class="overlay">
        <div class="container padding-large">
            <div class="row">
                <div class="col-md-5 text-center process-interactive wow fadeInLeft" data-wow-duration="2s">
                    <div class="process-bar main-bg discussion">
                        <i class="icon-discussion"></i>
                    </div>
                    <div class="process-bar right check">
                        <i class="icon-check"></i>
                    </div>
                    <div class="lines"></div>
                    <div class="process-bar main-bg idea">
                        <i class="icon-idea"></i>
                    </div>
                    <div class="process-bar right office">
                        <i class="icon-office"></i>
                    </div>
                </div> <!-- *** end col-md-5 *** -->
                <div class="col-md-7">

                    <!-- *****  Single feature ***** -->
                    <div class="feature wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon-container pull-left">
                            <span class="icon-discussion"></span>
                        </div>
                        <div class="description text-left pull-right">
                            <h4><strong>Diskusi pelajaran</strong></h4>
                            <p>
                                Membuka layanan konsultasi pembelajaran kapanpun dan dimanapun
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- *****  Single feature ***** -->
                    <div class="feature wow fadeInUp" data-wow-delay=".3s">
                        <div class="icon-container pull-left">
                            <span class="icon-idea "></span>
                        </div>
                        <div class="description text-left pull-right">
                            <h4><strong>Penyelesaian soal dengan mudah</strong></h4>
                            <p>
                                Penyelesaian soal dilakukan dengan metode yang sederhana dan bermain logika sehingga memudahkan siswa untuk memahami penjelasan.
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- *****  Single feature ***** -->
                    <div class="feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon-container pull-left">
                            <span class="icon-office "></span>
                        </div>
                        <div class="description text-left pull-right">
                            <h4><strong>Penerapan metode terbaru</strong></h4>
                            <p>
                                Menerapkan metode belajar multiple intelligence, metode belajar praktikum dan Elektronik Sistem.
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div> <!-- *** end col-md-7 *** -->
            </div>
        </div>
    </div>
</section> <!-- *** end Processes *** -->

<!-- =========================
Our Team
============================== -->
<section id="our-team" class="our-team">
    <div class="container padding-top-large">
        <h2 class="wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".5s">
            Dibalik
            <strong class="bold-text">layar</strong>
            <span class="light-text main-color">SANEDU</span>
        </h2>
        <div class="line main-bg margin-bottom-medium"></div>


        <div class="row">
            <!-- ***** CEO section ***** -->
            <div class="col-md-3 col-sm-6 col-xs-12 margin-bottom-large">
                <!-- ***** Team member-1 ***** -->
                <div class="team-member center-block wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="1s">
                    <img src="{{ asset('asset-landing/img/people/TiniNurAprilia.jpeg')}}" class="img-responsive" alt="Tini Aprilia Sari">
                    <div class="team-overlay text-center">
                        <div class="info">
                            <h3><strong>Tini Aprilia Sari</strong></h3>
                            <p>CEO/Founder</p>
                        </div>
                        <div class="learn-more" data-toggle="modal" data-target="#team-member-1">
                            <strong>Learn More</strong>
                        </div>
                    </div>
                </div> <!-- *** end Team member-1 *** -->
                <!-- Team Member-1 Modal -->
                <div class="modal fade contact-form" id="team-member-1" tabindex="-1" role="dialog" aria-labelledby="team-member-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body member-info">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <figure>
                                            <img src="{{ asset('asset-landing/img/people/TiniNurAprilia.jpeg')}}" alt="Tini Aprilia Sari">
                                        </figure>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div class="description">
                                            <h3><strong class="bold-text">Tini Aprilia Sari</strong></h3>
                                            <div class="light-text">CEO/Founder</div>
                                            <div class="about margin-top-medium">
                                                <p>
                                                    Riwayat Pendidikan
                                                </p>
                                                <ul>
                                                    <li>SDN 2 Prumnas Wayhalim Bandar Lampung</li>
                                                    <li>SMPN 4 Bandar Lampung</li>
                                                    <li>SMAN 5 Bandar Lampung</li>
                                                    <li>S1 Pendidikan Biologi Universitas Lampung (Unila)</li>
                                                </ul>
                                            </div>

                                        </div> <!-- *** end description *** -->
                                    </div> <!-- *** end col-md-7 *** -->
                                </div> <!-- *** end row *** -->
                            </div> <!-- *** end modal-body *** -->
                        </div> <!-- *** end modal-content *** -->
                    </div> <!-- *** end modal-dialog *** -->
                </div> <!-- *** end Contact Form modal *** -->
            </div> <!-- *** end Team member 1 section *** -->

            <!-- ***** Team member 2 section ***** -->
            <div class="col-md-3 col-sm-6 col-xs-12 margin-bottom-large">
                <!-- ***** Team member-2 ***** -->
                <div class="team-member center-block wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">
                    <img src="{{ asset('asset-landing/img/people/DikiThantawi.jpeg')}}" class="img-responsive" alt="Diki Thantawi">
                    <div class="team-overlay text-center">
                        <div class="info">
                            <h3><strong>Diki Thantawi</strong></h3>
                            <p>COO/Co-Founder</p>
                        </div>
                        <div class="learn-more" data-toggle="modal" data-target="#team-member-2">
                            <strong>Learn More</strong>
                        </div>
                    </div>
                </div> <!-- *** end Team member-1 *** -->
                <!-- Team Member-2 Modal -->
                <div class="modal fade contact-form" id="team-member-2" tabindex="-1" role="dialog" aria-labelledby="team-member-2" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body member-info">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <figure>
                                            <img src="{{ asset('asset-landing/img/people/DikiThantawi.jpeg')}}" alt="Diki Thantawi">
                                        </figure>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div class="description">
                                            <h3><strong class="bold-text">Diki Thantawi</strong></h3>
                                            <div class="light-text">COO and Co-Founder</div>
                                            <div class="about margin-top-medium">
                                                <p>
                                                    Riwayat Pendidikan
                                                </p>
                                                <ul>
                                                    <li>SDN 2 Sukabumi, Bandar Lampung</li>
                                                    <li>SMPN 4 Bandar Lampung</li>
                                                    <li>SMAN 5 Bandar Lampung</li>
                                                    <li>S1 Ilmu Pemerintahan Universitas Lampung (Unila)</li>
                                                </ul>
                                            </div>
                                        </div> <!-- *** end description *** -->
                                    </div> <!-- *** end col-md-7 *** -->
                                </div> <!-- *** end row *** -->
                            </div> <!-- *** end modal-body *** -->
                        </div> <!-- *** end modal-content *** -->
                    </div> <!-- *** end modal-dialog *** -->
                </div> <!-- *** end Contact Form modal *** -->
            </div> <!-- *** end Team member 2 section *** -->

            <!-- ***** Team member 3 section ***** -->
            <div class="col-md-3 col-sm-6 col-xs-12 margin-bottom-large">
                <!-- ***** Team member-1 ***** -->
                <div class="team-member center-block wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">
                    <img src="{{ asset('asset-landing/img/people/FarhanDurell.jpeg')}}" class="img-responsive" alt="Farhan Putra Pratama Durell">
                    <div class="team-overlay text-center">
                        <div class="info">
                            <h3><strong>Farhan Putra Pratama Durell</strong></h3>
                            <p>CMO</p>
                        </div>
                        <div class="learn-more" data-toggle="modal" data-target="#team-member-3">
                            <strong>Learn More</strong>
                        </div>
                    </div>
                </div> <!-- *** end Team member-3 *** -->
                <!-- Team Member-3 Modal -->
                <div class="modal fade contact-form" id="team-member-3" tabindex="-1" role="dialog" aria-labelledby="team-member-3" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body member-info">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <figure>
                                            <img src="{{ asset('asset-landing/img/people/FarhanDurell.jpeg')}}" alt="Farhan Putra Pratama Durell">
                                        </figure>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div class="description">
                                            <h3><strong class="bold-text">Farhan Putra Pratama Durell</strong></h3>
                                            <div class="light-text">Chief Marketing Officer</div>
                                            <div class="about margin-top-medium">
                                                <p>
                                                    Riwayat Pendidikan
                                                </p>
                                                <ul>
                                                    <li>SDN 004 TB Dumai Riau</li>
                                                    <li>SMPN 10 Metro</li>
                                                    <li>SMAN 2 Metro</li>
                                                    <li>S1 Bimbingan Konseling Universitas Lampung (Unila)</li>
                                                </ul>
                                            </div>
                                        </div> <!-- *** end description *** -->
                                    </div> <!-- *** end col-md-7 *** -->
                                </div> <!-- *** end row *** -->
                            </div> <!-- *** end modal-body *** -->
                        </div> <!-- *** end modal-content *** -->
                    </div> <!-- *** end modal-dialog *** -->
                </div> <!-- *** end Contact Form modal *** -->
            </div> <!-- *** end Team member 3 section *** -->

            <!-- ***** Team member 4 section ***** -->
            <div class="col-md-3 col-sm-6 col-xs-12 margin-bottom-large">
                <!-- ***** Team member-1 ***** -->
                <div class="team-member center-block wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1s">
                    <img src="{{ asset('asset-landing/img/people/DyahTriLestari.jpeg')}}" class="img-responsive" alt="Dyah Tri Lestari">
                    <div class="team-overlay text-center">
                        <div class="info">
                            <h3><strong>Dyah Tri Lestari</strong></h3>
                            <p>CFO</p>
                        </div>
                        <div class="learn-more" data-toggle="modal" data-target="#team-member-4">
                            <strong>Learn More</strong>
                        </div>
                    </div>
                </div> <!-- *** end Team member-4 *** -->
                <!-- Team Member-4 Modal -->
                <div class="modal fade contact-form" id="team-member-4" tabindex="-1" role="dialog" aria-labelledby="team-member-4" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body member-info">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <figure>
                                            <img src="{{ asset('asset-landing/img/people/DyahTriLestari.jpeg')}}" alt="Dyah Tri Lestari">
                                        </figure>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div class="description">
                                            <h3><strong class="bold-text">Dyah Tri Lestari</strong></h3>
                                            <div class="light-text">Chief Financial Officer</div>
                                            <div class="about margin-top-medium">
                                                <p>
                                                    Riwayat Pendidikan
                                                </p>
                                                <ul>
                                                    <li>SDN 1 Sebarus</li>
                                                    <li>SMPN 1 Liwa</li>
                                                    <li>SMAN 1 Liwa</li>
                                                    <li>S1 Agroteknologi  Universitas Lampung (Unila)</li>
                                                </ul>
                                            </div>
                                        </div> <!-- *** end description *** -->
                                    </div> <!-- *** end col-md-7 *** -->
                                </div> <!-- *** end row *** -->
                            </div> <!-- *** end modal-body *** -->
                        </div> <!-- *** end modal-content *** -->
                    </div> <!-- *** end modal-dialog *** -->
                </div> <!-- *** end Contact Form modal *** -->
            </div> <!-- *** end Team member 4 section *** -->

            <!-- ***** CTO section ***** -->
            <div class="col-md-3 col-sm-6 col-xs-12 margin-bottom-large">
                <!-- ***** Team member-5 ***** -->
                <div class="team-member center-block wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay="1s">
                    <img src="{{ asset('asset-landing/img/people/AdityaEdgar.jpeg')}}" class="img-responsive" alt="Aditya Edgar Ramadhan">
                    <div class="team-overlay text-center">
                        <div class="info">
                            <h3><strong>Aditya Edgar Ramadhan</strong></h3>
                            <p>CTO</p>
                        </div>
                        <div class="learn-more" data-toggle="modal" data-target="#team-member-5">
                            <strong>Learn More</strong>
                        </div>
                    </div>
                </div> <!-- *** end Team member-5 *** -->
                <!-- Team Member-5 Modal -->
                <div class="modal fade contact-form" id="team-member-5" tabindex="-1" role="dialog" aria-labelledby="team-member-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body member-info">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <figure>
                                            <img src="{{ asset('asset-landing/img/people/AdityaEdgar.jpeg')}}" alt="Aditya Edgar Ramadhan">
                                        </figure>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div class="description">
                                            <h3><strong class="bold-text">Aditya Edgar Ramadhan</strong></h3>
                                            <div class="light-text">Chief Technology Officer</div>
                                            <div class="about margin-top-medium">
                                                <p>
                                                    Riwayat Pendidikan
                                                </p>
                                                <ul>
                                                    <li>SDN 2 Prumnas Wayhalim</li>
                                                    <li>SMPN 21 Bandar Lampung</li>
                                                    <li>SMk BLK Bandar Lampung</li>
                                                    <li>S1  Ibi Darmajaya</li>
                                                </ul>
                                            </div>
                                        </div> <!-- *** end description *** -->
                                    </div> <!-- *** end col-md-7 *** -->
                                </div> <!-- *** end row *** -->
                            </div> <!-- *** end modal-body *** -->
                        </div> <!-- *** end modal-content *** -->
                    </div> <!-- *** end modal-dialog *** -->
                </div> <!-- *** end Contact Form modal *** -->
            </div> <!-- *** end Team member 1 section *** -->

        </div>
    </div>
</section> <!-- *** end Our Team *** -->


<section id="testimonial" class="testimonial padding-large white-color text-center">
    <div class="container">
        <div class="row">
            <h2 class="margin-bottom-medium">Testimoni <strong class="bold-text">SANEDU</strong></h2>
            <div class="col-md-10 col-md-offset-1">

                <!-- *****  Carousel start ***** -->
                <div id="testimonial-carousel" class="owl-carousel owl-theme testimonial-carousel">

                    <!-- =========================
                    Single Testimonial item
                    ============================== -->
                    <div class="item margin-bottom-small"> <!-- ITEM START -->
                        <p>Uhh sungguh deh luar biyasa!</p>
                        <div class="client margin-top-medium clearfix">
                            <img src="{{ asset('asset-landing/img/testimonial/testimonial-1.jpg')}}" height="50" width="50" alt="Client Image">
                            <ul class="client-info main-color">
                                <li><strong>Siapa Saya?</strong></li>
                                <li>Pengangguran</li>
                            </ul>
                        </div>
                    </div> <!-- ITEM END -->

                    <!-- =========================
                    Single Testimonial item
                    ============================== -->
                    <div class="item"> <!-- ITEM START -->
                        <p>Uhh sungguh deh luar biyasa!</p>
                        <div class="client margin-top-medium">
                            <img src="{{ asset('asset-landing/img/testimonial/testimonial-2.jpg')}}" alt="Client Image" class="grayscale">
                            <ul class="client-info main-color">
                                <li>Aku bukan siapa-siapa</li>
                                <li>Pengangguran</li>
                            </ul>
                        </div>
                    </div> <!-- ITEM END -->

                    <div class="item"> <!-- ITEM START -->
                        <p>Uhh sungguh deh luar biyasa!</p>
                        <div class="client margin-top-medium">
                            <img src="{{ asset('asset-landing/img/testimonial/testimonial-1.jpg')}}" alt="Client Image" class="grayscale">
                            <ul class="client-info main-color">
                                <li>Aku bukan siapa-siapa</li>
                                <li>Pengangguran</li>
                            </ul>
                        </div>
                    </div> <!-- ITEM END -->

                    <!-- =========================
                    Single Testimonial item
                    ============================== -->
                    <div class="item"> <!-- ITEM START -->
                        <p>Uhh sungguh deh luar biyasa!</p>
                        <div class="client margin-top-medium">
                            <img src="{{ asset('asset-landing/img/testimonial/testimonial-2.jpg')}}" alt="Client Image" class="grayscale">
                            <ul class="client-info main-color">
                                <li>Aku bukan siapa-siapa</li>
                                <li>Pengangguran</li>
                            </ul>
                        </div>
                    </div> <!-- ITEM END -->

                    <!-- =========================
                    Single Testimonial item
                    ============================== -->
                    <div class="item"> <!-- ITEM START -->
                        <p>Uhh sungguh deh luar biyasa!</p>
                        <div class="client margin-top-medium">
                            <img src="{{ asset('asset-landing/img/testimonial/testimonial-1.jpg')}}" alt="Client Image" class="grayscale">
                            <ul class="client-info main-color">
                                <li>Aku bukan siapa-siapa</li>
                                <li>Pengangguran</li>
                            </ul>
                        </div>
                    </div> <!-- ITEM END -->
                </div>
            </div>
        </div>
    </div>
</section> <!-- *** end Testimonial *** -->
@endsection
