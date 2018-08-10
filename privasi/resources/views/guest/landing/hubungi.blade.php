@extends('layouts.landing')
@section('title')
Hubungi Kami
@endsection
@section('content')


<!-- =========================
Map
============================== -->
<section id="map" class="map">
    <div id="map-container">
    </div>
</section> <!-- *** end Map Container *** -->
<!-- =========================
Send Message
============================== -->
<section id='send-message' class='send-message main-bg white-color text-center'>
    <a href='?action=whatsapp'>
        <div class='send-icon' data-toggle='modal' data-target='#'>
            <i class='fa fa-paper-plane'></i>
        </div>
        <p class='light-text'>
            Anda punya <span class='bold-text'>Pertanyaan</span>? Whatsapp <span class='bold-text'>Kami</span>
        </p>
    </a>

    <!-- Contact Form Modal -->
    <div class='modal fade contact-form' id='contact-form' tabindex='-1' role='dialog' aria-labelledby='contact-form' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
                <div class='modal-body'>
                    <!-- *****  Contact form ***** -->
                    <form class='form' action='#' method='POST'>
                        <div class='row'>
                            <div class='form-group col-md-6'>
                                <input type='text' class='form-control' id='name' placeholder='Nama Anda'>
                            </div>
                            <div class='form-group col-md-6'>
                                <input type='text' class='form-control' id='phone' placeholder='No. Telpon'>
                            </div>
                            <div class='form-group col-md-6'>
                                <input type='email' class='form-control' id='email' placeholder='Email'>
                            </div>
                            <div class='form-group col-md-6'>
                                <input type='text' class='form-control' id='subject' placeholder='Subject'>
                            </div>
                            <div class='form-group col-md-12 mab-none'>
                                <textarea rows='6' class='form-control' id='message' placeholder='Masukkan pesan Anda ...'></textarea>
                            </div>
                            <div class='form-group col-md-12' onClick='document.forms[0].submit();'>
                                <div class='button bold-text main-bg'><i class='fa fa-paper-plane'></i></div>
                            </div>
                        </div>
                    </form>
                </div> <!-- *** end modal-body *** -->
            </div> <!-- *** end modal-content *** -->
        </div> <!-- *** end modal-dialog *** -->
    </div> <!-- *** end Contact Form modal *** -->
</section> <!-- *** end Send Message *** -->
<!-- =========================
Footer
============================== -->
<footer id="footer" class="footer">
    <div class="container padding-large text-center">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <figure class="margin-bottom-medium">
                    <img src="{{ asset('asset-landing/img/main/logo.png')}}" class="footer-logo" alt="SANEDU">
                </figure>
                <p class="margin-bottom-medium" style="color: #484848;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                </p>

                <!-- =========================
                Social icons
                ============================== -->
                <ul class="social margin-bottom-medium">
                    <li class="facebook hvr-pulse"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="twitter hvr-pulse"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="linkedin hvr-pulse"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li class="youtube hvr-pulse"><a href="#"><i class="fa fa-youtube"></i></a></li>
                    <li class="instagram hvr-pulse"><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <p class="copyright" style="color: #484848;">
                    &copy; Copyright 2018 SANEDU - Study And Fun
                </p>
            </div>
        </div>
    </div>
</footer> <!-- *** end Footer *** -->
@endsection
