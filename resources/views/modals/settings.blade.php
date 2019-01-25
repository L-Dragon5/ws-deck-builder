<div class="modal fade" id="settings-modal" tabindex="-1" role="dialog" aria-labelledby="Item Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="item-modal-title">Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="settings-form">
            <div class="container-fluid">
              <h3>Change Password</h3>
              <div class="row">
                <div class="col-lg-6">
                  <label for="settings-old-pass">Old Password:</label>
                  <input type="password" id="settings-old-pass" class="form-control" />
                </div>

                <div class="col-lg-6">
                  <label for="settings-new-pass">New Password:</label>
                  <input type="password" id="settings-new-pass" class="form-control" />
                </div>
              </div>

              <br>

              <h3>Download Records</h3>
              <div class="row">
                <div class="col-lg-12">
                  <a href="/settings/csv" id="download-btn" class="btn btn-success">Download CSV</a>
                </div>
              </div>

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="settingsSaveButton" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>