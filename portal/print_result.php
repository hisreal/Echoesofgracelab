<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/dbh.php';

$pid = $_GET['pid'] ?? null;
$FetchPatient = null;

if ($pid !== null) {
    // Prepared statement for safety
    $stmt = $conn->prepare('SELECT * FROM user_info WHERE pid = ? LIMIT 1');
    $stmt->bind_param('s', $pid);
    $stmt->execute();
    $PatientResult = $stmt->get_result();
    $FetchPatient = $PatientResult->fetch_assoc();
    $stmt->close();
}

// simple guard to avoid undefined index below
$patientName = $FetchPatient['patient_name'] ?? 'Patient Result';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($patientName); ?></title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

    <style type="text/css">
        @page {
            margin-bottom: 50mm;
            margin-top: 10mm;
        }

        p {
            font-size: 20px;
            font-family: sans-serif, arial;
            margin: 10px;
        }
        table {
            border: 1px solid black;
            border-top: 1px solid black;
            color: red;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
        }
        thead {
            border: 1px solid black;
            border-top: 1px solid black;
        }
        tr {
            border: 1px solid black;
            border-top: 1px solid black;
        }
        th {
            color: black;
            border: 1px solid black;
            border-top: 1px solid black;
        }
        td {
            color: black;
            line-height: 15px;
            font-size: 16px;
            font-family: sans-serif;
            border: 1px solid black;
            border-top: 1px solid black;
        }
    </style>
</head>

<body style="font-weight: bold" onload="window.print()">
<div class="invoice-wrap">
    <!-- vertical spacing for letterhead -->
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <div style="top: 300px" class="invoice-box">
        <!-- Bordered Table start -->
        <div class="card">
            <div class="card-body">
                <?php require_once 'includes/user_table.php'; ?>
                <?php require_once 'includes/controller.php'; ?>
                <br><br>

                <div style="border: 1px solid black; font-weight: bold">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <?php
                            $Overall = ($CountElect ?? 0) + ($CountEnzy ?? 0) + ($CountLft ?? 0) + ($CountOther ?? 0);
                            if ($Overall > 0) {
                                echo '
                                    <tr style="font-weight: bold;">
                                        <th width="20%">PARAMETERS</th>
                                        <th width="10%">VALUES</th>
                                        <th width="50%">REFERENCE RANGE</th>
                                        <th width="20%">PARAMETERS</th>
                                        <th width="10%">VALUES</th>
                                        <th width="50%">REFERENCE RANGE</th>
                                    </tr>';
                            }
                            ?>
                            </thead>
                            <tbody>
                            <?php if (!empty($CountElect) && $CountElect > 0) { ?>
                                <tr>
                                    <td colspan="6"><b>ELECTROLITE, UREA &amp; CREATININE</b></td>
                                </tr>
                                <tr>
                                    <td>Potassium</td>
                                    <td><?php echo $FetchElect['pot']; ?></td>
                                    <td>3-5mmol/l</td>

                                    <td>Sodium</td>
                                    <td><?php echo $FetchElect['sod']; ?></td>
                                    <td>120-140mmol/l</td>
                                </tr>
                                <tr>
                                    <td>Chloride</td>
                                    <td><?php echo $FetchElect['chl']; ?></td>
                                    <td>95-110mmol/l</td>

                                    <td>Bicarbonates</td>
                                    <td><?php echo $FetchElect['bicar']; ?></td>
                                    <td>20-30mmol/l</td>
                                </tr>
                                <tr>
                                    <td>Urea</td>
                                    <td><?php echo $FetchElect['urea']; ?></td>
                                    <td>2.5-5.8mmol/l</td>

                                    <td>Creatinine</td>
                                    <td><?php echo $FetchElect['creat']; ?></td>
                                    <td>55-110umol/l</td>
                                </tr>
                            <?php } ?>

                            <?php if (!empty($CountEnzy) && $CountEnzy > 0) { ?>
                                <tr>
                                    <td colspan="6"><b>ENZYMES</b></td>
                                </tr>
                                <tr>
                                    <td>Amylase</td>
                                    <td><?php echo $FetchEnzy['amy']; ?></td>
                                    <td>100-400U/l</td>

                                    <td>Gamma GT</td>
                                    <td><?php echo $FetchEnzy['gamma']; ?></td>
                                    <td>5-24U/l</td>
                                </tr>
                                <tr>
                                    <td>AST</td>
                                    <td><?php echo $FetchEnzy['ast']; ?></td>
                                    <td>0-40IU/l</td>

                                    <td>ALT</td>
                                    <td><?php echo $FetchEnzy['alt']; ?></td>
                                    <td>0-40IU/l</td>
                                </tr>
                                <tr>
                                    <td>Alkaline Phosphate</td>
                                    <td><?php echo $FetchEnzy['alk']; ?></td>
                                    <td>41-141IU/l</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>

                            <?php if (!empty($CountLft) && $CountLft > 0) { ?>
                                <tr>
                                    <td colspan="6"><b>LIVER FUNCTION TEST</b></td>
                                </tr>
                                <tr>
                                    <td>Total Bilirubin</td>
                                    <td><?php echo $FetchLft['bil_t']; ?></td>
                                    <td>0-17umol/l</td>

                                    <td>Conj. Bilirubin</td>
                                    <td><?php echo $FetchLft['conj']; ?></td>
                                    <td>0-5umol/l</td>
                                </tr>
                                <tr>
                                    <td>Total Protein</td>
                                    <td><?php echo $FetchLft['protein']; ?></td>
                                    <td>58-80g/l</td>

                                    <td>Albumin</td>
                                    <td><?php echo $FetchLft['alb']; ?></td>
                                    <td>35-50g/l</td>
                                </tr>
                            <?php } ?>

                            <?php if (!empty($CountOther) && $CountOther > 0) { ?>
                                <tr>
                                    <td colspan="6"><b>OTHERS</b></td>
                                </tr>
                                <tr>
                                    <td>Fasting Blood Sugar</td>
                                    <td><?php echo $FetchOther['fbs']; ?></td>
                                    <td>3.9-6.1mmol/l</td>

                                    <td>HBA1C</td>
                                    <td><?php echo $FetchOther['hba1c']; ?></td>
                                    <td>&lt; 5.5%</td>
                                </tr>
                                <tr>
                                    <td>Calcium</td>
                                    <td><?php echo $FetchOther['cal']; ?></td>
                                    <td>2.25-2.75mmol/l</td>

                                    <td>Phosphate</td>
                                    <td><?php echo $FetchOther['ing']; ?></td>
                                    <td>0.65-1.30mmol/l</td>
                                </tr>
                                <tr>
                                    <td>Uric Acid</td>
                                    <td><?php echo $FetchOther['uric']; ?></td>
                                    <td>0.12-0.36mmol/l</td>

                                    <td>2Hrs PP</td>
                                    <td><?php echo $FetchOther['hpp']; ?></td>
                                    <td>5-11mmol/l</td>
                                </tr>
                                <tr>
                                    <td>Ferritin</td>
                                    <td><?php echo $FetchOther['ferri']; ?></td>
                                    <td>16-220ng/ml</td>
                                    <td></td><td></td><td></td>
                                </tr>
                            <?php } ?>

                            <?php if (!empty($CountLipid) && $CountLipid > 0) { ?>
                                <tr>
                                    <td colspan="6"><b>LIPID PROFILE</b></td>
                                </tr>
                                <tr>
                                    <td>Triglycerides</td>
                                    <td><?php echo $FetchLipid['tg']; ?></td>
                                    <td>0.7-1.5mmol/l</td>

                                    <td>Total Cholesterol</td>
                                    <td><?php echo $FetchLipid['tc']; ?></td>
                                    <td>2.5-5.8mmol/l</td>
                                </tr>
                                <tr>
                                    <td>HDL Cholesterol</td>
                                    <td><?php echo $FetchLipid['hdl']; ?></td>
                                    <td>&lt; 2.0mmol/l</td>

                                    <td>LDL Cholesterol</td>
                                    <td><?php echo $FetchLipid['ldl']; ?></td>
                                    <td>2.5-3.5mmol/l</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if (!empty($CountUri) && $CountUri > 0) { ?>
                    <div style="border: 1px solid black; margin-top: 10px;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td colspan="8"><b>URINALYSIS</b></td>
                                </tr>
                                <tr style="font-weight: bold;">
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                </tr>
                                <tbody>
                                <tr>
                                    <td>PH</td>
                                    <td><?php echo $FetchUri['ph']; ?></td>
                                    <td>S.G</td>
                                    <td><?php echo $FetchUri['sg']; ?></td>
                                    <td>Glucose</td>
                                    <td><?php echo $FetchUri['gluc']; ?></td>
                                    <td>Bilirubin</td>
                                    <td><?php echo $FetchUri['bil']; ?></td>
                                </tr>
                                <tr>
                                    <td>Ascorbic Acid</td>
                                    <td><?php echo $FetchUri['asco']; ?></td>
                                    <td>Urobilinogen</td>
                                    <td><?php echo $FetchUri['uro']; ?></td>
                                    <td>Protein</td>
                                    <td><?php echo $FetchUri['pro']; ?></td>
                                    <td>Blood</td>
                                    <td><?php echo $FetchUri['blood']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nitrite</td>
                                    <td><?php echo $FetchUri['nit']; ?></td>
                                    <td>Ketone</td>
                                    <td><?php echo $FetchUri['ket']; ?></td>
                                    <td>Leukocytes</td>
                                    <td><?php echo $FetchUri['leu']; ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td>Epithelia</td>
                                    <td><?php echo $FetchUri['epi']; ?></td>
                                    <td>Pus Cells</td>
                                    <td><?php echo $FetchUri['pus']; ?></td>
                                    <td>Bacts</td>
                                    <td><?php echo $FetchUri['bact']; ?></td>
                                    <td>RBC</td>
                                    <td><?php echo $FetchUri['cast']; ?></td>
                                </tr>
                            </table>
                            <p><b>Appearance:</b> <?php echo $FetchUri['app']; ?></p>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountMcs) && $CountMcs > 0) { ?>
                    <br>
                    <div style="border: 1px solid black">
                        <div class="table-responsive">
                            <table class="table">
                                <tr style="font-weight: bold;">
                                    <td width="40%">PARAMETERS</td>
                                    <td width="10%">RESULT</td>
                                    <td width="40%">PARAMETERS</td>
                                    <td width="10%">RESULT</td>
                                </tr>
                                <tr>
                                    <td>Epithelia</td>
                                    <td><?php echo $FetchMcs['epi']; ?></td>
                                    <td>Pus Cell</td>
                                    <td><?php echo $FetchMcs['pus']; ?></td>
                                </tr>
                                <tr>
                                    <td>Calcium Oxalate</td>
                                    <td><?php echo $FetchMcs['cal']; ?></td>
                                    <td>RBC</td>
                                    <td><?php echo $FetchMcs['rbc']; ?></td>
                                </tr>
                                <tr>
                                    <td>Yeast</td>
                                    <td><?php echo $FetchMcs['yeast']; ?></td>
                                    <td>Crystals</td>
                                    <td><?php echo $FetchMcs['crys']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Culture:</b> <?php echo $FetchMcs['culture']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Appearance:</b> <?php echo $FetchMcs['appearance']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountAnti) && $CountAnti > 0) { ?>
                    <div style="border: 1px solid black; margin-top: 10px;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td colspan="8">
                                        <b>ANTIBIOTIC SENSITIVITY</b><br><br>
                                        [(+) <i>Represent</i> <b>(SENSITIVITY)</b>]
                                        <span style="float: right">[(---) <i>Represent</i> <b>(RESISTANT)</b>]</span>
                                    </td>
                                </tr>
                                <tr style="font-weight: bold">
                                    <td width="40%">DRUGS</td>
                                    <td width="10%">ISOLATES</td>
                                    <td width="40%">DRUGS</td>
                                    <td width="10%">ISOLATES</td>
                                    <td width="40%">DRUGS</td>
                                    <td width="10%">ISOLATES</td>
                                </tr>
                                <tr>
                                    <td>Amoxicillin</td>
                                    <td><?php echo $FetchAnti['aug']; ?></td>
                                    <td>Cefotaxime</td>
                                    <td><?php echo $FetchAnti['ctx']; ?></td>
                                    <td>Ceftriaxone Sulbactam</td>
                                    <td><?php echo $FetchAnti['cro']; ?></td>
                                </tr>
                                <tr>
                                    <td>Levofloxacin</td>
                                    <td><?php echo $FetchAnti['lbc']; ?></td>
                                    <td>Cefexime</td>
                                    <td><?php echo $FetchAnti['zem']; ?></td>
                                    <td>Imipenem/Cilastain</td>
                                    <td><?php echo $FetchAnti['imp']; ?></td>
                                </tr>
                                <tr>
                                    <td>Ofloxacin</td>
                                    <td><?php echo $FetchAnti['ofx']; ?></td>
                                    <td>Gentamycin</td>
                                    <td><?php echo $FetchAnti['gn']; ?></td>
                                    <td>Cefuroxime</td>
                                    <td><?php echo $FetchAnti['cxm']; ?></td>
                                </tr>
                                <?php if ($FetchAnti['choice'] === 'Positive') {
                                    echo '
                                        <tr>
                                            <td>Nalidixic</td>
                                            <td>' . $FetchAnti['na'] . '</td>
                                            <td>Ampiclox</td>
                                            <td>' . $FetchAnti['acx'] . '</td>
                                            <td>Nitrofuratoin</td>
                                            <td>' . $FetchAnti['nf'] . '</td>
                                        </tr>';
                                } ?>
                                <?php if ($FetchAnti['choice'] === 'Negative') {
                                    echo '
                                        <tr>
                                            <td>Ciprofloxacin</td>
                                            <td>' . $FetchAnti['cip'] . '</td>
                                            <td>Erythromycin</td>
                                            <td>' . $FetchAnti['ery'] . '</td>
                                            <td>Azithromycin</td>
                                            <td>' . $FetchAnti['azn'] . '</td>
                                        </tr>';
                                } ?>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountWidal) && $CountWidal > 0) { ?>
                    <br>
                    <h4 style="text-align: center;" class="header-title">WIDAL</h4>
                    <div style="border: 1px solid black">
                        <div class="table-responsive">
                            <table class="table">
                                <tr style="font-weight: bold;">
                                    <td width="25%">PARAMETERS</td>
                                    <td width="25%">TITRE</td>
                                    <td width="25%">PARAMETERS</td>
                                    <td width="25%">TITRE</td>
                                </tr>
                                <tr>
                                    <td>S.Paratyphi A O antigen</td>
                                    <td><?php echo $FetchWidal['O1']; ?></td>
                                    <td>S.Paratyphi A H antigen</td>
                                    <td><?php echo $FetchWidal['H1']; ?></td>
                                </tr>
                                <tr>
                                    <td>S.Paratyphi B O antigen</td>
                                    <td><?php echo $FetchWidal['O2']; ?></td>
                                    <td>S.Paratyphi B H antigen</td>
                                    <td><?php echo $FetchWidal['H2']; ?></td>
                                </tr>
                                <tr>
                                    <td>S.Paratyphi C O antigen</td>
                                    <td><?php echo $FetchWidal['O3']; ?></td>
                                    <td>S.Paratyphi C H antigen</td>
                                    <td><?php echo $FetchWidal['H3']; ?></td>
                                </tr>
                                <tr>
                                    <td>S.Typhi O antigen</td>
                                    <td><?php echo $FetchWidal['O4']; ?></td>
                                    <td>S.Typhi H antigen</td>
                                    <td><?php echo $FetchWidal['H4']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>SIGNIFICANT TITRE STARTS FROM 1/80 AND HIGHER DILUTION</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountHea) && $CountHea > 0) { ?>
                    <br>
                    <div style="border: 1px solid black">
                        <div class="table-responsive">
                            <table class="table">
                                <tr style="font-weight: bold">
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                    <th width="40%">PARAMETERS</th>
                                    <th width="10%">RESULT</th>
                                </tr>
                                <tr>
                                    <td>PCV</td>
                                    <td><?php echo $FetchHea['pcv']; ?></td>
                                    <td>WBC</td>
                                    <td><?php echo $FetchHea['wbc']; ?> X10<sup>9</sup>/L</td>
                                    <td>ESR</td>
                                    <td><?php echo $FetchHea['esr']; ?></td>
                                </tr>
                                <tr>
                                    <td>Platelets</td>
                                    <td><?php echo $FetchHea['plate']; ?> (150-400 X10<sup>9</sup>/L)</td>
                                    <td>Microfilaria</td>
                                    <td><?php echo $FetchHea['microf']; ?></td>
                                    <td colspan="2"></td>
                                </tr>

                                <?php if (!empty($CountDiff) && $CountDiff > 0) { ?>
                                    <tr><td colspan="6"><b><center>DIFFERENTIAL</center></b></td></tr>
                                    <tr>
                                        <td>Neutrophils</td>
                                        <td><?php echo $FetchDiff['neu']; ?></td>
                                        <td>Lymphocytes</td>
                                        <td><?php echo $FetchDiff['lym']; ?></td>
                                        <td>Monocytes</td>
                                        <td><?php echo $FetchDiff['mono']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Eosinophils</td>
                                        <td><?php echo $FetchDiff['eosi']; ?></td>
                                        <td>Basophils</td>
                                        <td><?php echo $FetchDiff['baso']; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><b>Comment:</b> <?php echo $FetchDiff['c_fbc']; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountPsa) && $CountPsa > 0) { ?>
                    <div style="border: 1px solid black; margin-top: 10px;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr style="font-weight: bold">
                                    <td width="40%">PARAMETERS</td>
                                    <td width="10%">VALUE</td>
                                    <td width="50%">REFERENCE RANGE</td>
                                </tr>
                                <tr>
                                    <td>Total PSA</td>
                                    <td><?php echo $FetchPsa['tpsa']; ?></td>
                                    <td>0-4ng/ml</td>
                                </tr>
                                <tr>
                                    <td>Free PSA</td>
                                    <td><?php echo $FetchPsa['fpsa']; ?></td>
                                    <td>0-1.3ng/ml</td>
                                </tr>
                                <tr>
                                    <td>FPSA/TPSA Ratio</td>
                                    <td><?php echo $FetchPsa['ratio']; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Comment:</b> <?php echo $FetchPsa['c_psa']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CounThyroid) && $CounThyroid > 0) { ?>
                    <br>
                    <div style="border: 1px solid black">
                        <div class="table-responsive">
                            <table class="table">
                                <tr style="font-weight: bold">
                                    <td colspan="3">THYROID FUNCTION TEST</td>
                                </tr>
                                <tr style="font-weight: bold">
                                    <td width="40%">PARAMETERS</td>
                                    <td width="10%">VALUE</td>
                                    <td width="50%">REFERENCE RANGE</td>
                                </tr>
                                <tr>
                                    <td>fT3</td>
                                    <td><?php echo $FetchThyroid['fT3']; ?></td>
                                    <td>1.6-4.2pg/ml</td>
                                </tr>
                                <tr>
                                    <td>fT4</td>
                                    <td><?php echo $FetchThyroid['fT4']; ?></td>
                                    <td>0.8-2.0ng/ml</td>
                                </tr>
                                <tr>
                                    <td>TSH</td>
                                    <td><?php echo $FetchThyroid['TSH']; ?></td>
                                    <td>0.5-3.7uIU/ml</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Comment:</b> <?php echo $FetchThyroid['c_thyroid']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountInfert) && $CountInfert > 0) { ?>
                    <div style="border: 1px solid black; margin-top: 10px;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr style="font-weight: bold">
                                    <td width="40%">PARAMETERS</td>
                                    <td width="10%">VALUE</td>
                                    <td width="50%">REFERENCE RANGE</td>
                                </tr>
                                <tr>
                                    <td>FSH</td>
                                    <td><?php echo $FetchInfert['fsh']; ?></td>
                                    <td>(2-12mlu/ml)</td>
                                </tr>
                                <tr>
                                    <td>LH</td>
                                    <td><?php echo $FetchInfert['lh']; ?></td>
                                    <td>(0.5-10.5mlu/ml)</td>
                                </tr>
                                <tr>
                                    <?php
                                    if (($FetchPatient['sex'] ?? '') === 'Female') {
                                        echo '<td>Prolactin</td>
                                              <td>' . $FetchInfert['prolactin'] . '</td>
                                              <td>(5-25ng/ml)</td>';
                                    } elseif (($FetchPatient['sex'] ?? '') === 'Male') {
                                        echo '<td>Prolactin</td>
                                              <td>' . $FetchInfert['prolactin'] . '</td>
                                              <td>(5-17ng/ml)</td>';
                                    } else {
                                        echo '<td>Prolactin</td>
                                              <td>' . $FetchInfert['prolactin'] . '</td>
                                              <td></td>';
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td>Progesterone</td>
                                    <td><?php echo $FetchInfert['progest']; ?></td>
                                    <td>(3-35ng/ml)</td>
                                </tr>
                                <tr>
                                    <td>Testosterone</td>
                                    <td><?php echo $FetchInfert['test']; ?></td>
                                    <td>(4-10ng/ml)</td>
                                </tr>
                                <tr>
                                    <td>Eostradol</td>
                                    <td><?php echo $FetchInfert['oesf']; ?></td>
                                    <td>(60-190pg/ml)</td>
                                </tr>
                                <tr>
                                    <td>Eostrogen</td>
                                    <td><?php echo $FetchInfert['oesm']; ?></td>
                                    <td>(60-190pg/ml)</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Comment:</b> <?php echo $FetchInfert['c_infert']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountCoa) && $CountCoa > 0) { ?>
                    <div style="border: 1px solid black; margin-top: 10px;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td><b>PT</b></td>
                                    <td><?php echo $FetchCoa['pt']; ?></td>
                                    <td><b>Control</b></td>
                                    <td><?php echo $FetchCoa['cont1']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Ratio</b></td>
                                    <td><?php echo $FetchCoa['ratio']; ?></td>
                                    <td><b>INR</b></td>
                                    <td><?php echo $FetchCoa['inr']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>PTTK</b></td>
                                    <td><?php echo $FetchCoa['pttk']; ?></td>
                                    <td><b>Control</b></td>
                                    <td><?php echo $FetchCoa['cont2']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($CountGeneral) && $CountGeneral > 0) { ?>
                    <div class="general" style="border: 1px solid black; padding: 50px; font-size: 16px; margin-top: 10px;">
                        <?php echo $FetchGeneral['general_msg']; ?>
                    </div>
                <?php } ?>

                <div style="float: right; font-size: 14px; margin-top: 50px; margin-bottom: 50px; text-align: center">
                    ______________________________<br>
                    <p style="font-weight: bold">MLS (DR) D.D AJAYI</p>
                    <span>MEDICAL LAB SCIENTIST IN CHARGE</span>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
