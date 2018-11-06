<?php
    
    require '../vendor/autoload.php';
    require("../conn.php");

    $payments = $database->select("payments", [
	"ref",
	"amount",
	"time",
	"mode",
	"customer_ID",
    ]);

    
    $result = [];

    $i = 0;
    foreach ($payments as $key => $value) {
       $customers = $database->select("customers", [
            "first_name",
            "last_name", ],

            [
                "customer_ID" => $value['customer_ID']
            ]
        );
       
        $result[$i] = array_merge($value, $customers[0]);
        $i++;
    }

     use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
   //show($result);

    if (isset($_GET['download'])) {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Ref');
    $sheet->setCellValue('B1', 'Amount');
    $sheet->setCellValue('C1', 'Time');
    $sheet->setCellValue('D1', 'Mode');
    $sheet->setCellValue('E1', 'First Name');
    $sheet->setCellValue('F1', 'Second Name');
    

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
    

    $letters = ["A", "B", "C", "D", "_", "E", "F"];
  

    foreach ($result as $row_no => $row) {
        $row_num = $row_no + 2;
        
        $i = 0;
       foreach ($row as $key => $value) {
           if ($i == 4 ) {
             
           }

         else{
             
               $sheet->setCellValue($letters[$i].$row_num, $value);
                  
         }
         $i++;
        
       }
    }

    foreach ($letters as $key => $value) {
       if ($key == 4 ) {
           #do nothing
       } else {
           $sheet->getColumnDimension($value)->setAutoSize(true);
       }
       
    }
   

    $writer = new Xlsx($spreadsheet);
    $writer->save('payments.xlsx');

    //force download
    $fullPath = "payments.xlsx";
 
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