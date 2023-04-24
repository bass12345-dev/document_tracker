<div class="modal fade" id="update_flow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Office</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="update_department_flow">
          <div class="col-12">
            <label for="inputAddress" class="form-label">Search Office</label>
            <input type="hidden" name="update_flow_id">
             <input type="hidden" name="update_type_id">
            <input class="form-control"  type="text" name="search_department1" placeholder="Search Department" value=""  />
                                            <input type="hidden" name="department_id1">
          </div>
         
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save1">Update</button>
              </div>          
            </form>
      </div>
    </div>
  </div>
</div>