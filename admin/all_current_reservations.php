<?php

    require '../vendor/autoload.php';
    require("../conn.php");
    $reservations = $database->select("reservations", [
	"reservation_ID",
	"date",
	"expected_checkin_date",
	"expected_checkout_date",
	"room_ID",
	"customer_ID",
	
    ]);

   
    $result = [];
    foreach ($reservations as $key => $value) {
        $names =  $database->select("customers", [
        "first_name",
        "last_name",
        
        ], [
            "customer_ID" => $reservations[$key]['customer_ID']
        ]);

        $rooms =  $database->select("rooms", [
        "room_no",
        "type",
        
        ], [
            "room_ID" => $reservations[$key]['room_ID']
        ]);

        $complete_reservation = array_merge($reservations[$key], $names[0], $rooms[0]);
        $result[$key] = $complete_reservation;
    }

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
   //show($result);

    if (isset($_GET['download'])) {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Reservation ID');
    $sheet->setCellValue('B1', 'Date Made');
    $sheet->setCellValue('C1', 'Check in Date');
    $sheet->setCellValue('D1', 'Check out Date');
    $sheet->setCellValue('E1', 'First Name');
    $sheet->setCellValue('F1', 'Second Name');
    $sheet->setCellValue('G1', 'Room Number');
    $sheet->setCellValue('H1', 'Room type');

    $styleArray = [
    'font' => [
        'bold' => true,
        'size' => 13,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ]
];
    $sheet->getStyle('A1:H1')->applyFromArray($styleArray);
    

    $letters = ["A", "B", "C", "D", "_", "_", "E", "F", "G", "H"];
  

    foreach ($result as $row_no => $row) {
        $row_num = $row_no + 2;
        
        $i = 0;
       foreach ($row as $key => $value) {
           if ($i == 4 || $i == 5) {
             
           }

         else{
             
               $sheet->setCellValue($letters[$i].$row_num, $value);
                  
         }
         $i++;
        
       }
    }

    foreach ($letters as $key => $value) {
       if ($key == 4  || $key == 5) {
           #do nothing
       } else {
           $sheet->getColumnDimension($value)->setAutoSize(true);
       }
       
    }
   

    $writer = new Xlsx($spreadsheet);
    $writer->save('reservations.xlsx');

    //force download
    $fullPath = "reservations.xlsx";
 
    if ($fd = fopen ($fullPath, "r")) {
        $fsize = filesize($fullPath);
        $path_parts = pathinfo($fullPath);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext) {
            case "pdf":
            header("Content-type: application/pdf"); 
            header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
            break;
            default; // Other document formats (doc, docx, odt, ods etc)
            header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
        }
        header("Content-length: $fsize");
        header("Cache-control: private"); //use this to open files directly
        while(!feof($fd)) {
            $buffer = fread($fd, 2048);
            echo $buffer;
        }
    }
    fclose ($fd);
    exit;

    } else {
      echo json_encode($result);
    }
    

?>