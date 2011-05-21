<?php 
require_once(APP."plugins".DS."excel".DS."vendors".DS."PHPExcel".DS."Classes".DS."PHPExcel.php");

class ExcelHelper extends AppHelper{
	var $xls;
	var $name;
	function init($properties=array()){
		if(!empty($properties['name'])) $this->name=$properties['name'];
		else $this->name="excelDownload";
		// Create new PHPExcel object
		$this->xls = new PHPExcel();
		/*if($properties){
			$this->xls->getProperties()	 ->setCreator("Maarten Balliauw")
										 ->setLastModifiedBy("Maarten Balliauw")
										 ->setTitle("Office 2007 XLSX Test Document")
										 ->setSubject("Office 2007 XLSX Test Document")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Test result file");		
		}
		*/
	}

	function output(){
		$this->xls->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$this->name.'.xls"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->xls, 'Excel5');
		$objWriter->save('php://output');	
	}
}?>