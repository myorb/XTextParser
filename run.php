<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Xparser</title>
</head>
<body>
<pre>
<?php
require 'Xparser.php'; 
$file = 'searches.csv';
  
$start = microtime(true);

$text = new Xparser ($file); 
$text->writeResults();//or you can get results by getResults
//for use from comand line write:
//php -r 'include "Xparser.php"; $c = new Xparser("searches.csv"); $c->writeResults();'

echo '<br>'.(microtime(true)-$start).'<hr><br>'; 

?> 
</pre>
</body>
</html>