    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Add Type</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
        <div class="offcanvas-body">
             <form class="row g-3" id="add_type_form">
                 <div class="col-12">
            <label for="inputAddress" class="form-label">Document Type</label>
            <input type="text" class="form-control" id="inputAddress" name="d_type" placeholder="Document Type" required>
          </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save">Save</button>
              </div>          
            </form>
        </div>
  </div>
