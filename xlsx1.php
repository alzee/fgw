<?php
/**
 * vim:ft=php
 * @author Dotcra <dotcra@gmail.com>
 * @version
 * @todo
 */
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$spreadsheet = new Spreadsheet();

foreach ($tables as $k => $table) {
	$spreadsheet->createSheet();
	$sheet=$spreadsheet->getSheet($k);
	$sheet->setTitle("$table[1]");
	$thead[0] = $table[1];
	// thead;
	$sheet->fromArray($thead, NULL);
	// tbody;
	$i=2;
	foreach ($table[2] as $t) {
		$sheet->setCellValueByColumnAndRow(1, $i, $t[$table[0]]);
		$sheet->setCellValueByColumnAndRow(2, $i, $t['count']);
		$sheet->setCellValueByColumnAndRow(3, $i, $t['count_wip']);
		$sheet->setCellValueByColumnAndRow(4, $i, "=C{$i}/B{$i}");
		$sheet->setCellValueByColumnAndRow(5, $i, $t['sum_plan']);
		$sheet->setCellValueByColumnAndRow(6, $i, $t['sum_accum']);
		$sheet->setCellValueByColumnAndRow(7, $i, "=F{$i}/E{$i}");
		$i++;
	}
	// tfoot;
	$ii = $i-1;
	$sheet->setCellValueByColumnAndRow(1, $i, '合计');
	$sheet->setCellValueByColumnAndRow(2, $i, "=SUM(B2:B{$ii})");
	$sheet->setCellValueByColumnAndRow(3, $i, "=SUM(C2:C{$ii})");
	$sheet->setCellValueByColumnAndRow(4, $i, "=C{$i}/B{$i}");
	$sheet->setCellValueByColumnAndRow(5, $i, "=SUM(E2:E{$ii})");
	$sheet->setCellValueByColumnAndRow(6, $i, "=SUM(F2:F{$ii})");
	$sheet->setCellValueByColumnAndRow(7, $i, "=F{$i}/E{$i}");
	
	// style;
	// thead and tfoot bold;
	$sheet->getStyle('A1:G1')->applyFromArray(['font'=>['bold'=>true]]);
	$sheet->getStyle("A{$i}:G{$i}")->applyFromArray(['font'=>['bold'=>true]]);
	// autowidth not working?
	// $sheet->getColumnDimension('A')->setAutoSize(true);
	// number format percent;
	$sheet->getStyle("D2:D{$i}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
	$sheet->getStyle("G2:G{$i}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
	// borders and center horizontally to the whole sheet;
	$style = [
		'borders'=>[
			'allBorders'=>[
				'borderStyle'=>Border::BORDER_THIN
			]
		],
		'alignment'=>[
			'horizontal'=>Alignment::HORIZONTAL_CENTER
		]
	];
	$sheet->getStyle("A1:G{$i}")->applyFromArray($style);
}

// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer = new Xlsx($spreadsheet);
$writer->save('xlsx/stat.xlsx');
