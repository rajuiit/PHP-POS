<?php
$db = mysql_connect('localhost','sscollec_databas','o[(3bIEz^]o}');
$dbs = array();

$dbs[] = 'sscollec_database';

foreach($dbs as $v){
    mysql_select_db($v);
    $q = mysql_query('show tables');
    $tables = array();
    while($r = mysql_fetch_row($q)){
            $tables[] = $r[0];
    }
    foreach($tables as $t){
        echo "do $v.$t\n";
        mysql_query('ALTER TABLE `'.$t.'` ENGINE=MyISAM;');
    }
}
mysql_close($db);
?>