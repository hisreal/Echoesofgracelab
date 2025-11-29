<?php
require_once("includes/header.php");
require_once("includes/top-bar.php");
require_once("includes/nav-bar.php");
?>

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                    	<a href="./" class="btn btn-secondary">Go Back</a>
                            <br>
                            <br>
                            <form action="includes/updator.php" autocomplete="off" method="POST">
                                <div class="row">
                                    <div class="col-md-5 col-sm-10">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Lab No</label>
                                            <input type="text" required name="lab_no" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Patient Name</label>
                                            <input type="text" required name="patient_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Sex</label>
                                            <select required name="sex" class="custom-select col-12">
                                                <option selected disabled>Choose...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- .row -->

                                <div class="row">
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Age</label>
                                            <input type="text" required name="age" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Consultant</label>
                                            <input type="text" name="consultant" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Email</label>
                                            <input type="text"  name="clinical_diagnosis" class="form-control">
                                        </div>
                                    </div>
                                </div><!-- .row -->

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Hospital</label>
                                            <input type="text" name="hospital" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Nature of Sample</label>
                                            <input type="text" required name="nature" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Date Received</label>
											 <input class="form-control" required id="example-date" type="date"
                                                        name="date_receive">
                                        </div>
                                    </div>
                                </div><!-- .row -->

                                <input type="hidden" name="branch" value="<?php echo htmlspecialchars($branch ?? '', ENT_QUOTES); ?>">

                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Clinical Address</label>
                                            <input type="text" name="clinical_address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Phone Number</label>
                                            <input type="number" required name="phone_number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: bold">Investigation Required</label>
                                            <input type="text" required name="investigation" class="form-control">
                                        </div>
                                    </div>
                                </div><!-- .row -->

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="submit" name="patient_reg" class="btn btn-success">
                                        Save Changes
                                    </button>
                                </div>

                            </form>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-md-8 -->
            </div><!-- end row -->

        </div><!-- end container-fluid -->

    </div><!-- end content -->
</div><!-- end content-page -->

<?php require_once("includes/footer.php"); ?>

<!-- DataTables + Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

