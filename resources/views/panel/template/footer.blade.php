<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2012-{{ date("Y", strtotime(now())) }} <a href="https://shieldforce.com.br">{{ env("APP_NAME") }}</a>.</strong>
    Todos os direitos reservados para Shield-Force.
    <div class="float-right d-none d-sm-inline-block">
        <b>Versão</b> {{ $branch ?? "No-Version" }}
    </div>
</footer>
