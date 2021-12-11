<div class="modal fade" id="delete-role">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Tem certeza que deseja deletar?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form
                method="POST"
                enctype="multipart/form-data"
                name="formDeleteRole"
                onsubmit="event.preventDefault();formRequestAjaxGlobal(this);"
                data-id-closed-modal="delete-role"
                data-reload="true"
            >
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE" />
                <input type="hidden" name="routeType" value="api">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</div>
