<?php
App::import('Vendor', 'tcpdf/tcpdf');
ob_start();
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF("P", "mm", "A4", true, "UTF-8" );  
$font = new TCPDF_FONTS();
$font3 = $font->addTTFfont('./fonts/ipamp.ttf', 'TrueTypeUnicode', '', 32);
$pdf->AddPage();
$pdf->SetFont($font3, '', 14);
$pdf->SetMargins(10, 10, true);
$header  = '<div style="padding:50px">'.$evSchedule[0]['ev_events']['name'].'</div>';
$header .= '<div　style="margin:0 100px">'.$evSchedule[0]['ev_schedules']['holding_date'].'～'.$evSchedule[0]['ev_schedules']['end_date'].'</div>';
$pdf->writeHTML($header, true, 0, true, 0);  


$html  = '<table border="0.5" cellpadding="3">';
$html  .= '<tr align="center" bgcolor="#cccccc">';
$html  .= ' <th width="50px" rowspan="3">ID</th>';
$html  .= ' <th width="80px" rowspan="2">氏名</th>';
$html  .= ' <th width="150px">大学名</th>';
$html  .= ' <th width="80px">電話番号</th>';
$html  .= ' <th width="150px" rowspan="2">携帯メール</th>';
$html  .= ' <th width="30px" rowspan="3">出欠欄</th>';
$html  .= '</tr>';
$html  .= '<tr align="center" bgcolor="#cccccc">';
$html  .= ' <th>学部</th>';
$html  .= ' <th>携帯番号</th>';
$html  .= '</tr>';
$html  .= '<tr align="center" bgcolor="#cccccc">';
$html  .= ' <th>スコア</th>';
$html  .= ' <th colspan="3">コメント</th>';
$html  .= '</tr>';
foreach ($evSchedule as $schedule) {

	$html  .= '<tr>';
	$html  .= ' <td rowspan="3" align="center">'.$schedule['can_candidates']['id'].'</td>';
	$html  .= ' <td rowspan="2">'.$schedule['can_candidates']['last_name'].' '.$schedule['can_candidates']['first_name'].'</td>';
	$html  .= ' <td>'.$schedule[0]['school_name'].'</td>';// 仮
	$html  .= ' <td align="left">'.$schedule['can_candidates']['tel'].'</td>';
	$html  .= ' <td rowspan="2" align="left">'.$schedule['can_candidates']['cell_mail'].'</td>';
	$html  .= ' <td rowspan="3"></td>';
	$html  .= '</tr>';
	$html  .= '<tr valign="middle">';
	$html  .= ' <td>'.$schedule[0]['undergraduate'].'</td>';// 仮
	$html  .= ' <td align="left">'.$schedule['can_candidates']['cell_number'].'</td>';
	$html  .= '</tr>';
	$html  .= '<tr valign="middle">';
	$html  .= ' <td></td>';
	$html  .= ' <td colspan="3"></td>';
	$html  .= '</tr>';
}

$html  .= '</table>';

$pdf->SetFont($font3, '', 8);
$pdf->SetMargins(0, 0, true);
$pdf->writeHTML($html, true, 0, true, 0);  
ob_end_clean();
$pdf->Output('EventAttendance.pdf', 'I');
