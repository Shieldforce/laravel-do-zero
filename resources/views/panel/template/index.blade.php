<!DOCTYPE html>
<html lang="pt-BR">
    @include("panel.template.head")
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to to the body tag
    to get the desired effect
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition sidebar-collapse">
        <div class="wrapper">
            @include("panel.template.navbar")
            @include("panel.template.aside-left")
            @yield("content")
            @include("panel.template.aside-right")
            @include("panel.template.footer")
        </div>
        @include("panel.template.javascripts")
    </body>
</html>

