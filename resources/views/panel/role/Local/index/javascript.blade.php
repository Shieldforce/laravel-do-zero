@section("javascriptLocal")
    <script src="{{ asset("Auth-Panel/plugins/datatables/jquery.dataTables.min.js") }}"></script>
    <script src="{{ asset("Auth-Panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
    <script src="{{ asset("Auth-Panel/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("Auth-Panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
    <script>

        $(function () {
            $("#example1").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "stateSave" : true,
                "language":
                    {
                        "emptyTable": "Nenhum registro encontrado",
                        "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "infoFiltered": "(Filtrados de _MAX_ registros)",
                        "infoThousands": ".",
                        "loadingRecords": "Carregando...",
                        "processing": "Processando...",
                        "zeroRecords": "Nenhum registro encontrado",
                        "search": "Pesquisar",
                        "paginate": {
                            "next": "Próximo",
                            "previous": "Anterior",
                            "first": "Primeiro",
                            "last": "Último"
                        },
                        "aria": {
                            "sortAscending": ": Ordenar colunas de forma ascendente",
                            "sortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "select": {
                            "rows": {
                                "_": "Selecionado %d linhas",
                                "0": "Nenhuma linha selecionada",
                                "1": "Selecionado 1 linha"
                            },
                            "1": "%d linha selecionada",
                            "_": "%d linhas selecionadas",
                            "cells": {
                                "1": "1 célula selecionada",
                                "_": "%d células selecionadas"
                            },
                            "columns": {
                                "1": "1 coluna selecionada",
                                "_": "%d colunas selecionadas"
                            }
                        },
                        "buttons": {
                            "copySuccess": {
                                "1": "Uma linha copiada com sucesso",
                                "_": "%d linhas copiadas com sucesso"
                            },
                            "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                            "colvis": "Visibilidade da Coluna",
                            "colvisRestore": "Restaurar Visibilidade",
                            "copy": "Copiar",
                            "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
                            "copyTitle": "Copiar para a Área de Transferência",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Mostrar todos os registros",
                                "1": "Mostrar 1 registro",
                                "_": "Mostrar %d registros"
                            },
                            "pdf": "PDF",
                            "print": "Imprimir"
                        },
                        "autoFill": {
                            "cancel": "Cancelar",
                            "fill": "Preencher todas as células com",
                            "fillHorizontal": "Preencher células horizontalmente",
                            "fillVertical": "Preencher células verticalmente"
                        },
                        "lengthMenu": "Exibir _MENU_ resultados por página",
                        "searchBuilder": {
                            "add": "Adicionar Condição",
                            "button": {
                                "0": "Construtor de Pesquisa",
                                "_": "Construtor de Pesquisa (%d)"
                            },
                            "clearAll": "Limpar Tudo",
                            "condition": "Condição",
                            "conditions": {
                                "date": {
                                    "after": "Depois",
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vazio",
                                    "equals": "Igual",
                                    "not": "Não",
                                    "notBetween": "Não Entre",
                                    "notEmpty": "Não Vazio"
                                },
                                "moment": {
                                    "after": "Depois",
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vazio",
                                    "equals": "Igual",
                                    "not": "Não",
                                    "notBetween": "Não Entre",
                                    "notEmpty": "Não Vazio"
                                },
                                "number": {
                                    "between": "Entre",
                                    "empty": "Vazio",
                                    "equals": "Igual",
                                    "gt": "Maior Que",
                                    "gte": "Maior ou Igual a",
                                    "lt": "Menor Que",
                                    "lte": "Menor ou Igual a",
                                    "not": "Não",
                                    "notBetween": "Não Entre",
                                    "notEmpty": "Não Vazio"
                                },
                                "string": {
                                    "contains": "Contém",
                                    "empty": "Vazio",
                                    "endsWith": "Termina Com",
                                    "equals": "Igual",
                                    "not": "Não",
                                    "notEmpty": "Não Vazio",
                                    "startsWith": "Começa Com"
                                }
                            },
                            "data": "Data",
                            "deleteTitle": "Excluir regra de filtragem",
                            "logicAnd": "E",
                            "logicOr": "Ou",
                            "title": {
                                "0": "Construtor de Pesquisa",
                                "_": "Construtor de Pesquisa (%d)"
                            },
                            "value": "Valor"
                        },
                        "searchPanes": {
                            "clearMessage": "Limpar Tudo",
                            "collapse": {
                                "0": "Painéis de Pesquisa",
                                "_": "Painéis de Pesquisa (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Nenhum Painel de Pesquisa",
                            "loadMessage": "Carregando Painéis de Pesquisa...",
                            "title": "Filtros Ativos"
                        },
                        "searchPlaceholder": "Digite um termo para pesquisar",
                        "thousands": "."
                    }
            });
        });

        function dataFormEdit(id) {
            $.ajax({
                url : "funcoes/show/"+id,
                method : "GET",
                success : function (response) {
                    var formEditRole = $("form[name=formEditRole]");
                    formEditRole.find("input[name=id]").val(response.id);
                    formEditRole.find("input[name=name]").val(response.name);
                    formEditRole.find("input[name=description]").val(response.description);
                    formEditRole.find("input[name=group]").val(response.group);
                    formEditRole.find("select[name=type]").val(response.type);
                    formEditRole.find("button[name=role_id]").attr("data-role-id",response.id);
                },
                error : function (response) {
                    toastError("Ops, Houve um erro!", "Usuário não encontrado!");
                },
            });
        }

        function dataFormDelete(id) {
            $.ajax({
                url : "funcoes/show/"+id,
                method : "GET",
                success : function (response) {
                    var formDeleteRole = $("form[name=formDeleteRole]");
                    formDeleteRole.attr("action", "/funcoes/exclusao/"+id);
                },
                error : function (response) {
                    toastError("Ops, Houve um erro!", "Função  não encontrado(a)!");
                },
            });
        }

    </script>
@endsection
