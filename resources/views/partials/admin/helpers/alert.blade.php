<div class="row">
    <div class="col-md-12">
        @if(session('success'))
            {{ htmlAlert('success',session('success')) }}
        @elseif(session('danger'))
            {{ htmlAlert('danger',session('danger')) }}
        @endif
    </div>
</div>
