<div class="modal" id="share-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share</h4>
                <button type="button" class="close" onclick="closeShareModal()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="share-modal-form">
                <div class="modal-body">
                <section>
                    <ul id="error-list">
                    </ul>
                </section>
                    <div class="form-group">
                        <label for="password">Password to secure the link (optional)</label>
                        <input type="password" class="main-input share-option" id="password-input" name="password" placeholder="Password">
                        <label for="count">Maximum number of shares (optional)</label>
                        <input type="number" class="main-input share-option" min="1" id="count-input" name="count" placeholder="Count">
                        <label for="validUntil">Date until the link is valid (optional)</label>
                        <input type="datetime-local" class="main-input share-option" id="valid-until-input" name="validUntil" placeholder="Valid until">
                    </div>                    
                    <input class="main-input hide" id='link' type='text' readonly>
                    <div class="alert alert-danger form-error-alert" role="alert">
                        <span class="error-info"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="closeShareModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit">Create link</button>
                </div>
            </form>
        </div>
    </div>
</div>