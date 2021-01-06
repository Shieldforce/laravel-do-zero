<script src="{{ asset("Auth-Panel/plugins/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/adminlte.js") }}"></script>
<script src="{{ asset("Auth-Panel/plugins/chart.js/Chart.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/demo.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/pages/dashboard3.js") }}"></script>

{{-- Include Toast CSS and JS --}}
<link rel="stylesheet" href="/vendor/shieldforce/package-auto-validation-laravel/public/plugins/toast/toast.css">
<script src="/vendor/shieldforce/package-auto-validation-laravel/public/plugins/toast/toast.js"></script>
<script src="/vendor/shieldforce/package-auto-validation-laravel/public/js/toast.adapters.js"></script>

@if (count($errors) > 0)
    <script>
        $.toast( {
            heading   : 'Atenção ao(s) seguinte(s) erro(s):' ,
            text      : [
                @foreach ($errors->all() as $error)
                    "{{ $error }}" ,
                @endforeach
            ] ,
            icon      : 'error' ,
            hideAfter : false ,
            position  : 'top-right' ,
        } );
    </script>
@endif

<script>

    @if(session("error"))
        toastError("Ops, Houve um erro!", "{{ session("error") }}");
    @endif

    @if(session("success"))
        toastSuccess("Sucesso!", "{{ session("success") }}");
    @endif

    function toastSuccess(title, text) {
        $.toast( {
            heading   : title ,
            text      : text ,
            icon      : 'success' ,
            hideAfter : false ,
            position  : 'top-right' ,
        } );
    }

    function toastError(title, text) {
        $.toast( {
            heading   : title ,
            text      : text ,
            icon      : 'error' ,
            hideAfter : false ,
            position  : 'top-right' ,
        } );
    }

    function toastInfo(title, text) {
        $.toast( {
            heading   : title ,
            text      : text ,
            icon      : 'info' ,
            hideAfter : false ,
            position  : 'top-right' ,
        } );
    }
</script>

@yield("javascriptLocal")
