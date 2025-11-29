<?php
error_reporting(3);
session_start();

require_once('../../includes/dbh.php');

if (isset($_POST['submit'])) {
// TEMP: debug what we get from the form


    // Simple helper to sanitize a single value
    function clean($conn, $value) {
        return mysqli_real_escape_string($conn, $value ?? '');
    }

    // Helper to insert or update based on pid
    function upsertByPid(mysqli $conn, string $table, string $pid, array $data) {
        if (empty($data)) {
            return;
        }

        $pidEsc = clean($conn, $pid);

        // Sanitize all values
        $setParts = [];
        $cols = [];
        $vals = [];
        foreach ($data as $col => $val) {
            $colSafe = trim($col);
            if ($colSafe === '') {
                continue;
            }
            $cols[] = "`{$colSafe}`";
            $valEsc = clean($conn, $val);
            $vals[] = "'{$valEsc}'";
            $setParts[] = "`{$colSafe}`='{$valEsc}'";
        }

        if (empty($cols)) {
            return;
        }

        // Check if row exists
        $checkSql = "SELECT 1 FROM `{$table}` WHERE pid='{$pidEsc}' LIMIT 1";
        $checkResult = mysqli_query($conn, $checkSql);
        if (!$checkResult) {
            // log or handle error if needed
            return;
        }

        if (mysqli_num_rows($checkResult) > 0) {
            // Update
            $setSql = implode(', ', $setParts);
            $sql = "UPDATE `{$table}` SET {$setSql} WHERE pid='{$pidEsc}'";
        } else {
            // Insert
            $colsSql = implode(', ', array_merge(['`pid`'], $cols));
            $valsSql = implode(', ', array_merge(["'{$pidEsc}'"], $vals));
            $sql = "INSERT INTO `{$table}` ({$colsSql}) VALUES ({$valsSql})";
        }

        mysqli_query($conn, $sql);
    }

    // Main data
    $date_receive = date('Y-m-d H:i:s');
    $pid = clean($conn, $_POST['pid'] ?? '');

    // Fetch user info
    $UserStmt  = "SELECT * FROM user_info WHERE pid='{$pid}' LIMIT 1";
    $UserResult = mysqli_query($conn, $UserStmt);
    $FetchUser  = mysqli_fetch_assoc($UserResult);

    $hospital = $FetchUser['hospital'] ?? '';
    $username = $FetchUser['patient_name'] ?? '';

    // Mark as printed in user_info (once)
    $UserCh = "UPDATE user_info SET printed='Yes' WHERE pid='{$pid}'";
    mysqli_query($conn, $UserCh);

    // Create notification if hospital is present
    if (!empty($hospital)) {
        $msg = "This is to notify that {$username} is out";
        $UserStmt2 = "
            INSERT INTO notification (`pid`, `msg`, `date_created`, `btn`, `hospital`)
            VALUES ('{$pid}', '" . clean($conn, $msg) . "', '{$date_receive}', '0', '" . clean($conn, $hospital) . "')
        ";
        mysqli_query($conn, $UserStmt2);
    }

    // Heamatology (first)
    if (!empty($_POST['first'])) {
        upsertByPid($conn, 'heamatology', $pid, [
            'hb'     => $_POST['hb'] ?? '',
            'pcv'    => $_POST['pcv'] ?? '',
            'wbc'    => $_POST['wbc'] ?? '',
            'plate'  => $_POST['plate'] ?? '',
            'esr'    => $_POST['esr'] ?? '',
            'microf' => $_POST['microf'] ?? '',
        ]);
    }

    // Differentiate count (second)
    if (!empty($_POST['second'])) {
        upsertByPid($conn, 'diff_count', $pid, [
            'neu'   => $_POST['neu'] ?? '',
            'lym'   => $_POST['lym'] ?? '',
            'mono'  => $_POST['mono'] ?? '',
            'eosi'  => $_POST['eosi'] ?? '',
            'baso'  => $_POST['baso'] ?? '',
            'c_fbc' => $_POST['c_fbc'] ?? '',
        ]);
    }

    // RBC morphology (third)
    if (!empty($_POST['third'])) {
        upsertByPid($conn, 'rbc_morphology', $pid, [
            'macro'  => $_POST['macro'] ?? '',
            'micro'  => $_POST['micro'] ?? '',
            'aniso'  => $_POST['aniso'] ?? '',
            'poiki'  => $_POST['poiki'] ?? '',
            'target' => $_POST['target'] ?? '',
            'sickle' => $_POST['sickle'] ?? '',
            'poly'   => $_POST['poly'] ?? '',
            'hypo'   => $_POST['hypo'] ?? '',
        ]);
    }

    // M C S (fouth)
    if (!empty($_POST['fouth'])) {
        upsertByPid($conn, 'mcs', $pid, [
            'epi'        => $_POST['epim'] ?? '',
            'pus'        => $_POST['pusm'] ?? '',
            'rbc'        => $_POST['rbcm'] ?? '',
            'culture'    => $_POST['culture'] ?? '',
            'cal'        => $_POST['calm'] ?? '',
            'yeast'      => $_POST['yeast'] ?? '',
            'appearance' => $_POST['appearance'] ?? '',
            'o_mcs'      => $_POST['o_mcs'] ?? '',
            'crys'       => $_POST['crys'] ?? '',
        ]);
    }

    // Urinalysis (fifth)
    if (!empty($_POST['fifth'])) {
        upsertByPid($conn, 'urinalysis', $pid, [
            'ph'    => $_POST['ph'] ?? '',
            'gluc'  => $_POST['gluc'] ?? '',
            'asco'  => $_POST['asco'] ?? '',
            'pro'   => $_POST['pro'] ?? '',
            'epi'   => $_POST['epi'] ?? '',
            'pus'   => $_POST['pus'] ?? '',
            'rbc'   => $_POST['rbc'] ?? '',
            'bact'  => $_POST['bact'] ?? '',
            'cast'  => $_POST['cast'] ?? '',
            'sg'    => $_POST['sg'] ?? '',
            'bil'   => $_POST['bil'] ?? '',
            'uro'   => $_POST['uro'] ?? '',
            'blood' => $_POST['blood'] ?? '',
            'ket'   => $_POST['ket'] ?? '',
            'nit'   => $_POST['nit'] ?? '',
            'app'   => $_POST['app'] ?? '',
            'leu'   => $_POST['leu'] ?? '',
        ]);
    }

    // Widal (sixth)
    if (!empty($_POST['sixth'])) {
        upsertByPid($conn, 'widal', $pid, [
            'O1' => $_POST['O1'] ?? '',
            'O2' => $_POST['O2'] ?? '',
            'O3' => $_POST['O3'] ?? '',
            'O4' => $_POST['O4'] ?? '',
            'H1' => $_POST['h1'] ?? '',
            'H2' => $_POST['h2'] ?? '',
            'H3' => $_POST['h3'] ?? '',
            'H4' => $_POST['h4'] ?? '',
        ]);
    }

    // Enzymes (seventh)
    if (!empty($_POST['seventh'])) {
        upsertByPid($conn, 'enzymes', $pid, [
            'amy'   => $_POST['amy'] ?? '',
            'alk'   => $_POST['alk'] ?? '',
            'gamma' => $_POST['gamma'] ?? '',
            'ast'   => $_POST['ast'] ?? '',
            'alt'   => $_POST['alt'] ?? '',
        ]);
    }

    // Liver function (eighth)
    if (!empty($_POST['eighth'])) {
        upsertByPid($conn, 'lft', $pid, [
            'bil_t'  => $_POST['bil_t'] ?? '',
            'conj'   => $_POST['conj'] ?? '',
            'protein'=> $_POST['proteinT'] ?? '',
            'alb'    => $_POST['alb'] ?? '',
        ]);
    }

    // Electrolytes (ninth)
    if (!empty($_POST['ninth'])) {
        upsertByPid($conn, 'elect', $pid, [
            'bicar' => $_POST['bicar'] ?? '',
            'chl'   => $_POST['chl'] ?? '',
            'pot'   => $_POST['pot'] ?? '',
            'sod'   => $_POST['sod'] ?? '',
            'urea'  => $_POST['urea'] ?? '',
            'creat' => $_POST['creat'] ?? '',
        ]);
    }

    // Lipid profile (tenth)
    if (!empty($_POST['tenth'])) {
        upsertByPid($conn, 'lipid_profile', $pid, [
            'tc'  => $_POST['tc'] ?? '',
            'tg'  => $_POST['tg'] ?? '',
            'hdl' => $_POST['hdl'] ?? '',
            'ldl' => $_POST['ldl'] ?? '',
        ]);
    }

    // Others (eleventh)
    if (!empty($_POST['eleventh'])) {
        upsertByPid($conn, 'others', $pid, [
            'fbs'   => $_POST['fbs'] ?? '',
            'hba1c' => $_POST['hba1c'] ?? '',
            'cal'   => $_POST['cal'] ?? '',
            'ing'   => $_POST['ing'] ?? '',
            'uric'  => $_POST['uric'] ?? '',
            'hpp'   => $_POST['hpp'] ?? '',
            'ferri' => $_POST['ferri'] ?? '',
        ]);
    }

    // Marital screen (twelveth)
    if (!empty($_POST['twelveth'])) {
        upsertByPid($conn, 'marital', $pid, [
            'hbg'         => $_POST['hbg'] ?? '',
            'hiv'         => $_POST['hiv'] ?? '',
            'blood_group' => $_POST['blood_group'] ?? '',
            'hep_b'       => $_POST['hep_b'] ?? '',
            'hep_c'       => $_POST['hep_c'] ?? '',
        ]);
    }

    // PSA (thirteen)
    if (!empty($_POST['thirteen'])) {
        upsertByPid($conn, 'psa', $pid, [
            'tpsa'  => $_POST['tpsa'] ?? '',
            'fpsa'  => $_POST['fpsa'] ?? '',
            'ratio' => $_POST['ratio'] ?? '',
            'c_psa' => $_POST['c_psa'] ?? '',
        ]);
    }

    // Thyroid (fourteen)
    if (!empty($_POST['fourteen'])) {
        upsertByPid($conn, 'thyroid', $pid, [
            'fT3'       => $_POST['fT3'] ?? '',
            'fT4'       => $_POST['fT4'] ?? '',
            'TSH'       => $_POST['TSH'] ?? '',
            'c_thyroid' => $_POST['c_thyroid'] ?? '',
        ]);
    }

    // Infertility (fifteen)
    if (!empty($_POST['fifteen'])) {
        upsertByPid($conn, 'infert', $pid, [
            'fsh'       => $_POST['fsh'] ?? '',
            'lh'        => $_POST['lh'] ?? '',
            'prolactin' => $_POST['prolactin'] ?? '',
            'progest'   => $_POST['progest'] ?? '',
            'oesf'      => $_POST['oesf'] ?? '',
            'oesm'      => $_POST['oesm'] ?? '',
            'test'      => $_POST['test'] ?? '',
            'c_infert'  => $_POST['c_infert'] ?? '',
        ]);
    }

    // Coagulation (eighteen)
    if (!empty($_POST['eighteen'])) {
        upsertByPid($conn, 'coagulation', $pid, [
            'pt'    => $_POST['pt'] ?? '',
            'cont1' => $_POST['cont1'] ?? '',
            'inr'   => $_POST['inr'] ?? '',
            'pttk'  => $_POST['pttk'] ?? '',
            'ratio' => $_POST['ratio'] ?? '',
            'cont2' => $_POST['cont2'] ?? '',
        ]);
    }

    // Height weight hip waist (twenty)
    if (!empty($_POST['twenty'])) {
        upsertByPid($conn, 'height_weight', $pid, [
            'height' => $_POST['height'] ?? '',
            'weight' => $_POST['weight'] ?? '',
            'hip'    => $_POST['hip'] ?? '',
            'waist'  => $_POST['waist'] ?? '',
        ]);
    }

    // Anti biotics (twenty_one)
    if (!empty($_POST['twenty_one'])) {
        upsertByPid($conn, 'anti_bio', $pid, [
            'aug'    => $_POST['aug'] ?? '',
            'ctx'    => $_POST['ctx'] ?? '',
            'cro'    => $_POST['cro'] ?? '',
            'zem'    => $_POST['zem'] ?? '',
            'lbc'    => $_POST['lbc'] ?? '',
            'imp'    => $_POST['imp'] ?? '',
            'cxm'    => $_POST['cxm'] ?? '',
            'ofx'    => $_POST['ofx'] ?? '',
            'gn'     => $_POST['gn'] ?? '',
            'choice' => $_POST['choice'] ?? '',
            'azn'    => $_POST['azn'] ?? '',
            'ery'    => $_POST['ery'] ?? '',
            'cip'    => $_POST['cip'] ?? '',
            'na'     => $_POST['na'] ?? '',
            'acx'    => $_POST['acx'] ?? '',
            'nf'     => $_POST['nf'] ?? '',
        ]);
    }

    // General message (general-btn)
    if (!empty($_POST['general-btn'])) {
        upsertByPid($conn, 'general_msg', $pid, [
            'general_msg' => $_POST['general_msg'] ?? '',
        ]);
    }

    // Make sure user_info printed is set (already done above, but this keeps your final logic)
    $PatientStmt = "UPDATE user_info SET printed='Yes' WHERE pid='{$pid}'";
    mysqli_query($conn, $PatientStmt);

    echo "<script>
        window.alert('This Result has been successfully saved');
        window.location.href='../print_result.php?pid={$pid}';
    </script>";
}
?>
