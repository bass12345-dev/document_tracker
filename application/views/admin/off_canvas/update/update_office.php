    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Update Office</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
        <div class="offcanvas-body">
             <form class="row g-3" id="update_office_form">
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Office</label>
                  <input type="text" class="form-control"  name="update_office_name"  required>
                   <input type="hidden" class="form-control"  name="office_id"  required>
                </div>
                <div class="col-12">
                  <label for="inputState" class="form-label">Status</label>
                   <select id="inputState" class="form-select" name="update_status" >
                    <option selected="" value="" disabled="">Select Status:</option>
                    <option value="active">Active</option>
                     <option value="inactive">Inactive</option>
                  </select>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary update">Update</button>
              </div>          
            </form>
        </div>
  </div>
