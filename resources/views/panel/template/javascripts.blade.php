<script src="{{ asset("Auth-Panel/plugins/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/adminlte.js") }}"></script>
<script src="{{ asset("Auth-Panel/plugins/chart.js/Chart.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/demo.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/pages/dashboard3.js") }}"></script>
<script src="{{ asset("Auth-Panel/plugins/select2/js/select2.full.min.js") }}"></script>

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

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })

    function formRequestAjaxGlobal(element)
    {
        var elementHTML = $(element);
        var idModal     = elementHTML.attr("data-id-closed-modal");
        $.ajax({
            url     : elementHTML.attr("action"),
            method  : elementHTML.attr("method"),
            data    : elementHTML.serialize(),
            success : function (response){
                if(response.status==="success")
                {
                    toastSuccess("Sucesso!", response.message);
                    setTimeout(function (){
                        if(idModal)
                        {
                            $("#"+idModal).modal("hide");
                        }
                    }, 4000);
                    if(elementHTML.attr("data-reload") && elementHTML.attr("data-reload")==="true")
                    {
                        setTimeout(function (){
                            location.reload();
                        }, 4000);
                        return;
                    }
                    if(response.routeRedirect)
                    {
                        setTimeout(function (){
                            location.href = response.routeRedirect;
                        }, 4000);
                        return;
                    }
                    return;
                }
                toastError("Ops!", response.message);
            },
            error   : function (response){
                if(response.responseJSON.message && response.responseJSON.message==="Validação de Campos não passou!!")
                {
                    toastError("Ops!", response.responseJSON.message, 20);
                    if(response.responseJSON.data.errorValidation)
                    {
                        $.each(response.responseJSON.data.errorValidation, function (index, arrayError){
                            $.each(arrayError, function (index2, error){
                                toastError("Atenção", " no campo ("+index+"): "+error, 20);
                            });
                        });
                    }
                }
            },
        })
    }

    function listRolesAjax()
    {
        var selectRoles = $(".roles_ids");
        $.each(selectRoles, function (index, element)
        {
            var elementHTML = $(element);
            var userId = null;
            if(elementHTML.attr("data-user-id")){userId = elementHTML.attr("data-user-id");}
            $.ajax({
                url     : "/funcoes/listRolesAjax/"+elementHTML.attr("data-method")+"/" + userId ?? null,
                method  : "GET",
                success : function (response){
                    var optionSelect = "";
                    $.each(response.list, function (index, option){
                        optionSelect += "<option value='"+option.id+"' "+option.selected+">"+option.text+"</option>";
                    });
                    elementHTML.html(optionSelect);
                },
                error   : function (response){
                    console.log(response);
                },
            })
        })
    }

    $(document).ready(function (){
        listRolesAjax();
    })


</script>

@yield("javascriptLocal")
