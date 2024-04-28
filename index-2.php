<?php
 
//12 15 20 90 90 CGAGCGACGTGCTGCATGCACATGCG
    if ($_POST["MinValue"] != NULL) { $MinValue = $_POST["MinValue"]; } else { $MinValue = "13"; }
    if ($_POST["MaxValue"] != NULL) { $MaxValue = $_POST["MaxValue"]; } else { $MaxValue = "20"; }
    if ($_POST["MinTm"] != NULL) { $MinTm = $_POST["MinTm"]; } else { $MinTm = "65"; }
    if ($_POST["MaxTm"] != NULL) { $MaxTm = $_POST["MaxTm"]; } else { $MaxTm = "80"; }
    if ($_POST["purValue"] != NULL) { $purValue = $_POST["purValue"]; } else { $purValue = "60"; }
    if ($_POST["InsertString"] != NULL) { $InsertString = $_POST["InsertString"]; } else { $InsertString = "TAGTTATTAATAGTAATCAATTACGGGGTCATTAGTTCATAGCCCATATATGGAGTTCCGCGTTACATAACTTACGGTAAATGGCCCGGACGTCAATAATGAC"; }

//    if (isset($_POST["reset"])) {
//       $MinValue = "12";
//       $MaxValue = "15";
//       $MinTm = "20";
//       $MaxTm = "90";
//       $purValue = "90";
//       $InsertString = "CGAGCGACGTGCTGCATGCACATGCG";
//
//    }

    //echo "<form action='thinggg.php' method='post'>";
   echo "<form action='https://www.pnabio.com/support/index-2.php' method='post' onsubmit='submitButton.disabled=true; return true;' >";
   echo "<div style='padding: 10px 0px;'>";
   echo "<font style='font-family:Verdana; font-size:14px;' color='#015182'><b>PNA Sequence </font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(mininum 10 bp, maximum 100 bp):</font><br>";
   echo "</div>";
   echo "<input style='width:100%' type='text' name='InsertString' value='$InsertString' size='500'><br><br>";
   echo "<table>";
   echo "<tbody>";
   echo "<tr height='20px'>";
   echo    " <td style='width:320px; text-align:left;font-family:Verdana; font-size:13px; vertical-align:middle; color:#015182'><b>Minimum PNA Length </font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(bp)</font></td>";
   echo      "<td style='width:320px; text-align:left; font-family:Verdana; font-size:13px; vertical-align:middle; color:#015182'><b>Maximum PNA Length </font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(bp)</font></td>";
   echo   "</tr>";

   echo  "<tr height='10px'>";
   echo      "<td style='padding:3px;text-align:left'><input type='text' name='MinValue' value='$MinValue' size='7'></td>";
   echo      "<td style='padding:3px;text-align:left'><input type='text' name='MaxValue' value='$MaxValue' size='7'></td>";
   echo  "</tr>";
   echo  "</tbody>";
   echo 	"</table>";

   echo "<table>";
   echo "<tbody>";
   echo "<tr height='20px'>";
   echo    " <td style='width:320px; text-align:left;font-family:Verdana; font-size:13px; vertical-align:middle; color:#015182'><b>Enter Minimum Tm desired </font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(<sup>o</sup>C)</font></td>";
   echo      "<td style='width:320px; text-align:left; font-family:Verdana; font-size:13px; vertical-align:middle; color:#015182'><b>Enter Maximum Tm desired</font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(<sup>o</sup>C)</font></td>";
   echo   "</tr>";

   echo  "<tr height='10px'>";
   echo      "<td style='padding:3px;text-align:left'><input type='text' name='MinTm' value='$MinTm' size='7'></td>";
   echo      "<td style='padding:3px;text-align:left'><input type='text' name='MaxTm' value='$MaxTm' size='7'></td>";
   echo  "</tr>";
   echo  "</tbody>";
   echo 	"</table>";


   echo "<table>";
   echo "<tbody>";
   echo "<tr height='20px'>";
   echo    " <td style='width:320px; text-align:left;font-family:Verdana; font-size:13px; vertical-align:middle; color:#015182'><b>Enter Maximum purine content</font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(%)</font></td>";
   echo   "</tr>";

   echo  "<tr height='10px'>";
   echo      "<td style='padding:3px;text-align:left'><input type='text' name='purValue' value='$purValue' value='65' size='7'></td>";
   echo  "</tr>";
   echo  "</tbody>";
   echo "</table>";


   echo "<br>";
   echo "<input type='submit'>";
   echo "</form>";


//    $MinValue = $_POST[$MinValue];
//    $MaxValue = $_POST[$MaxValue];
//    $MinTm = $_POST[$MinTm];
//    $MaxTm = $_POST[$MaxTm];
//    $purValue = $_POST[$purValue];
//    $InsertString = $_POST[$InsertString];

   //echo $MinValue ." ". $MaxValue ." ". $MinTm ." ". $MaxTm ." " . $purValue . " " . $InsertString ."\n";

   if (isset($_POST["MinValue"]) && isset($_POST["MaxValue"]) && isset($_POST["MinTm"]) &&
       isset($_POST["MaxTm"]) && isset($_POST["purValue"]) && isset($_POST["InsertString"]) && !isset($_POST["reset"])) {

//      echo "<br><br>" . $MinValue ." ". $MaxValue ." ". $MinTm ." ". $MaxTm ." " . $purValue . " " . $InsertString ."\n";

      $inputFile = tempnam("/tmp", "input_");
      $outputFile = tempnam("/tmp", "output_");
      $handle = fopen($inputFile, "w");
      fwrite($handle, $MinValue ." ". $MaxValue ." ". $MinTm ." ". $MaxTm ." " . $purValue . " " . $InsertString ."\n");
      fclose($handle);

      chmod($inputFile, 0777);

      //$cmd = "cat ". $inputFile ." | /usr/bin/python /home/pnabio/public_html/support/PythonDNAProject.py > ". $outputFile;
      $cmd = "cat ". $inputFile ." | /usr/bin/python /home/pnabioco/public_html/support/PythonDNAProject.py > ". $outputFile;

//      echo "<br><br>";
//      echo $cmd;
//      echo "<br><br>";

      unset($out);
      exec(trim($cmd), $out);
//      for ($i = 0; $i < count($out); $i++) { echo $out[$i]."<br>\n"; }

//      $json = file_get_contents($outputFile);
      $json = file_get_contents("/tmp/data.json");
      $json_data = json_decode($json);                

      //unlink($inputFile);       
      //unlink($outputFile);

      //echo "<br><br>"; var_dump($json_data);

//      echo "<br><br>---start---<br><br>";
      //echo $json_data['Length'];

//      echo "<br><br>Purine Stretch<br>"; 
      $out = $json_data->{'TM'}; 
      for ($i = 0; $i < count($out); $i++) {  }

//      echo "<br><br>Purine Content<br>";
//      $out = $json_data->{'Purine Content'};
//      for ($i = 0; $i < count($out); $i++) { echo $out[$i]."<br>\n"; }

//      echo "<br><br>Sequence Number<br>";
//      $out = $json_data->{'Sequence Number'};
//      for ($i = 0; $i < count($out); $i++) { echo $out[$i]."<br>\n"; }

//      echo "<br><br>Sequence<br>";
//      $out = $json_data->{'Sequence'};
//      for ($i = 0; $i < count($out); $i++) { echo $out[$i]."<br>\n"; }

//      echo "<br><br>TM<br>";
//      $out = $json_data->{'TM'};
//      for ($i = 0; $i < count($out); $i++) { echo $out[$i]."&deg;C<br>\n"; }

//      echo "<br><br>---done---<br><br>";
      $tmpfname = tempnam("/tmp", "PythonPtest");
      unlink($tmpfname);

    

     echo "<style>";
     echo "table {";
     echo   "font-family: verdana;";
     echo   "border-collapse: collapse;";
     echo   "width: 100%;";
     echo   "font-size: 15px;";
     echo "}";

     echo "td, th {";
     echo   "border: 1px solid #CCCCCC;";
     echo   "text-align: left;";
     echo   "padding: 8px;";
     echo "}";
       
     echo "caption {";
     echo   "padding: 8px;";
     echo   "font-weight: bold;";
     echo "}";

     echo "tr:nth-child(even) {";
     echo   "background-color: #CCCCCC;";
     echo "}";
     echo "</style>";
     echo "<table>";
     echo   "<caption>Selected PNA sequences</caption>";
     echo  "<tr>";
     echo    "<th>No.</th>";
     echo    "<th>Sequence</th>";
     echo    "<th>Position</th>";
     echo    "<th>Base Count</th>";
     echo    "<th>Purine Content (%)</th>";
     echo    "<th>Purine Stretch</th>";
     echo    "<th>Tm (&deg;C)</th>";
     echo  "</tr>";
     for ($i = 0; $i < count($out); $i++) {
        echo  "<tr>";
        $out = $json_data->{'Sequence Number'};
        echo    "<td>$out[$i]</td>";
        $out = $json_data->{'Sequence'};
        echo    "<td>$out[$i]</td>";
        $out = $json_data->{'Position'};
        echo    "<td>$out[$i]</td>";
        $out = $json_data->{'Base Count'};
        echo    "<td>$out[$i]</td>";
        $out = $json_data->{'Purine Content'};
        echo    "<td>$out[$i]</td>";
        $out = $json_data->{'Purine Stretch'};
        echo    "<td>$out[$i]</td>";
        $out = $json_data->{'TM'};
        echo    "<td>$out[$i]</td>";
        echo  "</tr>";
     }
     echo "</table>";
     fclose($handle);
   
   }
        
?>


