<?php
if (!empty($_FILES['excel_file'])) {
    include("../common/database.php");

    $file_array = explode('.', $_FILES['excel_file']['name']);

    if ($file_array[1] == 'xlx') {
        include('PHPExcel/IOFactory.php');
    } else {
    }
}
