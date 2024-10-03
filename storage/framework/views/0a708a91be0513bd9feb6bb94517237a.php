<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="<?php echo e(asset('plugins/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css?v=' . time())); ?>" rel="stylesheet"
    type="text/css">
<link href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css?v=' . time())); ?>" rel="stylesheet"
    type="text/css">
<link href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.searchHighlight.css?v=' . time())); ?>" rel="stylesheet"
    type="text/css">
<link href="<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css?v=' . time())); ?>" rel="stylesheet"
    type="text/css">
<link href="<?php echo e(asset('plugins/datatables-bs4/css/fixedHeader.dataTables.min.css?v=' . time())); ?>" rel="stylesheet"
    type="text/css">
    <?php echo $__env->yieldContent('cssFiles'); ?>
    <script type="text/javascript">
        var APP_URL = <?php echo json_encode(url('/')); ?>;
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
        <div class="container">
            <a class="navbar-brand" href="#">Usermanager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo e(route('users')); ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('staff-roles')); ?>">User Roles</a>
                    </li> 
                </ul>
                 
            </div>
        </div>
    </nav>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
        <div aria-live="polite" aria-atomic="true">
            <div class="toast-container position-absolute p-3" id="toast-container" style="z-index:9;"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('plugins/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js?v=' . time())); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/jszip/jszip.min.js?v=' . time())); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/pdfmake/pdfmake.min.js?v=' . time())); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/pdfmake/vfs_fonts.js?v=' . time())); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.print.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.searchHighlight.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-bs4/js/jquery.highlight.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-buttons/js/buttons.colVis.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.fixedHeader.min.js?v=' . time())); ?>"
        type="text/javascript"></script>
    <?php echo $__env->yieldContent(section: 'jsFiles'); ?>


</body>

</html><?php /**PATH G:\xampp\htdocs\old\test\crossover\resources\views/layouts/_layout.blade.php ENDPATH**/ ?>