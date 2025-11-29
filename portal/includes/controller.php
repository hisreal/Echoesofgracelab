<?php

// Reusable helper
function fetchByPid(mysqli $conn, string $table, string $pid): array
{
    // Simple allow list so table names cannot be injected
    $allowedTables = [
        'mcs',
        'urinalysis',
        'anti_bio',
        'coagulation',
        'widal',
        'heamatology',
        'diff_count',
        'lft',
        'infert',
        'elect',
        'enzymes',
        'psa',
        'thyroid',
        'others',
        'lipid_profile',
        'general_msg',
    ];

    if (!in_array($table, $allowedTables, true)) {
        return [null, 0];
    }

    $sql = "SELECT * FROM {$table} WHERE pid = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return [null, 0];
    }

    $stmt->bind_param('s', $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $count = $row ? 1 : 0;

    $stmt->close();

    return [$row, $count];
}

// Map short names to table names
$tables = [
    'Mcs'      => 'mcs',
    'Uri'      => 'urinalysis',
    'Anti'     => 'anti_bio',
    'Coa'      => 'coagulation',
    'Widal'    => 'widal',
    'Hea'      => 'heamatology',
    'Diff'     => 'diff_count',
    'Lft'      => 'lft',
    'Infert'   => 'infert',
    'Elect'    => 'elect',
    'Enzy'     => 'enzymes',
    'Psa'      => 'psa',
    'Thyroid'  => 'thyroid',
    'Other'    => 'others',
    'Lipid'    => 'lipid_profile',
    'General'  => 'general_msg',
];

// Loop and create variables like $FetchMcs, $CountMcs, $FetchUri, $CountUri etc
foreach ($tables as $short => $table) {
    list($row, $count) = fetchByPid($conn, $table, $pid);

    ${"Fetch{$short}"} = $row;
    ${"Count{$short}"} = $count;
}
