<?php

		 require_once(APPPATH.'helpers/TCPDF/tcpdf.php');

		 /**
 * 
 */
class PDF extends TCPDF
{
	
	public function Header(){

		$imageFile = base_url().'assets/Oroquieta.png';
		$qr_code = base_url().'uploads/qr_codes/hey/sample_qr.png';
		$this->Image($imageFile, 20, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->Image($qr_code, 170, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		$this->Ln(5);
		$this->SetFont('timesI','B',12);
		$this->Cell(189, 5, 'Republic of the Philippines', 0, 1, 'C');
		$this->SetFont('helvetica', 'B', 12);
		$this->Cell(189, 3, 'CITY GOVERNMENT OF OROQUIETA', 0, 1, 'C');
		$this->SetFont('helvetica', '', 12);
		$this->Cell(189, 3, 'Oroquieta City, Misamis Occidental', 0, 1, 'C');
		$this->SetFont('helvetica', '', 10);
		$this->SetTextColor(245, 10, 10);	
		$this->Cell(189, 3, 'City of Good Life', 0, 1, 'C');
		$this->Ln(4);
		$this->SetFont('helvetica','B',12);
		$this->SetTextColor(0, 0, 0);	
		$this->Cell(189, 5, 'CERTIFICATION ON', 0, 1, 'C');
		$this->Cell(189, 5, 'APPROPRIATIONS, FUNDS, AND OBLIGATION OF ALLOTMENT', 0, 1, 'C');





	}

	public function Footer(){
		
	}
}



		 $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);


		 //set document information
		 $pdf->SetCreator(PDF_CREATOR);
		 $pdf->SetAuthor('Basil');
		 $pdf->SetTitle('bass');
		 $pdf->SetSubject('bass');
		 $pdf->SetKeywords('TCPDF','PDF', 'example', 'test', 'guide');


		// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}



// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
// $pdf->SetFont('dejavusans', '', 14, '', true);




// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->Ln(26);


// -----------------------------------------------------------------------------


$pdf->SetFont('helvetica', '', 8);

$contents = file_get_contents(APPPATH.'views/table.html');



// $contents = '

// <style>
		

// 		.left-cell {
// 			text-align : center;
		
	


			
// 		}

// 		.budget-officer {

// 				text-transform: uppercase;
// 				font-size: 1em; 
// 				font-weight: bold;
// 				text-decoration: underline;
// 			}
		
// </style>




// <table  border="1"  >
// <tr>
// 	<td>
// <div class="left-cell" >
		
	
		

		
// 			<h1 class="budget-officer" >Eleuterio L. Blasco Jr., CPA, Reb, Rea,</h1>
		

// 		</div>


// 	</td>
// 	<td>asd</td>
// </tr>
  
// ';













// $contents .= '</table>
// <br>';


$pdf->writeHTML($contents);
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

 ?>