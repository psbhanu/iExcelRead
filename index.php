<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'lib/PHPExcel/IOFactory.php';
$file = dirname(__File__). DIRECTORY_SEPARATOR . 'test.xls';
$inputFileType = PHPExcel_IOFactory::identify($file);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setReadDataOnly(true);
$objPHPExcel = $objReader->load($file);
$objWorksheet = $objPHPExcel->getActiveSheet();
$CurrentWorkSheetIndex = 0;

echo '<pre>';
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    // echo 'WorkSheet' . $CurrentWorkSheetIndex++ . "\n";
	//print_r(get_class_methods($worksheet)); //exit;
    echo 'Worksheet number - ', $objPHPExcel->getIndex($worksheet), PHP_EOL;
    echo 'Worksheet Title - ', $worksheet->getTitle($worksheet), PHP_EOL;
    $highestRow = $worksheet->getHighestDataRow();
    $highestColumn = $worksheet->getHighestDataColumn();
    $headings = $worksheet->rangeToArray('A1:' . $highestColumn . 1, NULL, TRUE, FALSE);

    for ($row = 2; $row <= $highestRow; $row++) {
        $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        $rowData[0] = array_combine($headings[0], $rowData[0]);
        print_r($rowData);
    }
}
echo '</pre>';
