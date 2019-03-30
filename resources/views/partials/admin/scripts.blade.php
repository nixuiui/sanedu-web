<script src="{{ asset('asset-beagle/js/main.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('asset-beagle/lib/jquery/jquery.min.js') }}" type="text/javascript"></script> -->
<script src="{{ asset('asset-beagle/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/prettify/prettify.js') }}" type="text/javascript"></script>

<script src="{{ asset('asset-beagle/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/moment.js/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  	App.init();
    App.dataTables();
  	App.formElements();
});
</script>

<script src="{{ asset('asset-beagle/lib/sweetalert2/js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/vue/vue.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset-beagle/lib/axios/axios.min.js') }}" type="text/javascript"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
$(document).on("click", ".delete", function(e) {
    var link = $(this).attr("href"); // "get" the intended link in a var
    e.preventDefault();
    swal({
        title: "Kamu Yakin?",
        text: "Data akan dihapus selamanya!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn btn-danger btn-fill",
        confirmButtonText: "Ya, hapus saja!",
        cancelButtonClass: "btn btn-danger btn-fill",
        cancelButtonText: "Tidak, gajadi!"
    }).then((result) => {
        if (result.value) {
            document.location.href = link;
        }
    });
});

$(document).on("click", ".clickable-row", function() {
    window.location = $(this).data("href");
});

$('img').error(function(){
    $(this).attr("src", "{{ asset('asset-beagle/img/empty.png') }}");
});
</script>
@yield('script')
