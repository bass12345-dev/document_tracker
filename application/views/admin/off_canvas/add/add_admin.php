    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Add Administrator</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
        <div class="offcanvas-body">
             <form class="row g-3" id="add_admin_form">
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Search User</label>
                  <input type="text" class="form-control"  name="search_user" placeholder="User" required>
                  <input type="hidden" class="form-control"  name="user_id" >
                </div>
               
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary add">Add</button>
              </div>          
            </form>
        </div>
  </div>
