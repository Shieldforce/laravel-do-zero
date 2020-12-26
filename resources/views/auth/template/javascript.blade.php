<script src="{{ asset("Auth-Panel/plugins/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/adminlte.min.js") }}"></script>

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
        } )
    </script>
@endif
