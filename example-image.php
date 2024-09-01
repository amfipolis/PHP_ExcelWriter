<?php
# https://github.com/comsave/PHP_XLSXWriter/tree/master 
# git clone git@github.com:mk-j/PHP_XLSXWriter.git
# please add an image.jpg in the same directory with this source code file.
require_once('xlsxwriter.class.php');
require_once('xlsxwriterplus.class.php');

$writer = new XLSWriterPlus();

$writer->writeSheetRow('Sheet1', ['test line']);

$writer->addImage(realpath('./image.jpg'), 1, [
	'startColNum' => 6,
	'endColNum' => 10,
	'startRowNum' => 5,
	'endRowNum' => 20
]);

$row = [];
for($c = 0; $c < 1000; $c++) {
	$row[] = bin2hex(random_bytes(50));
}

for($r = 0 ;$r < 20000; $r++) {
	$writer->writeSheetRow('Sheet1', $row);
}

$mem = ['Memory Used', number_format(memory_get_peak_usage(true)/1024/1024, 2 ) . "MB" ];
$writer->writeSheetRow('Sheet1', $mem);

$writer->writeToFile('example-image.xlsx');
echo number_format(memory_get_peak_usage(true)/1024/1024, 2 ) . "MB" .PHP_EOL;
/*
time XDEBUG_MODE=off php example-image.php ; open example-image.xlsx ; ll -h example-image.xlsx
4.00MB (11.2MB reported in system monitor for the php process)

real	2m36.722s
user	2m31.964s
sys	0m5.238s
-rw-rw-r-- 1 vasileios vasileios 1.3G Aug 30 13:17 example-image.xlsx
 */
