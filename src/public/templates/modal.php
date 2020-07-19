<div class="modal" id="folder-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" onclick="closeFolderModal()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="modal-form">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="main-input" id="folder-name-input" name="name" required="" placeholder="Folder name">
                    </div>                    
                    <div class="alert alert-danger form-error-alert" role="alert">
                        <span class="error-info"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="closeFolderModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>