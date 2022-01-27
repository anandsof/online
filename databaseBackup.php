<?php
include('cookie.php');

include('config.inc');

// TO see users id

if ($ID = $_GET['ID']);
else
    $ID = $_POST['ID'];

$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);


$res = mysqli_query($db_connect, "DELETE FROM temp");
$action = $_POST['action'];
echo $action;
if ($action == 'backupnow')
{
    
    $backup_file = 'db_certExams-' . date('YmdHis') . '.sql';
    
    echo $backup_file;
    
    $fp = fopen($backup_file, 'w');
    
    $schema = '# certExams , Online - Test' . "\n" . '# http://www.online.certexams.com' . "\n" . '#' . "\n" . '# Database Backup For ' . $base . "\n" . '# Copyright (c) ' . date('Y') . ' AnandSoft.com ' . "\n" . '#' . "\n" . '# Backup Date: ' . date('dmY') . "\n\n";
    
    fputs($fp, $schema);
    
    $tables_query = mysqli_query($db_connect, 'show tables');
    
    while ($tables = mysqli_fetch_array($tables_query)) {
        list(, $table) = each($tables);
        
        $schema = "\n\n" . 'drop table if exists ' . $table . ';' . "\n" . 'create table ' . $table . ' (' . "\n";
        
        $table_list   = array();
        $fields_query = mysqli_query($db_connect, "show fields from " . $table);
        while ($fields = mysqli_fetch_array($fields_query)) {
            $table_list[] = $fields['Field'];
            
            $schema .= '  ' . $fields['Field'] . ' ' . $fields['Type'];
            
            if (strlen($fields['Default']) > 0)
                $schema .= ' default \'' . $fields['Default'] . '\'';
            
            if ($fields['Null'] != 'YES')
                $schema .= ' not null';
            
            if (isset($fields['Extra']))
                $schema .= ' ' . $fields['Extra'];
            
            $schema .= ',' . "\n";
        }
        
        $schema = ereg_replace(",\n$", '', $schema);
        
        // add the keys
        $index      = array();
        $keys_query = mysqli_query($db_connect, "show keys from " . $table);
        while ($keys = mysqli_fetch_array($keys_query)) {
            $kname = $keys['Key_name'];
            
            if (!isset($index[$kname])) {
                $index[$kname] = array(
                    'unique' => !$keys['Non_unique'],
                    'columns' => array()
                );
            }
            
            $index[$kname]['columns'][] = $keys['Column_name'];
        }
        
        while (list($kname, $info) = each($index)) {
            $schema .= ',' . "\n";
            
            $columns = implode($info['columns'], ', ');
            
            if ($kname == 'PRIMARY') {
                $schema .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ($info['unique']) {
                $schema .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
                $schema .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
        }
        
        $schema .= "\n" . ');' . "\n\n";
        fputs($fp, $schema);
        
        // dump the data
        $rows_query = mysqli_query($db_connect, "select " . implode(',', $table_list) . " from " . $table);
        while ($rows = mysqli_fetch_array($rows_query)) {
            $schema = 'insert into ' . $table . ' (' . implode(', ', $table_list) . ') values (';
            
            reset($table_list);
            while (list(, $i) = each($table_list)) {
                if (!isset($rows[$i])) {
                    $schema .= 'NULL, ';
                } elseif ($rows[$i] != NULL) {
                    $row = addslashes($rows[$i]);
                    $row = ereg_replace("\n#", "\n" . '\#', $row);
                    
                    $schema .= '\'' . $row . '\', ';
                } else {
                    $schema .= '\'\', ';
                }
            }
            
            $schema = ereg_replace(', $', '', $schema) . ');' . "\n";
            fputs($fp, $schema);
            
        }
    }
    
    fclose($fp);
    
    
    if (isset($_POST['download']) && ($_POST['download'] == 'yes')) {
        header('Content-type: application/x-octet-stream');
        header('Content-disposition: attachment; filename=' . $backup_file);
        print $backup_file;
        readfile($backup_file);
        unlink($backup_file);
        exit;
        
    } else {
        print("UnSuccess");
        $mes = 1;
        
    }   
    
}
?>
<html>

<head>
<title>certExams.com - Online Test</title>
<link href="style.css" rel="StyleSheet" type="text/css">
</head>

<body>

<br><br><center>
<form action="databaseBackup.php" method="post" name="backup">
	<table border="0" cellpadding="2" cellspacing="0" width="100%">
		<tr>
			<td>This will backup the whole database including exams, users, questions 
			and results. Do not interrupt the backup process which might take a 
			couple of minutes.</td>
		</tr>
		<tr>
			<td align="center"><br>
			<input name="download" type="text" value="yes">
			<input name="action" type="text" value="backupnow">
			<input name="ID" type="text" value="<?php print("$ID") ?>">
			<input name="Backup" type="submit" value=" Backup "> </td>
		</tr>
	</table>
</form>
</center><center><hr noshade="noshade" size="1" width="75%"></center><center>
</center>

</body>

</html>
