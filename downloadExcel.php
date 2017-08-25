<?php session_start();

	require_once("lib/ExcelFiles/PHPExcel/IOFactory.php");
	$phpExcels = new PHPExcel();

	// Set Sheet To Work
	$phpExcels->setActiveSheetIndex(0);

	// Set Titles [Start From 1st ROW]
		$phpExcels->getActiveSheet()->SetCellValue("A1", "Sr.");
		$phpExcels->getActiveSheet()->SetCellValue("B1", "User Name");
		$phpExcels->getActiveSheet()->SetCellValue("C1", "Name");
		$phpExcels->getActiveSheet()->SetCellValue("D1", "Tweets");
		$phpExcels->getActiveSheet()->SetCellValue("E1", "Created ON");
		// Set With Of Columns
			$phpExcels->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
			$phpExcels->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
			$phpExcels->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
			$phpExcels->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
		
		// Set Heading & Alignments
			$phpExcels->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);
			$phpExcels->getActiveSheet()->getStyle("A1:E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// Set Header And Footer
		$phpExcels->getActiveSheet()->getHeaderFooter()->setOddHeader("&LTweets Of : ".$_SESSION["dUserScreen"]);
		$phpExcels->getActiveSheet()->getHeaderFooter()->setOddFooter('&CPage &P of &N');


	// Set Values [Start From 2nd ROW]
		$col = 1;
		$sr = 0;
		foreach($_SESSION["downloadData"] as $data) {
			$sr++;
			$col++;
			$phpExcels->getActiveSheet()->SetCellValue("A".$col, $sr);
			$phpExcels->getActiveSheet()->SetCellValue("B".$col, $data["screen_name"]);
			$phpExcels->getActiveSheet()->SetCellValue("C".$col, $data["name"]);
			$phpExcels->getActiveSheet()->SetCellValue("D".$col, $data["text"]);
			$phpExcels->getActiveSheet()->SetCellValue("E".$col, $data["time"]);
		}


	// Set Title For SHEET
		$phpExcels->getActiveSheet()->setTitle('Tweets Details');
	


		//Download File
	$obj = new PHPExcel_Writer_Excel2007($phpExcels);
	$obj->save("files/Tweets.xlsx"); 

	$file_name = "Tweets.xlsx";
	$file_path = "files/".$file_name;
	download_file($file_path, $file_name);


	function download_file($file_path, $file_name)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$file_name);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        ob_clean();
        flush();
        readfile($file_path);
        exit;
    }





 ?>