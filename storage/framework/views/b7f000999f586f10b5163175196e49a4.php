<?php $__env->startSection('cssFiles'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-end">
    <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageuser">
        <i class="bi bi-person-plus"></i>&nbsp;Add New User
    </a>
</div>
<div class="row py-4 px-2">
    <div class="col-12">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">All Staff</h5>
                <div class="table-responsive m-t-40">
                    <table id="dataTable" class="display nowrap table " cellspacing="0" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="manageuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Manage User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:saveuserdetails()" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="id" value="" />
                <div class="modal-body">
                    <div class="row  mb-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name<sup class="text-danger">**</sup></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                    value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="email">Email<sup class="text-danger">**</sup></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="mobile">Mobile<sup class="text-danger">**</sup></label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="Enter mobile" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row  mb-2">
                        <div class="col-md-6 col-sm-12 mb-2">
                            <div class="form-group">
                                <label for="role">Role<sup class="text-danger">**</sup></label>
                                <select name="role_id" class="form-control" id="role">
                                    <option value="">Select Role</option>
                                    <?php $__currentLoopData = $data['allRoles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aR): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                        <option value="<?php echo e($aR->id); ?>"><?php echo e(ucwords($aR->role)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12  mb-2">
                            <div class="form-group">
                                <label for="photo">Profile Photo</label>
                                <input class="form-control" type="file" id="photo" name="photo"
                                    accept="image/jpg,image/jpeg,image/png,image/gif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="desc">About</label>
                            <textarea name="desc" id="desc" class="form-control" rows="2"
                                placeholder="Enter about yourself"></textarea>
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
<script>
    const callDataTable = function () {
        let queryData = [];
        queryData = { 'requestURL': 'list' };
        let columns = [
            { "title": "", "name": "Action", "sortable": false, "targets": 0 },
            { "title": "Photo", "name": "id", "sortable": true, "targets": 1 },
            { "title": "Name", "name": "name", "search": { "regex": true }, "targets": 2 },
            { "title": "Email", "name": "email", "search": { "regex": true }, "targets": 3 },
            { "title": "Mobile", "name": "mobile", "search": { "regex": true }, "targets": 4 },
            { "title": "Role", "name": "role", "search": { "regex": true }, "targets": 5 },
        ];
        createDataTable('#dataTable', queryData, columns);
    }
    $(document).ready(function () {
        callDataTable();
    });

    const saveuserdetails = function () {
        let formData = new FormData($('#manageuser form')[0]);
        $.ajax({
            url: APP_URL + '/store',
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
                    $('#manageuser').modal('hide');
                    $("table").DataTable().ajax.reload(null, false);
                } else {
                    showToastAlert('error', response.msg);
                }
            }
        });
    }

    const edituser =function(userid){
        $.ajax({
        type: "POST",
        url: APP_URL + '/getuserdetail',
        data: {id:userid},
        dataType: 'json',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            if(response.success){
                $("#manageuser").find('#name').val(response.data.name);
                $("#manageuser").find('#email').val(response.data.email);
                $("#manageuser").find('#mobile').val(response.data.mobile);
                $("#manageuser").find('#role').val(response.data.role_id);
                $("#manageuser").find('#desc').val(response.data.description);
                $("#manageuser").find('#id').val(response.data.id);

                if(response.data.profile_photo){

                    $("#manageuser").find('#photo').after('<img src="'+APP_URL+'/'+response.data.profile_photo+'" class="img-thumbnail" alt="" />');
                }
                $("#manageuser").modal('show');
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
<?php echo $__env->make('layouts._layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\old\test\crossover\resources\views/users.blade.php ENDPATH**/ ?>