<?php require 'backend.php';
function SQLExportDaily($data, $tableName) {
    if (empty($data)) {
        return false;
    }
    
    $filename = $tableName . '_' . date('Ymd_His') . '.sql';
    
    // Get column names from first row
    $columns = array_keys($data[date('Y-m-d')]);
    
    $sql = "-- Export for table: $tableName\n";
    $sql .= "-- Rows: " . count($data) . "\n";
    $sql .= "-- Export time: " . date('Y-m-d H:i:s') . "\n\n";
    
    // Generate INSERT statements
    foreach ($data as $row) {
        $values = [];
        foreach ($columns as $col) {
            $value = $row[$col] ?? null;
            if ($value === null) {
                $values[] = 'NULL';
            } elseif (is_numeric($value)) {
                $values[] = $value;
            } else {
                $values[] = "'" . addslashes($value) . "'";
            }
        }
        
        $sql .= "INSERT INTO $tableName (" . implode(', ', $columns) . ") ";
        $sql .= "VALUES (" . implode(', ', $values) . ");\n";
    }
    
    file_put_contents($filename, $sql);
    return $filename;
}

function SQLExportPredict($data, $tableName) {
    if (empty($data)) {
        return false;
    }
    
    $filename = $tableName . '_' . date('Ymd_His') . '.sql';
    
    // Get column names from first row
    $columns = array_keys($data['list'][0]['main']);
    
    $sql = "-- Export for table: $tableName\n";
    $sql .= "-- Rows: " . count($data) . "\n";
    $sql .= "-- Export time: " . date('Y-m-d H:i:s') . "\n\n";
    
    // Generate INSERT statements
    foreach ($data['list'] as $row) {
        //foreach ($row['main'] as $item) {
            $values = [];
            foreach ($columns as $col) {
                $value = $row['main'][$col] ?? null;
                if ($value === null) {
                    $values[] = 'NULL';
                } elseif (is_numeric($value)) {
                    $values[] = $value;
                } else {
                    $values[] = "'" . addslashes($value) . "'";
                }
            }
        //}
            
        $sql .= "INSERT INTO $tableName (" . implode(', ', $columns) . ") ";
        $sql .= "VALUES (" . implode(', ', $values) . ");\n";
    }
    
    file_put_contents($filename, $sql);
    return $filename;
}

$dailyFile = SQLExportDaily($dailyForecast, 'dailyForecast_log');
echo "Exported daily forecast to: $dailyFile<br>";
$predictFile = SQLExportPredict($predictedForecast, 'predictedForecast_log');
echo "Exported predicted forecast to: $predictFile";
?>