<?php
require_once("includes/header.php");
require_once("includes/top-bar.php");
require_once("includes/nav-bar.php");
?>


        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                     <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layout</a></li>
                                        <li class="breadcrumb-item active">Lite Sidebar</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                         <div class="col-xxl-3 col-sm-3">
                            <div class="card widget-flat text-bg-primary">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-group-2-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Total Patients</h6>
                                    <h2 class="my-2"><?php echo $TotalUsers; ?></h2>
                                    <p class="mb-0">
                                        <span class="badge bg-white bg-opacity-10 me-1">8.21%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-xxl-3 col-sm-3">
                            <div class="card widget-flat text-bg-info">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-draft-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Uncompleted Result</h6>
                                    <h2 class="my-2"><?php echo $TotalUnprinted; ?></h2>
                                    <p class="mb-0">
                                        <!--<span class="badge bg-white bg-opacity-25 me-1">-5.75%</span>
                                        <span class="text-nowrap">Since last month</span>-->
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end col-->
                         <div class="col-xxl-3 col-sm-3">
                            <div class="card widget-flat text-bg-purple">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-wallet-2-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Total Revenue</h6>
                                    <h2 class="my-2">Coming Soon</h2>
                                    <p class="mb-0">
                                        <!--<span class="badge bg-white bg-opacity-10 me-1">18.25%</span>
                                        <span class="text-nowrap">Since last month</span>-->
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end col-->
                        <div class="col-xxl-3 col-sm-3">
                            <div class="card widget-flat text-bg-pink">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-eye-line widget-icon"></i>
                                    </div>
                                    <h6 class="text-uppercase mt-0" title="Customers">Total Expenses</h6>
                                    <h2 class="my-2">Coming Soon</h2>
                                    <p class="mb-0">
                                        <!--<span class="badge bg-white bg-opacity-10 me-1">2.97%</span>
                                        <span class="text-nowrap">Since last month</span>-->
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end col-->

                       

                        

                       
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                 
                                <div class="card-header">
                                   <?php
                                if (isset($_GET['msg'])) {
                                    switch ($_GET['msg']) {
                                        case 'registered':
                                            echo '<div class="alert alert-info alert-dismissible border-0 fade show" role="alert">
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                                                    You have successfully registered a patient
                                                </div>';
                                            break;

                                        case 'updated':
                                            echo '<div class="alert alert-primary alert-dismissible border-0 fade show" role="alert">
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                                                    You have successfully updated the user information
                                                </div>';
                                            break;
                                    }
                                }
                                ?>

                                </div>
                                <div class="card-body">
                                    <table id="patientsTable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lab No</th>
                                                <th>Patient Name</th>
                                                <th>Investigation</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DataTables will populate this -->
                                        </tbody>
                                    </table>
                             </div>

                            </div> <!-- end container-fluid -->

                        </div> <!-- end content -->
                    </div> <!-- end content-page -->
                </div>
            </div>
        </div>
</div>

<?php require_once("includes/footer.php"); ?>

<!-- --------------------------- -->
<!-- DataTables + Bootstrap 5 -->
<!-- --------------------------- -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#patientsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "includes/fetch_user.php",
        order: [[0, 'desc']],
        columns: [
            { data: 'sn' },
            { data: 'labno' },
            { data: 'fullname' },
            { data: 'investigation' },
            { data: 'date' },
            { data: 'status', orderable: false, searchable: false },
            { data: 'actions', orderable: false, searchable: false }
        ],
        lengthMenu: [10, 25, 50, 100],
        pageLength: 10,
        language: {
            search: "Search patients:",
            lengthMenu: "Show _MENU_ entries per page",
            zeroRecords: "No matching records found",
            info: "Showing _START_ to _END_ of _TOTAL_ patients",
            infoEmpty: "No patients available",
            infoFiltered: "(filtered from _MAX_ total patients)"
        }
    });
});
</script>
