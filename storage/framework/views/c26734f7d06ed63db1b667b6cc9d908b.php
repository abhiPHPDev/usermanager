
<?php $__env->startSection('cssFiles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-end mb-5">
  <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageuserrole">
        <i class="bi bi-person-plus"></i>&nbsp;Add New role
    </a>
</div>
  <div class="row">
    <div class="col-12">
      <div class="card bg-light" >
        <div class="card-body"> 
          <h5 class="card-title">Staff Roles</h5>
          <div class="table-responsive m-t-40">
            <table id="dataTable" class="display nowrap table " cellspacing="0" width="100%"></table>
          </div>
        </div>
      </div>
    </div>
  </div> 
<!-- Modal -->
<div class="modal fade" id="manageuserrole" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Manage Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:saveuserrole()" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="id" value="" />
                <div class="modal-body">
                    <div class="row  mb-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="role">Role<sup class="text-danger">**</sup></label>
                                <input type="text" class="form-control" id="role" name="role" placeholder="Enter role"
                                    value="" required>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsFiles'); ?>
<script type="text/javascript">
  var callDataTable =function(){
    var queryData=[];
    queryData = {'requestURL':'roles-list'};
    var columns =[
      { "title": "Role", "name": "role","search":{"regex":true},  "targets": 0 },
      
      { "title":"", "name": "Action",  "sortable" : false, "targets":1}, 
      {
          "targets": [0,1],   // target column
          "className": "text-start word-wrap", 
        }
    ];
    createDataTable('#dataTable',queryData,columns);
  }
  $(document).ready(function(){
    callDataTable();
  });   


  const saveuserrole = function () {
    //alert("")
        let formData = new FormData($('#manageuserrole form')[0]);
        $.ajax({
            url: APP_URL+'/storerole',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.success) {
                    showToastAlert('success', response.msg);
                    $('#manageuserrole').modal('hide');
                    $("table").DataTable().ajax.reload(null, false);
                } else {
                    showToastAlert('error', response.msg);
                }
            }
        });
    }


  const editrole =function(userid){
        $.ajax({
        type: "POST",
        url: APP_URL + '/getroledetail',
        data: {id:userid},
        dataType: 'json',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            if(response.success){
                $("#manageuserrole").find('#role').val(response.data.role);
                $("#manageuserrole").find('#id').val(response.data.id);
                
                $("#manageuserrole").modal('show');
            }else{
                showToastAlert('error', response.msg);
            }
            $("form").find('.submitButton').removeAttr('disabled');
            $(".preloader").addClass('d-none');

            if (typeof callback === 'function')
                callback.apply(this, [response]);
        }
    });
    }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts._layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\old\test\crossover\resources\views/roles/list.blade.php ENDPATH**/ ?>