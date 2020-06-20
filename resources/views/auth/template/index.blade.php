<!DOCTYPE html>
<html>
    @includeIf("auth.template.head")
    <body class="hold-transition login-page">
        @yield("content")
        @includeIf("auth.template.javascript")
    </body>
</html>

