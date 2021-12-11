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
            hideAfter : 4000 ,
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

    function toastSuccess(title, text, stack) {
        $.toast( {
            heading   : title ,
            text      : text ,
            icon      : 'success' ,
            hideAfter : 4000 ,
            position  : 'top-right' ,
            allowToastClose: true,
            showHideTransition : 'slide', // slide | fade | plain
            loader: true,
            loaderBg: '#9EC600',
            //stack: 5,
            stack   : stack ,
            bgColor: false,
            textColor: false,
            textAlign: 'left',
        } );
    }

    function toastError(title, text, stack) {
        $.toast( {
            heading   : title ,
            text      : text ,
            icon      : 'error' ,
            hideAfter : 4000 ,
            position  : 'top-right' ,
            allowToastClose: true,
            showHideTransition : 'slide', // slide | fade | plain
            loader: true,
            loaderBg: '#9EC600',
            //stack: 5,
            stack   : stack ,
            bgColor: false,
            textColor: false,
            textAlign: 'left',
        } );
    }

    function toastInfo(title, text, stack) {
        $.toast( {
            heading   : title ,
            text      : text ,
            icon      : 'info' ,
            hideAfter : 4000 ,
            position  : 'top-right' ,
            allowToastClose: true,
            showHideTransition : 'slide', // slide | fade | plain
            loader: true,
            loaderBg: '#9EC600',
            //stack: 5,
            stack   : stack ,
            bgColor: false,
            textColor: false,
            textAlign: 'left',
        } );
    }
</script>
