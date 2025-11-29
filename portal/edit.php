<?php
require_once("includes/header.php");
require_once("includes/top-bar.php");
require_once("includes/nav-bar.php");

$pid = null;
$FetchPatient = null;

// result arrays default to null
$heamatology     = null;
$diffCount       = null;
$heightWeight    = null;
$mcs             = null;
$urinalysis      = null;
$widal           = null;
$enzymes         = null;
$lft             = null;
$elect           = null;
$lipid           = null;
$others          = null;
$psa             = null;
$thyroid         = null;
$infert          = null;
$coagulation     = null;
$antiBio         = null;
$generalMsg      = null;

if (isset($_GET['pid'])) {
    $pid = mysqli_real_escape_string($conn, $_GET['pid']);

    // patient header info
    $PatientStmt   = "SELECT * FROM user_info WHERE pid='{$pid}' LIMIT 1";
    $PatientResult = mysqli_query($conn, $PatientStmt);
    $FetchPatient  = mysqli_fetch_assoc($PatientResult);

    // Heamatology
    $res = mysqli_query($conn, "SELECT * FROM heamatology WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $heamatology = mysqli_fetch_assoc($res);
    }

    // Differentiate count
    $res = mysqli_query($conn, "SELECT * FROM diff_count WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $diffCount = mysqli_fetch_assoc($res);
    }

    // Height weight hip waist
    $res = mysqli_query($conn, "SELECT * FROM height_weight WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $heightWeight = mysqli_fetch_assoc($res);
    }

    // M C S
    $res = mysqli_query($conn, "SELECT * FROM mcs WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $mcs = mysqli_fetch_assoc($res);
    }

    // Urinalysis
    $res = mysqli_query($conn, "SELECT * FROM urinalysis WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $urinalysis = mysqli_fetch_assoc($res);
    }

    // Widal
    $res = mysqli_query($conn, "SELECT * FROM widal WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $widal = mysqli_fetch_assoc($res);
    }

    // Enzymes
    $res = mysqli_query($conn, "SELECT * FROM enzymes WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $enzymes = mysqli_fetch_assoc($res);
    }

    // Liver function
    $res = mysqli_query($conn, "SELECT * FROM lft WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $lft = mysqli_fetch_assoc($res);
    }

    // Electrolytes
    $res = mysqli_query($conn, "SELECT * FROM elect WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $elect = mysqli_fetch_assoc($res);
    }

    // Lipid profile
    $res = mysqli_query($conn, "SELECT * FROM lipid_profile WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $lipid = mysqli_fetch_assoc($res);
    }

    // Others
    $res = mysqli_query($conn, "SELECT * FROM others WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $others = mysqli_fetch_assoc($res);
    }

    // PSA
    $res = mysqli_query($conn, "SELECT * FROM psa WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $psa = mysqli_fetch_assoc($res);
    }

    // Thyroid
    $res = mysqli_query($conn, "SELECT * FROM thyroid WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $thyroid = mysqli_fetch_assoc($res);
    }

    // Infertility
    $res = mysqli_query($conn, "SELECT * FROM infert WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $infert = mysqli_fetch_assoc($res);
    }

    // Coagulation
    $res = mysqli_query($conn, "SELECT * FROM coagulation WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $coagulation = mysqli_fetch_assoc($res);
    }

    // Anti biotics
    $res = mysqli_query($conn, "SELECT * FROM anti_bio WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $antiBio = mysqli_fetch_assoc($res);
    }

    // Additional result general message
    $res = mysqli_query($conn, "SELECT * FROM general_msg WHERE pid='{$pid}' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $generalMsg = mysqli_fetch_assoc($res);
    }
}
?>

<!-- Start Page Content here -->
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
<a href="index.php" class="btn btn-secondary">Go Back</a>
                                <br>
                                <br>
                            <style>
                                .section-header {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    margin-top: 20px;
                                    margin-bottom: 10px;
                                }
                                .section-header .mb-30.h4 {
                                    margin-bottom: 0;
                                }
                                .section-header .custom-control {
                                    margin: 0;
                                }
                                .section-content {
                                    margin-bottom: 15px;
                                }
                            </style>

                            <div style="border: 2px solid black">
                                <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                    <table class="table">
                                        <tr>
                                            <td width="40%">
                                                <b>Name:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['patient_name'] ?? ''); ?>
                                            </td>
                                            <td width="10%">
                                                <b>Age:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['age'] ?? ''); ?>
                                            </td>
                                            <td width="10%">
                                                <b>Sex:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['sex'] ?? ''); ?>
                                            </td>
                                            <td width="40%">
                                                <b>Consultant:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['consultant'] ?? ''); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <b>Clinical Diagnostics:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['clinical_diagnosis'] ?? ''); ?>
                                            </td>
                                            <td width="15%">
                                                <b>Clinic No:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['clinical_number'] ?? ''); ?>
                                            </td>
                                            <td width="40%">
                                                <b>Hospital Clinic:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['hospital'] ?? ''); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%">
                                                <b>Nature of Specimen:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['nature'] ?? ''); ?>
                                            </td>
                                            <td width="15%">
                                                <b>Lab No:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['labno'] ?? ''); ?>
                                            </td>
                                            <td width="15%">
                                                <b>Date Received:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['date_receive'] ?? ''); ?>
                                            </td>
                                            <td width="30%">
                                                <b>Clinic Address:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['clinic_address'] ?? ''); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <b>Investigation Required:</b>
                                                &nbsp;<?php echo htmlspecialchars($FetchPatient['investigation'] ?? ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <form action="includes/result.inc.php" method="POST">
                                <input type="hidden" name="pid" value="<?php echo htmlspecialchars($pid ?? ''); ?>">

                              <!-- Heamatology -->
<div class="section-header">
    <div class="mb-30 h4">Heamatology</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="first"
               class="custom-control-input"
               id="customCheck1"
               data-target="#section-heamatology"
               <?php echo !empty($heamatology) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck1">
            Enter Heamatology Result
        </label>
    </div>
</div>
<div id="section-heamatology"
     class="section-content"
     style="<?php echo !empty($heamatology) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="hb" class="col-form-label">Hb</label>
                <input class="form-control" type="text" name="hb" id="hb"
                       value="<?php echo htmlspecialchars($heamatology['hb'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pcv" class="col-form-label">PCV</label>
                <input class="form-control" type="text" name="pcv" id="pcv"
                       value="<?php echo htmlspecialchars($heamatology['pcv'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="wbc" class="col-form-label">WBC</label>
                <input class="form-control" type="text" name="wbc" id="wbc"
                       value="<?php echo htmlspecialchars($heamatology['wbc'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="plate" class="col-form-label">Platelets</label>
                <input class="form-control" type="text" name="plate" id="plate"
                       value="<?php echo htmlspecialchars($heamatology['plate'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="esr" class="col-form-label">ESR</label>
                <input class="form-control" type="text" name="esr" id="esr"
                       value="<?php echo htmlspecialchars($heamatology['esr'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="microf" class="col-form-label">Microfilaria</label>
                <input class="form-control" type="text" name="microf" id="microf"
                       value="<?php echo htmlspecialchars($heamatology['microf'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>


                                <!-- Differentiate Count -->
                               <div class="section-header">
    <div class="mb-30 h4">Differentiate Count</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="second"
               class="custom-control-input"
               id="customCheck2"
               data-target="#section-diffcount"
               <?php echo !empty($diffCount) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck2">
            Enter Differentiate Count Result
        </label>
    </div>
</div>
<div id="section-diffcount"
     class="section-content"
     style="<?php echo !empty($diffCount) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="neu" class="col-form-label">Neutrophils</label>
                <input class="form-control" type="text" name="neu" id="neu"
                       value="<?php echo htmlspecialchars($diffCount['neu'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="lym" class="col-form-label">Lymphocytes</label>
                <input class="form-control" type="text" name="lym" id="lym"
                       value="<?php echo htmlspecialchars($diffCount['lym'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="mono" class="col-form-label">Monocytes</label>
                <input class="form-control" type="text" name="mono" id="mono"
                       value="<?php echo htmlspecialchars($diffCount['mono'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="eosi" class="col-form-label">Eosinophils</label>
                <input class="form-control" type="text" name="eosi" id="eosi"
                       value="<?php echo htmlspecialchars($diffCount['eosi'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="baso" class="col-form-label">Basophils</label>
                <input class="form-control" type="text" name="baso" id="baso"
                       value="<?php echo htmlspecialchars($diffCount['baso'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-12 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="c_fbc" class="col-form-label">Comment</label>
                <input class="form-control" type="text" name="c_fbc" id="c_fbc"
                       value="<?php echo htmlspecialchars($diffCount['c_fbc'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>

                              

                                <!-- Height Weight Hip Waist -->
                               <div class="section-header">
    <div class="mb-30 h4">Height, Weight, Hip and Waist</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="twenty"
               class="custom-control-input"
               id="customCheck20"
               data-target="#section-bodymeasure"
               <?php echo !empty($heightWeight) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck20">
            Height, Weight, Hip and Waist
        </label>
    </div>
</div>
<div id="section-bodymeasure"
     class="section-content"
     style="<?php echo !empty($heightWeight) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="height" class="col-form-label">Height</label>
                <input class="form-control" type="text" name="height" id="height"
                       value="<?php echo htmlspecialchars($heightWeight['height'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="weight" class="col-form-label">Weight</label>
                <input class="form-control" type="text" name="weight" id="weight"
                       value="<?php echo htmlspecialchars($heightWeight['weight'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="hip" class="col-form-label">Hips</label>
                <input class="form-control" type="text" name="hip" id="hip"
                       value="<?php echo htmlspecialchars($heightWeight['hip'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="waist" class="col-form-label">Waist</label>
                <input class="form-control" type="text" name="waist" id="waist"
                       value="<?php echo htmlspecialchars($heightWeight['waist'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>

                              

                                <!-- M C S -->
                               <div class="section-header">
    <div class="mb-30 h4">M C S</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="fouth"
               class="custom-control-input"
               id="customCheck4"
               data-target="#section-mcs"
               <?php echo !empty($mcs) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck4">
            Enter M C S Result
        </label>
    </div>
</div>
<div id="section-mcs"
     class="section-content"
     style="<?php echo !empty($mcs) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="epim" class="col-form-label">Epithelia</label>
                <input class="form-control" type="text" name="epim" id="epim"
                       value="<?php echo htmlspecialchars($mcs['epi'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pusm" class="col-form-label">Pus cells</label>
                <input class="form-control" type="text" name="pusm" id="pusm"
                       value="<?php echo htmlspecialchars($mcs['pus'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="rbcm" class="col-form-label">RBC</label>
                <input class="form-control" type="text" name="rbcm" id="rbcm"
                       value="<?php echo htmlspecialchars($mcs['rbc'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="calm" class="col-form-label">Calcium</label>
                <input class="form-control" type="text" name="calm" id="calm"
                       value="<?php echo htmlspecialchars($mcs['cal'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="yeast" class="col-form-label">Yeast</label>
                <input class="form-control" type="text" name="yeast" id="yeast"
                       value="<?php echo htmlspecialchars($mcs['yeast'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="crys" class="col-form-label">Crystals</label>
                <input class="form-control" type="text" name="crys" id="crys"
                       value="<?php echo htmlspecialchars($mcs['crys'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="o_mcs" class="col-form-label">Others</label>
                <input class="form-control" type="text" name="o_mcs" id="o_mcs"
                       value="<?php echo htmlspecialchars($mcs['o_mcs'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-6">
            <div class="form-group">
                <label for="culture" class="col-form-label">Culture</label>
                <input class="form-control" type="text" name="culture" id="culture"
                       value="<?php echo htmlspecialchars($mcs['culture'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-6">
            <div class="form-group">
                <label for="appearance_mcs" class="col-form-label">Appearance</label>
                <input class="form-control" type="text" name="appearance" id="appearance_mcs"
                       value="<?php echo htmlspecialchars($mcs['appearance'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>

                             


                               <div class="section-header">
    <div class="mb-30 h4">Urinalysis</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="fifth"
               class="custom-control-input"
               id="customCheck5"
               data-target="#section-urinalysis"
               <?php echo !empty($urinalysis) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck5">
            Enter Urinalysis Result
        </label>
    </div>
</div>
<div id="section-urinalysis"
     class="section-content"
     style="<?php echo !empty($urinalysis) ? '' : 'display:none;'; ?>">
    <div class="row">
        <!-- example of a few fields -->
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ph" class="col-form-label">PH</label>
                <input class="form-control" type="text" name="ph" id="ph"
                       value="<?php echo htmlspecialchars($urinalysis['ph'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="gluc" class="col-form-label">Glucose</label>
                <input class="form-control" type="text" name="gluc" id="gluc"
                       value="<?php echo htmlspecialchars($urinalysis['gluc'] ?? ''); ?>">
            </div>
        </div>
         <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="asco" class="col-form-label">Ascorbic Acid</label>
                <input class="form-control" type="text" name="asco" id="asco"
                       value="<?php echo htmlspecialchars($urinalysis['asco'] ?? ''); ?>">
            </div>
        </div>
           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pro" class="col-form-label">Protein</label>
                <input class="form-control" type="text" name="pro" id="pro"
                       value="<?php echo htmlspecialchars($urinalysis['pro'] ?? ''); ?>">
            </div>
        </div>  
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="epi" class="col-form-label">Epithelia</label>
                <input class="form-control" type="text" name="epi" id="epi"
                       value="<?php echo htmlspecialchars($urinalysis['epi'] ?? ''); ?>">
            </div>
        </div> 
         <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pus" class="col-form-label">Pus cells</label>
                <input class="form-control" type="text" name="pus" id="pus"
                       value="<?php echo htmlspecialchars($urinalysis['pus'] ?? ''); ?>">
            </div>
        </div>      
         <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="rbc" class="col-form-label">RBC</label>
                <input class="form-control" type="text" name="rbc" id="rbc"
                       value="<?php echo htmlspecialchars($urinalysis['rbc'] ?? ''); ?>">
            </div>
        </div>  
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="bact" class="col-form-label">Bacteria</label>
                <input class="form-control" type="text" name="bact" id="bact"
                       value="<?php echo htmlspecialchars($urinalysis['bact'] ?? ''); ?>">
            </div>
        </div> 
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="cast" class="col-form-label">Casts</label>
                <input class="form-control" type="text" name="cast" id="cast"
                       value="<?php echo htmlspecialchars($urinalysis['cast'] ?? ''); ?>">
            </div>
        </div>  
         <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="sg" class="col-form-label">S.G</label>
                <input class="form-control" type="text" name="sg" id="sg"
                       value="<?php echo htmlspecialchars($urinalysis['sg'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="bil" class="col-form-label">Bilirubin</label>
                <input class="form-control" type="text" name="bil" id="bil"
                       value="<?php echo htmlspecialchars($urinalysis['bil'] ?? ''); ?>">
            </div>
        </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="uro" class="col-form-label">Urobilinogen</label>
                <input class="form-control" type="text" name="uro" id="uro"
                       value="<?php echo htmlspecialchars($urinalysis['uro'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="blood" class="col-form-label">Blood</label>
                <input class="form-control" type="text" name="blood" id="blood"
                       value="<?php echo htmlspecialchars($urinalysis['blood'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ket" class="col-form-label">Ketone</label>
                <input class="form-control" type="text" name="ket" id="ket"
                       value="<?php echo htmlspecialchars($urinalysis['ket'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="nit" class="col-form-label">Nitrite</label>
                <input class="form-control" type="text" name="nit" id="nit"
                       value="<?php echo htmlspecialchars($urinalysis['nit'] ?? ''); ?>">
            </div>
        </div>
         <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="leu" class="col-form-label">Leukocytes</label>
                <input class="form-control" type="text" name="leu" id="leu"
                       value="<?php echo htmlspecialchars($urinalysis['leu'] ?? ''); ?>">
            </div>
        </div>
         <div class="col-lg-6 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="app" class="col-form-label">Appearance</label>
                <input class="form-control" type="text" name="app" id="app"
                       value="<?php echo htmlspecialchars($urinalysis['app'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>



                              
                              <!-- WIDAL -->
<div class="section-header">
    <div class="mb-30 h4">WIDAL</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="sixth"
               class="custom-control-input"
               id="customCheck6"
               data-target="#section-widal"
               <?php echo !empty($widal) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck6">
            Enter Widal Result
        </label>
    </div>
</div>
<div id="section-widal"
     class="section-content"
     style="<?php echo !empty($widal) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="O1" class="col-form-label">A O antigen</label>
                <input class="form-control" type="text" name="O1" id="O1"
                       value="<?php echo htmlspecialchars($widal['O1'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="O2" class="col-form-label">B O antigen</label>
                <input class="form-control" type="text" name="O2" id="O2"
                       value="<?php echo htmlspecialchars($widal['O2'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="O3" class="col-form-label">C O antigen</label>
                <input class="form-control" type="text" name="O3" id="O3"
                       value="<?php echo htmlspecialchars($widal['O3'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="O4" class="col-form-label">O antigen</label>
                <input class="form-control" type="text" name="O4" id="O4"
                       value="<?php echo htmlspecialchars($widal['O4'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="h1" class="col-form-label">A H antigen</label>
                <input class="form-control" type="text" name="h1" id="h1"
                       value="<?php echo htmlspecialchars($widal['H1'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="h2" class="col-form-label">B H antigen</label>
                <input class="form-control" type="text" name="h2" id="h2"
                       value="<?php echo htmlspecialchars($widal['H2'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="h3" class="col-form-label">C H antigen</label>
                <input class="form-control" type="text" name="h3" id="h3"
                       value="<?php echo htmlspecialchars($widal['H3'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="h4" class="col-form-label">H antigen</label>
                <input class="form-control" type="text" name="h4" id="h4"
                       value="<?php echo htmlspecialchars($widal['H4'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>


                               <!-- Enzymes -->
<div class="section-header">
    <div class="mb-30 h4">Enzymes</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="seventh"
               class="custom-control-input"
               id="customCheck7"
               data-target="#section-enzymes"
               <?php echo !empty($enzymes) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck7">
            Enter Enzymes Result
        </label>
    </div>
</div>

<div id="section-enzymes"
     class="section-content"
     style="<?php echo !empty($enzymes) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="amy" class="col-form-label">Amylase</label>
                <input class="form-control" type="text" name="amy" id="amy"
                       value="<?php echo htmlspecialchars($enzymes['amy'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="alk" class="col-form-label">Alkaline Phosphate</label>
                <input class="form-control" type="text" name="alk" id="alk"
                       value="<?php echo htmlspecialchars($enzymes['alk'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="gamma" class="col-form-label">Gamma GTP</label>
                <input class="form-control" type="text" name="gamma" id="gamma"
                       value="<?php echo htmlspecialchars($enzymes['gamma'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ast" class="col-form-label">AST</label>
                <input class="form-control" type="text" name="ast" id="ast"
                       value="<?php echo htmlspecialchars($enzymes['ast'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="alt" class="col-form-label">ALT</label>
                <input class="form-control" type="text" name="alt" id="alt"
                       value="<?php echo htmlspecialchars($enzymes['alt'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>


                              <!-- Liver Function Test -->
<div class="section-header">
    <div class="mb-30 h4">Liver Function Test</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="eighth"
               class="custom-control-input"
               id="customCheck8"
               data-target="#section-lft"
               <?php echo !empty($lft) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck8">
            Enter Liver Function Result
        </label>
    </div>
</div>

<div id="section-lft"
     class="section-content"
     style="<?php echo !empty($lft) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="bil_t" class="col-form-label">Bilirubin Total</label>
                <input class="form-control" 
                       type="text" 
                       name="bil_t" 
                       id="bil_t"
                       value="<?php echo htmlspecialchars($lft['bil_t'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="conj" class="col-form-label">Conj Bilirubin</label>
                <input class="form-control" 
                       type="text" 
                       name="conj" 
                       id="conj"
                       value="<?php echo htmlspecialchars($lft['conj'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="proteinT" class="col-form-label">Total Protein</label>
                <input class="form-control" 
                       type="text" 
                       name="proteinT" 
                       id="proteinT"
                       value="<?php echo htmlspecialchars($lft['protein'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="alb" class="col-form-label">Albumin</label>
                <input class="form-control" 
                       type="text" 
                       name="alb" 
                       id="alb"
                       value="<?php echo htmlspecialchars($lft['alb'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>

<!-- Electrolytes -->
<div class="section-header">
    <div class="mb-30 h4">Electrolytes</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="ninth"
               class="custom-control-input"
               id="customCheck9"
               data-target="#section-electrolytes"
               <?php echo !empty($elect) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck9">
            Enter Electrolytes Result
        </label>
    </div>
</div>

<div id="section-electrolytes"
     class="section-content"
     style="<?php echo !empty($elect) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pot" class="col-form-label">Potassium</label>
                <input class="form-control"
                       type="text"
                       name="pot"
                       id="pot"
                       value="<?php echo htmlspecialchars($elect['pot'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="sod" class="col-form-label">Sodium</label>
                <input class="form-control"
                       type="text"
                       name="sod"
                       id="sod"
                       value="<?php echo htmlspecialchars($elect['sod'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="chl" class="col-form-label">Chloride</label>
                <input class="form-control"
                       type="text"
                       name="chl"
                       id="chl"
                       value="<?php echo htmlspecialchars($elect['chl'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="bicar" class="col-form-label">Bicarbonate</label>
                <input class="form-control"
                       type="text"
                       name="bicar"
                       id="bicar"
                       value="<?php echo htmlspecialchars($elect['bicar'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="urea" class="col-form-label">Urea</label>
                <input class="form-control"
                       type="text"
                       name="urea"
                       id="urea"
                       value="<?php echo htmlspecialchars($elect['urea'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="creat" class="col-form-label">Creatinine</label>
                <input class="form-control"
                       type="text"
                       name="creat"
                       id="creat"
                       value="<?php echo htmlspecialchars($elect['creat'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>


                              <!-- Lipid Profile -->
<div class="section-header">
    <div class="mb-30 h4">Lipid Profile</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="tenth"
               class="custom-control-input"
               id="customCheck10"
               data-target="#section-lipid"
               <?php echo !empty($lipid) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck10">
            Enter Lipid Profile Result
        </label>
    </div>
</div>

<div id="section-lipid"
     class="section-content"
     style="<?php echo !empty($lipid) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="tc" class="col-form-label">Total Cholesterol</label>
                <input class="form-control"
                       type="text"
                       name="tc"
                       id="tc"
                       value="<?php echo htmlspecialchars($lipid['tc'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="tg" class="col-form-label">Triglycerides</label>
                <input class="form-control"
                       type="text"
                       name="tg"
                       id="tg"
                       value="<?php echo htmlspecialchars($lipid['tg'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="hdl" class="col-form-label">HDL Cholesterol</label>
                <input class="form-control"
                       type="text"
                       name="hdl"
                       id="hdl"
                       value="<?php echo htmlspecialchars($lipid['hdl'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ldl" class="col-form-label">LDL Cholesterol</label>
                <input class="form-control"
                       type="text"
                       name="ldl"
                       id="ldl"
                       value="<?php echo htmlspecialchars($lipid['ldl'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>


                              <!-- Others -->
<div class="section-header">
    <div class="mb-30 h4">Others</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="eleventh"
               class="custom-control-input"
               id="customCheck11"
               data-target="#section-others"
               <?php echo !empty($others) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck11">
            Enter Others Result
        </label>
    </div>
</div>
<div id="section-others"
     class="section-content"
     style="<?php echo !empty($others) ? '' : 'display:none;'; ?>">
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="fbs" class="col-form-label">Fasting Blood Sugar</label>
                <input class="form-control" type="text" name="fbs" id="fbs"
                       value="<?php echo htmlspecialchars($others['fbs'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="hba1c" class="col-form-label">HBA1C</label>
                <input class="form-control" type="text" name="hba1c" id="hba1c"
                       value="<?php echo htmlspecialchars($others['hba1c'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="cal" class="col-form-label">Calcium</label>
                <input class="form-control" type="text" name="cal" id="cal"
                       value="<?php echo htmlspecialchars($others['cal'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ing" class="col-form-label">Phosphate</label>
                <input class="form-control" type="text" name="ing" id="ing"
                       value="<?php echo htmlspecialchars($others['ing'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="uric" class="col-form-label">Uric Acid</label>
                <input class="form-control" type="text" name="uric" id="uric"
                       value="<?php echo htmlspecialchars($others['uric'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="hpp" class="col-form-label">2hPP</label>
                <input class="form-control" type="text" name="hpp" id="hpp"
                       value="<?php echo htmlspecialchars($others['hpp'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ferri" class="col-form-label">Ferritin</label>
                <input class="form-control" type="text" name="ferri" id="ferri"
                       value="<?php echo htmlspecialchars($others['ferri'] ?? ''); ?>">
            </div>
        </div>
    </div>
</div>


                               <!-- PSA -->
<div class="section-header">
    <div class="mb-30 h4">PSA</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="thirteen"
               class="custom-control-input"
               id="customCheck13"
               data-target="#section-psa"
               <?php echo !empty($psa) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck13">
            Enter PSA Result
        </label>
    </div>
</div>

<div id="section-psa"
     class="section-content"
     style="<?php echo !empty($psa) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="tpsa" class="col-form-label">Total PSA</label>
                <input class="form-control"
                       type="text"
                       name="tpsa"
                       id="tpsa"
                       value="<?php echo htmlspecialchars($psa['tpsa'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="fpsa" class="col-form-label">Free PSA</label>
                <input class="form-control"
                       type="text"
                       name="fpsa"
                       id="fpsa"
                       value="<?php echo htmlspecialchars($psa['fpsa'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ratio_psa" class="col-form-label">FPSA/TPSA Ratio</label>
                <input class="form-control"
                       type="text"
                       name="ratio"
                       id="ratio_psa"
                       value="<?php echo htmlspecialchars($psa['ratio'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-8 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="c_psa" class="col-form-label">Comment</label>
                <input class="form-control"
                       type="text"
                       name="c_psa"
                       id="c_psa"
                       value="<?php echo htmlspecialchars($psa['c_psa'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>


                           <!-- Thyroid -->
<div class="section-header">
    <div class="mb-30 h4">Thyroid</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="fourteen"
               class="custom-control-input"
               id="customCheck14"
               data-target="#section-thyroid"
               <?php echo !empty($thyroid) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck14">
            Enter Thyroid Result
        </label>
    </div>
</div>

<div id="section-thyroid"
     class="section-content"
     style="<?php echo !empty($thyroid) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="fT3" class="col-form-label">fT3</label>
                <input class="form-control"
                       type="text"
                       name="fT3"
                       id="fT3"
                       value="<?php echo htmlspecialchars($thyroid['fT3'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="fT4" class="col-form-label">fT4</label>
                <input class="form-control"
                       type="text"
                       name="fT4"
                       id="fT4"
                       value="<?php echo htmlspecialchars($thyroid['fT4'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="TSH" class="col-form-label">TSH</label>
                <input class="form-control"
                       type="text"
                       name="TSH"
                       id="TSH"
                       value="<?php echo htmlspecialchars($thyroid['TSH'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-8 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="c_thyroid" class="col-form-label">Comment</label>
                <input class="form-control"
                       type="text"
                       name="c_thyroid"
                       id="c_thyroid"
                       value="<?php echo htmlspecialchars($thyroid['c_thyroid'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>

<!-- Infertility -->
<div class="section-header">
    <div class="mb-30 h4">Infertility</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="fifteen"
               class="custom-control-input"
               id="customCheck15"
               data-target="#section-infertility"
               <?php echo !empty($infert) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck15">
            Enter Infert Result
        </label>
    </div>
</div>

<div id="section-infertility"
     class="section-content"
     style="<?php echo !empty($infert) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="fsh" class="col-form-label">FSH</label>
                <input class="form-control"
                       type="text"
                       name="fsh"
                       id="fsh"
                       value="<?php echo htmlspecialchars($infert['fsh'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="lh" class="col-form-label">LH</label>
                <input class="form-control"
                       type="text"
                       name="lh"
                       id="lh"
                       value="<?php echo htmlspecialchars($infert['lh'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="prolactin" class="col-form-label">Prolactin</label>
                <input class="form-control"
                       type="text"
                       name="prolactin"
                       id="prolactin"
                       value="<?php echo htmlspecialchars($infert['prolactin'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="progest" class="col-form-label">Progesterone</label>
                <input class="form-control"
                       type="text"
                       name="progest"
                       id="progest"
                       value="<?php echo htmlspecialchars($infert['progest'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="oesf" class="col-form-label">Oestradol</label>
                <input class="form-control"
                       type="text"
                       name="oesf"
                       id="oesf"
                       value="<?php echo htmlspecialchars($infert['oesf'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="oesm" class="col-form-label">Oestrogen</label>
                <input class="form-control"
                       type="text"
                       name="oesm"
                       id="oesm"
                       value="<?php echo htmlspecialchars($infert['oesm'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="test" class="col-form-label">Testosterone</label>
                <input class="form-control"
                       type="text"
                       name="test"
                       id="test"
                       value="<?php echo htmlspecialchars($infert['test'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-8 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="c_infert" class="col-form-label">Comment</label>
                <input class="form-control"
                       type="text"
                       name="c_infert"
                       id="c_infert"
                       value="<?php echo htmlspecialchars($infert['c_infert'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>

                             
<!-- Coagulation -->
<div class="section-header">
    <div class="mb-30 h4">Coagulation</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="eighteen"
               class="custom-control-input"
               id="customCheck18"
               data-target="#section-coagulation"
               <?php echo !empty($coagulation ) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck18">
            Enter Coagulation Result
        </label>
    </div>
</div>

<div id="section-coagulation"
     class="section-content"
     style="<?php echo !empty($coagulation) ? '' : 'display:none;'; ?>">
    <div class="row">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pt" class="col-form-label">Prothrombin Time</label>
                <input class="form-control"
                       type="text"
                       name="pt"
                       id="pt"
                       value="<?php echo htmlspecialchars($coagulation['pt'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="cont1" class="col-form-label">Control</label>
                <input class="form-control"
                       type="text"
                       name="cont1"
                       id="cont1"
                       value="<?php echo htmlspecialchars($coagulation['cont1'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="ratio_coag" class="col-form-label">Ratio</label>
                <input class="form-control"
                       type="text"
                       name="ratio"
                       id="ratio_coag"
                       value="<?php echo htmlspecialchars($coagulation['ratio'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="inr" class="col-form-label">INR</label>
                <input class="form-control"
                       type="text"
                       name="inr"
                       id="inr"
                       value="<?php echo htmlspecialchars($coagulation['inr'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="pttk" class="col-form-label">PTTK</label>
                <input class="form-control"
                       type="text"
                       name="pttk"
                       id="pttk"
                       value="<?php echo htmlspecialchars($coagulation['pttk'] ?? ''); ?>">
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="cont2" class="col-form-label">Control</label>
                <input class="form-control"
                       type="text"
                       name="cont2"
                       id="cont2"
                       value="<?php echo htmlspecialchars($coagulation['cont2'] ?? ''); ?>">
            </div>
        </div>

    </div>
</div>



                               <!-- Additional Result -->
<div class="section-header">
    <div class="mb-30 h4">Additional Result</div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               name="general-btn"
               class="custom-control-input"
               id="customCheck40"
               data-target="#section-additional"
               <?php echo !empty($generalMsg) ? 'checked' : ''; ?>>
        <label class="custom-control-label" style="color: red; font-weight: bold" for="customCheck40">
            Additional Result
        </label>
    </div>
</div>

<div id="section-additional"
     class="section-content"
     style="<?php echo !empty($generalMsg) ? '' : 'display:none;'; ?>">

    <div class="html-editor pd-20 card-box mb-30">
        <textarea name="general_msg"
                  class="textarea_editor form-control border-radius-0"
                  placeholder="Enter text ..."><?php echo htmlspecialchars($generalMsg['general_msg'] ?? ''); ?></textarea>
    </div>

</div>

                                <center>
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                        Submit
                                    </button>
                                </center>
                                <br><br><br>
                            </form>

                            <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var toggles = document.querySelectorAll('.custom-control-input[data-target]');

                                toggles.forEach(function (toggle) {
                                    var targetSelector = toggle.getAttribute('data-target');
                                    var target = document.querySelector(targetSelector);
                                    if (!target) {
                                        return;
                                    }

                                    function updateDisplay() {
                                        if (toggle.checked) {
                                            target.style.display = 'block';
                                        } else {
                                            target.style.display = 'none';
                                        }
                                    }

                                    toggle.addEventListener('change', updateDisplay);
                                    updateDisplay();
                                });
                            });
                            </script>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- container -->

    </div><!-- content -->

</div><!-- content-page -->

<?php require_once("includes/footer.php"); ?>
