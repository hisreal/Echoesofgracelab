<?php
require_once("includes/header.php");
require_once("includes/top-bar.php");
require_once("includes/nav-bar.php");
                               
 $pid = $_GET['pid'] ?? null;
$FetchPatient = null;

if ($pid !== null) {
    $stmt = $conn->prepare('SELECT * FROM user_info WHERE pid = ? LIMIT 1');
    if ($stmt) {
        $stmt->bind_param('s', $pid);
        $stmt->execute();
        $PatientResult = $stmt->get_result();
        $FetchPatient = $PatientResult->fetch_assoc();
        $stmt->close();
    }
}

$patientName = $FetchPatient['patient_name'] ?? 'Patient';
$Gender      = $FetchPatient['sex'] ?? null;
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
                           <?php echo'<form action="includes/updator.php" autocomplete="off" method="POST">
																	<div class="row">
																	<input type="hidden" name="pid" value="'.$FetchPatient['pid'].'" >
																		<div class="col-md-5 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Lab No</label>
																				<input type="text"  name="lab_no" value="'.$FetchPatient['labno'].'" class="form-control">
																			</div>
																		</div>
																		<div class="col-md-5 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Patient Name</label>
																				<input type="text" name="patient_name"  value="'.$FetchPatient['patient_name'].'" class="form-control">
																			</div>
																		</div>
																		<div class="col-md-2 col-sm-12">
																		<label style="font-weight: bold">Sex</label>
																			<select name="sex" class="custom-select col-12">
																				<option selected="">'.$FetchPatient['sex'].'</option>
																				<option value="Male">Male</option>
																				<option value="Female">Female</option>
																			</select>
																		</div>
																	</div>

																<div class="row">
																	<div class="col-md-2 col-sm-12">
																		<div class="form-group">
																				<label style="font-weight: bold">Age</label>
																				<input type="text" name="age" value="'.$FetchPatient['age'].'" class="form-control">
																			</div>
																		</div>

																		<div class="col-md-5 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Consultant</label>
																				<input type="text" name="consultant"  value="'.$FetchPatient['consultant'].'" class="form-control">
																			</div>
																		</div>
																		<div class="col-md-5 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Email</label>
																				<input type="text" name="clinical_diagnosis" value="'.$FetchPatient['clinical_diagnosis'].'" class="form-control">
																			</div>
																		</div>
																	</div>

																<div class="row">
																	<div class="col-md-4 col-sm-12">
																		<div class="form-group">
																				<label style="font-weight: bold">Hospital</label>
																				<input type="text" name="hospital" value="'.$FetchPatient['hospital'].'" class="form-control">
																			</div>
																		</div>

																		<div class="col-md-4 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Nature of Sample</label>
																				<input type="text" name="nature"  value="'.$FetchPatient['nature'].'" class="form-control">
																			</div>
																		</div>
																		<div class="col-md-4 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Date Received </label>
																				<input class="form-control date-picker" name="date_receive"  value="'.$FetchPatient['date_receive'].'" type="date">
																			</div>
																		</div>
																	</div>


																	<div class="row">
																	<div class="col-md-4 col-sm-12">
																		<div class="form-group">
																				<label style="font-weight: bold">Clinical Adress</label>
																				<input type="text" name="clinical_address" value="'.$FetchPatient['clinic_address'].'" class="form-control">
																			</div>
																		</div>

																		<div class="col-md-2 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Bill</label>
																				<input type="number" name="bill" value="'.$FetchPatient['bill'].'" class="form-control">
																			</div>
																		</div>
																		<div class="col-md-2 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Amount Paid</label>
																				<input type="number" name="amount" value="'.$FetchPatient['amount'].'" class="form-control">
																			</div>
																		</div>
																		<div class="col-md-4 col-sm-12">
																			<div class="form-group">
																				<label style="font-weight: bold">Phone No.</label>
																				<input type="number" name="phone_number" value="'.$FetchPatient['phone_number'].'" class="form-control">
																			</div>
																		</div>



																		
																	</div>

																	<div class="row">
																	<div class="col-md-6 col-sm-12">
																		<div class="form-group">
																				<label style="font-weight: bold">Investigation Required</label>
																				<input type="text" name="investigation" value="'.$FetchPatient['investigation'].'" class="form-control">
																			</div>
																		</div>

																		<div class="col-md-3 col-sm-12">
																		<label style="font-weight: bold">Status</label>
																			<select name="status" class="custom-select col-12">
																				<option selected="">'.$FetchPatient['status'].'</option>
																				<option value="Paid">Paid</option>
																				<option value="Not Yet Paid">Not Yet Paid</option>
																				<option value="Deposited">Deposited</option>
																			</select>
																		</div>

																		<div class="col-md-3 col-sm-12">
																		<label style="font-weight: bold">Mode</label>
																			<select name="mode" class="custom-select col-12">
																				<option selected="">'.$FetchPatient['mode'].'</option>
																				<option value="Bank">Bank</option>
																				<option value="Cash">Cash</option>
																			</select>
																		</div>
																	</div>

																	
																<div class="modal-footer">
																	<div class="modal-footer">
																		<input type="submit" name="update_patient" class="btn btn-success" value="Save Changes" >
																	</div>
																</div>

																</form>'; ?>

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

