<?php
   if ($_POST["pna"] != NULL) { $pnaseq = $_POST["pna"]; } else { $pnaseq = ""; }
   if ($_POST["aa"] != NULL) { $aaseq = $_POST["aa"]; } else { $aaseq = ""; }

   echo "<form action='PNA_Tool.php' method='post'>";
   //echo "<font face='verdana' size='3' color='#015182' >Enter PNA sequence (e.g., CAGTCCAGTT): </font><br>";
   echo "<div style='padding: 10px 0px;'><font style='font-family:Verdana; font-size:14px;' color='#015182'><b>Enter PNA sequence </font></b> <font style='font-family:Verdana; font-size:12px;' color'#333333'>(e.g., CAGTCCAGTT):</font></div>";
   echo "<input type='text' name='pna' value='$pnaseq' size='90'><br><br>";
   echo "<div style='padding: 10px 0px;'><font style='font-family:Verdana; font-size:14px;' color='#015182'><b>Enter amino acid sequence and O linker</font></b> <font style='font-family:Verdana; font-size:12px;' color='#333333'>(e.g., KFFKFFXBO, O for AEEA or eg1 linker): </font></div>";
   echo "<input type='text' name='aa' value='$aaseq' size='90'><br><br><input type='submit'><br>";
   echo "</form>";

   //echo "<font face='verdana' color='darkblue'>Click <a href='PNA_Tool_text.htm'>here</a> to go back.<br><br>";
   $aa_mw = 0;
   if ($aaseq != NULL) {
      $as = strtoupper($aaseq); $aaseq = $as; $n = 0;
      for ($i = 0; $i < strlen($as); $i++) {
         if ($as[$i] == "G") { $aa_mw +=  57.05; $n++; }
         if ($as[$i] == "A") { $aa_mw +=  71.09; $n++; }
         if ($as[$i] == "S") { $aa_mw +=  87.08; $n++; }
         if ($as[$i] == "T") { $aa_mw += 101.11; $n++; }
         if ($as[$i] == "C") { $aa_mw += 103.15; $n++; }
         if ($as[$i] == "V") { $aa_mw +=  99.14; $n++; }
         if ($as[$i] == "L") { $aa_mw += 113.16; $n++; }
         if ($as[$i] == "I") { $aa_mw += 113.16; $n++; }
         if ($as[$i] == "M") { $aa_mw += 131.19; $n++; }
         if ($as[$i] == "P") { $aa_mw +=  97.12; $n++; }
         if ($as[$i] == "F") { $aa_mw += 147.18; $n++; }
         if ($as[$i] == "Y") { $aa_mw += 163.18; $n++; }
         if ($as[$i] == "W") { $aa_mw += 186.21; $n++; }
         if ($as[$i] == "D") { $aa_mw += 115.09; $n++; }
         if ($as[$i] == "E") { $aa_mw += 129.12; $n++; }
         if ($as[$i] == "N") { $aa_mw += 114.11; $n++; }
         if ($as[$i] == "Q") { $aa_mw += 128.14; $n++; }
         if ($as[$i] == "H") { $aa_mw += 137.14; $n++; }
         if ($as[$i] == "K") { $aa_mw += 128.17; $n++; }
         if ($as[$i] == "R") { $aa_mw += 156.19; $n++; }
         if ($as[$i] == "O") { $aa_mw += 145.14; $n++; }
         if ($as[$i] == "B") { $aa_mw +=  71.09; $n++; }
         //if ($as[$i] == "X") { $aa_mw += 114.16; $n++; }
         if ($as[$i] == "X") { $aa_mw += 113; $n++; }
      }
   }
   if ($pnaseq == "Please enter a PNA.") {
/*
      echo "<font face='verdana' color='darkblue'>";
      echo "$pnaseq<br>";
      echo "PNA Tool is designed to give information about the property of PNA oligo.<br>";
      echo "<br>";
      echo "You will get a \"<font color='red'>Redesign recommended</font>\" warning if your PNA sequence has one of the following potential issues:<br>";
      echo "<br>";
      echo "1) Too long (>30mer).<br>";
      echo "2) Containing >6 purine stretches.<br>";
      echo "3) High purine content (>60%).<br>";
      echo "4) Significant complementary sequence (>7 bp).<br>";
      echo "<br>";
      echo "Please consult us if your PNA sequence cannot be revised.<br>";
      echo "<br>";
      echo "Thank you.<br></font>";
*/
   } else if ($pnaseq == NULL) {
      $fontColor = "<font face='verdana' color='black' size='2'>";
	  $fontColor2 = "<font face='verdana' size='2'>";
      $bgColor = "CCCCCC";
      echo "<table class='pnatable' border='0'>";
      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor AA Sequence</td><td>$fontColor $aaseq</td></tr>";
      echo "<tr height='35px' ><td>$fontColor Molecular Weight</td><td>$fontColor $aa_mw</td></tr>";
      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor </td><td>$fontColor </td></tr>";
      echo "</table>";
   } else if ($pnaseq != NULL) {
$pnaseq = preg_replace('/[U,u]/','T',$pnaseq);
      $pna = "";
      $ps = strtoupper($pnaseq);
      for ($i = 0; $i < strlen($ps); $i++) {
         if (($ps[$i] == "A") || ($ps[$i] == "T") || ($ps[$i] == "G") || ($ps[$i] == "C")) { $pna .= $ps[$i]; }
      }
      $na = $nt = $ng = $nc = 0;
      for ($i = 0; $i < strlen($pna); $i++) {
         if ($pna[$i] == "A") { $na++; }
         else if ($pna[$i] == "T") { $nt++; }
         else if ($pna[$i] == "G") { $ng++; }
         else if ($pna[$i] == "C") { $nc++; }
      }
      $n = $na + $nt + $ng + $nc;
      $g_content = $ng; $g_content = $g_content/$n*100;
      $output = "Base = " . $n; // base count
      $f = $na; $f = $f/$n*100; $output .= "|A = ".$na." (".number_format($f,1,".","")."%) "; // adenine composition
      $f = $nt; $f = $f/$n*100; $output .= ";T = ".$nt." (".number_format($f,1,".","")."%) "; // thymine composition
      $f = $ng; $f = $f/$n*100; $output .= ";G = ".$ng." (".number_format($f,1,".","")."%) "; // guanine composition
      $f = $nc; $f = $f/$n*100; $output .= ";C = ".$nc." (".number_format($f,1,".","")."%) "; // cytosine composition

      $f = $na+$ng; $f = $f/$n*100; $output .= "|Purines = ".number_format($f,1,".","")." %"; // purines percent
      $f = $nc+$nt; $f = $f/$n*100; $output .= "|Pyrimidines = ".number_format($f,1,".","")." %"; // pyrimidines percent

      $numc = $numh = $numn = $numo = 0;
      if ($na > 0) { $numc += $na * 11; $numh += $na * 13; $numn += $na * 7; $numo += $na * 2; }
      if ($nt > 0) { $numc += $nt * 11; $numh += $nt * 14; $numn += $nt * 4; $numo += $nt * 4; }
      if ($ng > 0) { $numc += $ng * 11; $numh += $ng * 13; $numn += $ng * 7; $numo += $ng * 3; }
      if ($nc > 0) { $numc += $nc * 10; $numh += $nc * 13; $numn += $nc * 5; $numo += $nc * 3; }
      $numh += 3; $numn += 1;

      $output .= "|C".$numc."H".$numh."N".$numn."O".$numo; // chemical formula
      $f = $numc*12.0107+$numh*1.00794+$numn*14.0067+$numo*15.9994; $pna_mw=$f; $output .= "|".number_format($f,1,".",""); // molecular weight
      $f = $ng+$nc; $f = $f/$n*100; $output .= "|GC = ".number_format($f,1,".","")." %"; // gc content
      $f = $na*13.7+$nc*6.6+$ng*11.7+$nt*8.8; $output .= "|EC = ".$f." ml/(umole*cm)"; // extinction coefficient
      $f = 1000/$f; $output .= "|1ODU = ".number_format($f,1,".","")." nmole";  // 1 ODU

      // unified Allawi et al, Biochemistry 1997, 36, 10581-10594
      $SEQ['H AA'] =  "-7.9"; $SEQ['S AA'] = "-22.2"; $SEQ['G AA'] = "-1.00";
      $SEQ['H AT'] =  "-7.2"; $SEQ['S AT'] = "-20.4"; $SEQ['G AT'] = "-0.88";
      $SEQ['H TA'] =  "-7.2"; $SEQ['S TA'] = "-21.3"; $SEQ['G TA'] = "-0.58";
      $SEQ['H CA'] =  "-8.5"; $SEQ['S CA'] = "-22.7"; $SEQ['G CA'] = "-1.45";
      $SEQ['H GT'] =  "-8.4"; $SEQ['S GT'] = "-22.4"; $SEQ['G GT'] = "-1.44";
      $SEQ['H CT'] =  "-7.8"; $SEQ['S CT'] = "-21.0"; $SEQ['G CT'] = "-1.28";
      $SEQ['H GA'] =  "-8.2"; $SEQ['S GA'] = "-22.2"; $SEQ['G GA'] = "-1.30";
      $SEQ['H CG'] = "-10.6"; $SEQ['S CG'] = "-27.2"; $SEQ['G CG'] = "-2.17";
      $SEQ['H GC'] =  "-9.8"; $SEQ['S GC'] = "-24.4"; $SEQ['G GC'] = "-2.24";
      $SEQ['H GG'] =  "-8.0"; $SEQ['S GG'] = "-19.9"; $SEQ['G GG'] = "-1.84";
      // reverse
      $SEQ['H TT'] =  "-7.9"; $SEQ['S TT'] = "-22.2"; $SEQ['G TT'] = "-1.00";
      $SEQ['H AT'] =  "-7.2"; $SEQ['S AT'] = "-20.4"; $SEQ['G AT'] = "-0.88";
      $SEQ['H TA'] =  "-7.2"; $SEQ['S TA'] = "-21.3"; $SEQ['G TA'] = "-0.58";
      $SEQ['H TG'] =  "-8.5"; $SEQ['S TG'] = "-22.7"; $SEQ['G TG'] = "-1.45";
      $SEQ['H AC'] =  "-8.4"; $SEQ['S AC'] = "-22.4"; $SEQ['G AC'] = "-1.44";
      $SEQ['H AG'] =  "-7.8"; $SEQ['S AG'] = "-21.0"; $SEQ['G AG'] = "-1.28";
      $SEQ['H TC'] =  "-8.2"; $SEQ['S TC'] = "-22.2"; $SEQ['G TC'] = "-1.30";
      $SEQ['H CG'] = "-10.6"; $SEQ['S CG'] = "-27.2"; $SEQ['G CG'] = "-2.17";
      $SEQ['H GC'] =  "-9.8"; $SEQ['S GC'] = "-24.4"; $SEQ['G GC'] = "-2.24";
      $SEQ['H CC'] =  "-8.0"; $SEQ['S CC'] = "-19.9"; $SEQ['G CC'] = "-1.84";

      $INI['H GC'] = "0.1"; $INI['S GC'] = "-2.8"; $INI['G GC'] = "0.98";
      $INI['H AT'] = "2.3"; $INI['S AT'] = "4.1"; $INI['G AT'] = "1.03";
      $SYM['H'] = "0.0"; $SYM['S'] = "-1.4"; $SYM['G'] = "0.4";

      $cpna = "";
      for ($i = strlen($pna)-1; $i >= 0; $i--) {
         if ($pna[$i] == "A") { $cpna .= "T"; ;}
         else if ($pna[$i] == "T") { $cpna .= "A"; ;}
         else if ($pna[$i] == "G") { $cpna .= "C"; ;}
         else if ($pna[$i] == "C") { $cpna .= "G"; ;}
      }
      $foundSYM = True;
      for ($i = 0; $i < strlen($pna); $i++) {
         if ($pna[$i] != $cpna[$i]) {  $foundSYM = False; break; }
      }

      $delH = 0;
      for ($i = 0; $i < strlen($pna)-1; $i++) {
         $m = "H " . $pna[$i] . $pna[$i+1]; $delH += $SEQ[$m];
      }
      if (($pna[0] == "G") || ($pna[0] == "C"))                         { $delH += $INI['H GC']; }
      if (($pna[strlen($pna)-1] == "G") || ($pna[strlen($pna)-1] == "C")) { $delH += $INI['H GC']; }
      if (($pna[0] == "A") || ($pna[0] == "T"))                         { $delH += $INI['H AT']; }
      if (($pna[strlen($pna)-1] == "A") || ($pna[strlen($pna)-1] == "T")) { $delH += $INI['H AT']; }
      if ($foundSYM) { $delH += $SYM['H']; }
 
      $delS = 0;
      for ($i = 0; $i < strlen($pna)-1; $i++) {
         $m = "S " . $pna[$i] . $pna[$i+1]; $delS += $SEQ[$m];
      }
      if (($pna[0] == "G") || ($pna[0] == "C"))                         { $delS += $INI['S GC']; }
      if (($pna[strlen($pna)-1] == "G") || ($pna[strlen($pna)-1] == "C")) { $delS += $INI['S GC']; }
      if (($pna[0] == "A") || ($pna[0] == "T"))                         { $delS += $INI['S AT']; }
      if (($pna[strlen($pna)-1] == "A") || ($pna[strlen($pna)-1] == "T")) { $delS += $INI['S AT']; }
      if ($foundSYM) { $delS += $SYM['S']; }

      $delG = 0;
      for ($i = 0; $i < strlen($pna)-1; $i++) {
         $m = "G " . $pna[$i] . $pna[$i+1]; $delG += $SEQ[$m];
      }
      if (($pna[0] == "G") || ($pna[0] == "C"))                         { $delG += $INI['G GC']; }
      if (($pna[strlen($pna)-1] == "G") || ($pna[strlen($pna)-1] == "C")) { $delG += $INI['G GC']; }
      if (($pna[0] == "A") || ($pna[0] == "T"))                         { $delG += $INI['G AT']; }
      if (($pna[strlen($pna)-1] == "A") || ($pna[strlen($pna)-1] == "T")) { $delG += $INI['G AT']; }
      if ($foundSYM) { $delG += $SYM['G']; }

      $c0 = 20.79; $c1 = 0.83; $c2 = -26.13; $c3 = 0.44;
      //f = 1000*delH/(delS+1.987*log(0.0001/6)) - 273.15;
      //f = 1000*delH/(delS+1.9865*log(0.0001/6)) - 273.15;
      $C = 0.0001;
      if ($foundSYM == TRUE) {
         $f = 1000*$delH/($delS+1.987*log($C)) - 273.15;
      } else {
         $f = 1000*$delH/($delS+1.987*log($C/4)) - 273.15;
      }

      $f = $c0 + $c1 * $f + $c2 * ($nc+$nt)/$n + $c3 * $n; $output .= "|".number_format($f,1,".","")."";  // Tm
      $output .= "|dH = ".$delH." kcal/mol";     // delta H
      $output .= "|dS = ".$delS." cal/(mol*K)";  // delta S
      $output .= "|dG = ".$delG." kcal/mol";       // delta G

      $m = $pna[0];
      for ($i = 1; $i < strlen($pna); $i++) { $m .= $pna[$i]; }
      $output .= "|" . $m;  // 5 to 3
      $m = $cpna[strlen($cpna)-1];
      for ($i = strlen($cpna)-2; $i >= 0; $i--) { $m .= $cpna[$i]; }
      $output .= "|" . $m;  // 3 to 5
      $m = $cpna[0];
      for ($i = 1; $i < strlen($cpna); $i++) { $m .= $cpna[$i]; }
      $output .= "|" . $m;  // reverse complement

      // originally php wasn't used to generate this.
      list($base_count, $base_comp, $pur_comp, $pyr_comp, $formula, $mw, $gc, $ec, $odu, $tm, $dh, $ds, $dg, $seq, $comp, $reverse) = explode("|",$output);

      $mw += $aa_mw;
/*
echo $output;
$base_count = "1";
$base_comp = "2";
$pur_comp = "3";
$pyr_comp="4";
$formula="5";
$mw="6";
$gc="7";
$ec="8";
$odu="9";
$tm="10";
$dh="11";
$ds="12";
$dg="13";
$seq="15";
$comp="16";
$reverse="17";
*/
      //$aa_mw = $numc*12.0107+$numh*1.00794+$numn*14.0067+$numo*15.9994+$nums*32.065;

/*
      if ($aa_mw > 0) {
         $aa_mw = $aa_mw + (2*1.00794+15.9994);
         $mw += $aa_mw;
      }
*/
/*
echo $aa_mw . "<br>";
echo $pna_mw . "<br>";
echo $pna_mw + $aa_mw . "<br>";
*/
      //$fontColor = "<font color='darkblue'>";
      $fontColor = "<font face='verdana' color='black' size='2'>";
      //$fontColor = "<font face='verdana' color='darkblue'>";
      //$bgColor = "bebebe";
      $bgColor = "CCCCCC";
      //echo "<tr bgcolor=$bgColor>PNA:  $pnaseq<br>"; 
      //echo "<table border='0'>";
      echo "<table  class='fixed pnatable' border='0'>";
      echo "<col width='720px'/>";
      echo "<col width='800px'/>";
      list($tm_a,$tm_b,$tm_c,$tm_d) = explode(" ",$tm);
      //echo "<tr bgcolor=$bgColor><td>$fontColor Tm-1 at 4 uM<a href='http://www.ncbi.nlm.nih.gov/pmc/articles/PMC147916/pdf/265004.pdf' target='_blank'><img src=info.png></a></td><td>$fontColor $tm_c &deg;C</td></tr>";//


      list($b_a,$b_b,$base_count) = explode(" ",$base_count);

$dnatm2 =  4 * ($ng + $nc) + 2 * ($na + $nt);
$dnatm3 =  64.9 + 41 * ($ng + $nc - 16.4)/$base_count;
//echo "$dnatm2<br>\n";
//echo "$dnatm3\n";

      $tm2 = -1.77 * ($ng + $nc) - 2.15 * ($na + $nt) + 50 + $dnatm2;
      $tm3 = -1.77 * ($ng + $nc) - 2.15 * ($na + $nt) + 50 + $dnatm3;

      $pa = strtolower($pnaseq);
      $pa_aa = "";
      for ($i = 0; $i < strlen($pa); $i++) {
         $pa_aa .= $pa[$i];
         if ($i % 3 == 2) { $pa_aa .= " "; }
      }
      $temp = "";
      if (strlen($aaseq) > 0) {
         if ($aaseq[strlen($aaseq)-1] == "O") {
            for ($i = strlen($aaseq)-1; $i >= 0; $i--) {
               $temp .= $aaseq[$i];
            }
         } else {
            for ($i = 0; $i < strlen($aaseq); $i++) {
               $temp .= $aaseq[$i];
            }
         }
         if ($temp[0] == "O") {
            $pa_aa .= " - " . $temp[0] . " - ";
         } else {
            $pa_aa .= " - " . $temp[0];
         }
         for ($i = 1; $i < strlen($temp); $i++) {
            $pa_aa .= $temp[$i];
         }
      }

      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Complete Sequence</td><td>$fontColor $pa_aa</td></tr>";
      echo "<tr height='35px'><td>$fontColor Tm at 4 uM<a href='http://www.ncbi.nlm.nih.gov/pmc/articles/PMC147916/pdf/265004.pdf' target='_blank'><img src=info.png></a></td><td>$fontColor $tm &deg;C</td></tr>";
/* new paper way
echo "<tr><td>$fontColor Tm at 2 uM<a href='http://www.ncbi.nlm.nih.gov/pmc/articles/PMC147916/pdf/265004.pdf' target='_blank'><img src=info.png></a></td><td>$fontColor $tm2 &deg;C</td></tr>";
*/

 /* 14bp Tm result 
		echo "<tr><td>$fontColor Tm < 14 bp</td><td>$fontColor $tm2 &deg;C</td></tr>";
        echo "<tr><td>$fontColor Tm >= 14 bp</td><td>$fontColor $tm3 &deg;C</td></tr>";
*/

/*
      if ($base_count < 14) {
         echo "<tr><td>$fontColor Tm</td><td>$fontColor $tm2 &deg;C</td></tr>";
      } else {
         echo "<tr><td>$fontColor Tm</td><td>$fontColor $tm3 &deg;C</td></tr>";
      }
*/

      //echo "<tr><td>Delta H</td><td>$dh</td></tr>";
      //echo "<tr><td>Delta S</td><td>$ds</td></tr>";
      //echo "<tr><td>Delta G</td><td>$dg</td></tr>";

      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Base Count</td><td>$fontColor $base_count</td></tr>";

      list($base_a,$base_t,$base_g,$base_c) = explode(";",$base_comp);
      echo "<tr height='35px'><td>$fontColor Base Composition</td><td>$fontColor $base_a $base_t<br>$base_g $base_c</td></tr>";

      list($pur_a,$pur_b,$pur_content) = explode(" ",$pur_comp);
      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Purines (%)</td><td>$fontColor $pur_content%</td></tr>";

      list($gc_a,$gc_b,$gc_c,$gc_d) = explode(" ",$gc);
      echo "<tr height='35px'><td>$fontColor GC Content</td><td>$fontColor $gc_c%</td></tr>";

      // purine stretch
      $max = 0; $max_seq = "";
      for ($i = 0; $i < strlen($seq); $i++) {
         if ($seq[$i] == "A" || $seq[$i] == "G") {
            $temp = "";
            for ($j = $i; $j < strlen($seq); $j++) {
               if ($seq[$j] == "A" || $seq[$j] == "G") { $temp .= $seq[$j]; }
               else { break; }
            }
            if (strlen($temp) > $max) { $max = strlen($temp); $max_seq = $temp; }
         }
      }

      $temp = ""; $purine_stretch_count = 0;
      for ($i = 0; $i < strlen($max_seq); $i++) {
         if ($max_seq[$i] == "A" || $max_seq[$i] == "G") { $temp .= $max_seq[$i]; $purine_stretch_count++; }
      }
      if ($purine_stretch_count > 5) {
         echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Purine Stretch</td><td><font color='red'>$purine_stretch_count ($temp)</font></td></tr>";
      } else {
         echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Purine Stretch</td><td>$fontColor $purine_stretch_count ($temp)</td></tr>";
      }

      //echo "<tr><td>Pyrimidines (%)</td><td>$pyr_comp</td></tr>";
      echo "<tr height='35px'><td>$fontColor PNA Chemical Formula</td><td>$fontColor $formula</td></tr>";
      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Molecular Weight (including linker and peptide)</td><td>$fontColor $mw</td></tr>";

      list($ec_a,$ec_b,$ec_c,$ec_d) = explode(" ",$ec);
      echo "<tr height='35px'><td>$fontColor Extinction Coefficient</td><td>$fontColor $ec_c ml/(&#181;mole*cm)</td></tr>";

      list($odu_a,$odu_b,$odu_c,$odu_d) = explode(" ",$odu);
      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor 1 ODU</td><td>$fontColor $odu_c nmole</td></tr>";

      // detect complementary
      //$cutoff = 4;
      $cutoff = 3;
      $max_seq = ""; $n = strlen($seq);
      // move seq
      $comp_count1 = 0; $mm1 = 0; $ii1 = 0;
//echo "$seq<br>";
//echo "$reverse<br>";
      for ($i = 0; $i < $n; $i++) {
         $fragSize = array ();
         $fragPos = array ();
         $fs = 0; $k = 0; $m = 0;
         for ($j = 0; $j < $n; $j++) {
            if ($i+$j < $n) {
               if ($seq[$j] == $reverse[$i+$j]) { $k++; $fs++; }
               else if ($k > 0) {
                  if ($seq[$j-1] == $reverse[$i+$j-1]) { // count the gap
                     $fragSize[$m] = $fs;
                     $fragPos[$m] = $j-$fs;
                     $m++;
                  }
                  $fs = 0;
               }
            } else {
               if ($seq[$j-1] == $reverse[$i+$j-1]) { // count the gap if the frag is at the end
                  $fragSize[$m] = $fs;
                  $fragPos[$m] = $j-$fs;
                  $m++;
               }
               break;
            }
         }
         if ($m > 0) { 
            $fs = 0; $mfs = $fragSize[0];
            if ($m > 2) {
               for ($j = 0; $j < $m-1; $j++) {
                  if (($fragPos[$j] + $fragSize[$j] + 1) == $fragPos[$j+1]) { // only allow one gap
                     $fs = $fragSize[$j] + $fragSize[$j+1];
                     if ($fs > $mfs) { $mfs = $fs; }
                  }
               }
            }
         } else { $mfs = 0; }
         if ($mfs > $comp_count1) { $comp_count1 = $mfs; $ii1 = $i; $mm1 = $m; }
         else if ($mfs == $comp_count1) {
            if ($m < $mm1) {
               $comp_count1 = $mfs; $ii1 = $i; $mm1 = $m;
            }
         }
//echo $i . " match " . $k . " " . $mfs . " gap " . $m . " " . $ii1 . " " . $comp_count1 . "<br>";
      }
//echo $ii1 ." ". $comp_count1 ." ". $mm1 . "<br>";
      $check1 = "";
      for ($i = 0; $i < $n; $i++) {
         if ($ii1+$i < $n) {
            if ($seq[$i] == $reverse[$ii1+$i]) { $check1 .= "1"; } else { $check1 .= "0"; }
         } else { break; }
      }
      for ($j = $i; $j < $n; $j++) { $check1 .= "0"; }
//echo "$check1<br>";
      // make a copy for allowing one mismatch
      //$check11 = "";
      //for ($i = 0; $i < $n; $i++) { if ($check1[$i] == "1") { $check11 .= "1"; } else { $check11 .= "0"; } }
      // remove nonstretching complements
      $i = 0;
      while ($i < $n) {
         if ($check1[$i] == "1") {
            $k = 0;
            for ($j = $i; $j < $n; $j++) {
               if ($check1[$j] == "1") { $k++; } else { break; }
            }
            if ($k <= $cutoff) { // less than cutoff, flag them so can be colored later
               for ($j = $i; $j < $i+$k; $j++) {
                  if ($k == 1) { $check1[$j] = "0"; }
                  else { $check1[$j] = $k; }
               }
            }
            $i = $i + $k;
         } else { $i++; }
      }

      // move reverse
      $comp_count2 = 0; $mm2 = 0; $ii2 = 0;
      for ($i = 0; $i < $n; $i++) {
         $fragSize = array ();
         $fragPos = array ();
         $fs = 0; $k = 0; $m = 0;
         for ($j = 0; $j < $n; $j++) {
            if ($i+$j < $n) {
               if ($seq[$i+$j] == $reverse[$j]) { $k++; $fs++;  }
               else if ($k > 0) {
                  if ($seq[$i+$j-1] == $reverse[$j-1]) { // count the gap
                     $fragSize[$m] = $fs;
                     $fragPos[$m] = $j-$fs;
                     $m++;
                  }
                  $fs = 0;
               }
            } else {
               if ($seq[$i+$j-1] == $reverse[$j-1]) { // count the gap if the frag is at the end
                  $fragSize[$m] = $fs;
                  $fragPos[$m] = $j-$fs;
                  $m++;
               }
               break;
            }
         }
         if ($m > 0) { 
            $fs = 0; $mfs = $fragSize[0];
            if ($m > 2) {
               for ($j = 0; $j < $m-1; $j++) {
                  if (($fragPos[$j] + $fragSize[$j] + 1) == $fragPos[$j+1]) { // only allow one gap
                     $fs = $fragSize[$j] + $fragSize[$j+1];
                     if ($fs > $mfs) { $mfs = $fs; }
                  }
               }
            }
         } else { $mfs = 0; }
//echo $i . " " . $k . " " . $mfs . " " . $m . "<br>";
         if ($mfs > $comp_count2) { $comp_count2 = $mfs; $ii2 = $i; $mm2 = $m; }
         else if ($mfs == $comp_count2) {
            if ($m < $mm2) {
               $comp_count2 = $mfs; $ii2 = $i; $mm2 = $m;
            }
         }
      }
//echo $comp_count2 . " " . $mm2 . "<br>";
      $check2 = ""; $j = 0;
      for ($i = 0; $i < $n; $i++) {
         if ($i >= $ii2) {
            if ($seq[$i] == $reverse[$j]) { $check2 .= "1"; } else { $check2 .= "0"; }
            $j++;
         } else { $check2 .= "0"; }
      }
//echo "$check2<br>";
      // make a copy for allowing one mismatch
      //$check21 = "";
      //for ($i = 0; $i < $n; $i++) { if ($check2[$i] == "1") { $check21 .= "1"; } else { $check21 .= "0"; } }
      // remove nonstretching complements
      $i = 0;
      while ($i < $n) {
         if ($check2[$i] == "1") {
            $k = 0;
            for ($j = $i; $j < $n; $j++) {
               if ($check2[$j] == "1") { $k++; } else { break; }
            }
            if ($k <= $cutoff) { // less than cutoff, flag them so can be colored later
               for ($j = $i; $j < $i+$k; $j++) {
                  if ($k == 1) { $check2[$j] = "0"; }
                  else { $check2[$j] = $k; }
               }
            }
            $i = $i + $k;
         } else { $i++; }
      }
//echo $check1 . "<br>";
//echo $check2 . "<br>";

/*
      $comp_count = 0;
      $seq_allow_one = $seq;
      if ($comp_count1 > 0 || $comp_count2 > 0) {
         $check = "";
         if ($comp_count1 > $comp_count2) { $check = $check1; }
         else if ($comp_count1 < $comp_count2) { $check = $check2; }
         else if ($comp_count1 == $comp_count2) { // when same, select one with least gap
            if ($mm1 < $mm2) { $check = $check1; }
            else { $check = $check2; }
         }
         $j = 0;
         for ($i = 0; $i < $n; $i++) {
            if ($check[$i] != "0") { $j++; }
         }
         $temp = ""; $ncolor = 0;
         for ($i = 0; $i < $n; $i++) {
            if (($check[$i] == "1") || ($check[$i] == "2") || ($check[$i] == "3")) {
               if ($j > 5) { // color if 6 or higher
                  $temp .= "<font color='red'>$seq[$i]</font>";
                  $ncolor++;
               }
               if ($check[$i] == "1") { $comp_count++; }
            } else { $temp .= $seq[$i]; }
         }
         if ($ncolor > 0) { $seq = $temp; } // if colored
      }
*/
      $comp_count1 = 0; $seq1 = $seq;
      $j = 0;
      for ($i = 0; $i < $n; $i++) {
         if ($check1[$i] != "0") { $j++; }
      }
      $temp = ""; $ncolor = 0;
      for ($i = 0; $i < $n; $i++) {
         if (($check1[$i] == "1") || ($check1[$i] == "2") || ($check1[$i] == "3")) {
            if ($j > 5) { // color if 6 or higher
               $temp .= "<font color='red'>$seq[$i]</font>";
               $ncolor++;
            }
            if ($check1[$i] == "1") { $comp_count1++; }
         } else { $temp .= $seq[$i]; }
      }
      if ($ncolor > 0) { $seq1 = $temp; } // if colored

      $comp_count2 = 0; $seq2 = $seq;
      $j = 0;
      for ($i = 0; $i < $n; $i++) {
         if ($check2[$i] != "0") { $j++; }
      }
      $temp = ""; $ncolor = 0;
      for ($i = 0; $i < $n; $i++) {
         if (($check2[$i] == "1") || ($check2[$i] == "2") || ($check2[$i] == "3")) {
            if ($j > 5) { // color if 6 or higher
               $temp .= "<font color='red'>$seq[$i]</font>";
               $ncolor++;
            }
            if ($check2[$i] == "1") { $comp_count2++; }
         } else { $temp .= $seq[$i]; }
      }
      if ($ncolor > 0) { $seq2 = $temp; } // if colored

      $comp_count_allow_one = 0;
/*
      // move seq allowing one mismatch
      // remove nonstretching complements
      $i = 0;
      while ($i < $n) {
         if ($check11[$i] == "1") {
            $k = 0;
            for ($j = $i; $j < $n; $j++) {
               if ($check11[$j] == "1") { $k++; }
               else if ((0 < $j) && ($j < $n-1)) {
                  if (($check11[$j-1] == "1") && ($check11[$j+1] == "1")) { $k++; }
                  else { break; }
               }
            }
            if ($k <= 4) {
               for ($j = $i; $j < $i+$k; $j++) { $check11[$j] = "0"; }
            }
            $i = $i + $k;
         } else { $i++; }
      }
      // move reverse allowing one mismatch
      // remove nonstretching complements
      $i = 0;
      while ($i < $n) {
         if ($check21[$i] == "1") {
            $k = 0;
            for ($j = $i; $j < $n; $j++) {
               if ($check21[$j] == "1") { $k++; }
               else if ((0 < $j) && ($j < $n-1)) {
                  if (($check21[$j-1] == "1") && ($check21[$j+1] == "1")) { $k++; }
                  else { break; }
               }
            }
            if ($k <= 4) {
               for ($j = $i; $j < $i+$k; $j++) { $check21[$j] = "0"; }
            }
            $i = $i + $k;
         } else { $i++; }
      }
      // find the one containing most
      $ii1 = 0;
      for ($i = 0; $i < $n; $i++) { if ($check11[$i] == "1") { $ii1++; } }
      $ii2 = 0;
      for ($i = 0; $i < $n; $i++) { if ($check21[$i] == "1") { $ii2++; } }
      if ($ii1 > 5 || $ii2 > 5) {
         $check = "";
         if ($ii1 > $ii2) {
            for ($i = 0; $i < $n; $i++) {
               if ($check11[$i] == "1") { $check .= "1"; } else { $check .= "0"; }
            }
         } else {
            for ($i = 0; $i < $n; $i++) {
               if ($check21[$i] == "1") { $check .= "1"; } else { $check .= "0"; }
            }
         }
         $temp = "";
         for ($i = 0; $i < $n; $i++) {
            if ($check[$i] == "1") {
               $temp .= "<font color='red'>$seq_allow_one[$i]</font>";
               $comp_count_allow_one++;
            } else { $temp .= $seq_allow_one[$i]; }
         }
         if ($comp_count_allow_one > 0) { $seq_allow_one = $temp; } // any complements left are more than 5 bps
      }

      //echo "<tr bgcolor=$bgColor><td>$fontColor Sequence (5' to 3')</td><td>$fontColor $seq</td></tr>";
      ////echo "<tr><td>$fontColor Complementary Sequence (3' to 5')</td><td>$fontColor $comp</td></tr>";
      //echo "<tr bgcolor=$bgColor><td>$fontColor Sequence (5' to 3' allowing one mismatch)</td><td>$fontColor $seq_allow_one</td></tr>";

      if ($comp_count > $comp_count_allow_one) {
         echo "<tr bgcolor=$bgColor><td>$fontColor Sequence (5' to 3')</td><td>$fontColor $seq</td></tr>";
      } else {
         echo "<tr bgcolor=$bgColor><td>$fontColor Sequence (5' to 3')</td><td>$fontColor $seq_allow_one</td></tr>";
      }
      echo "<tr><td>$fontColor Reverse Complementary Sequence (5' to 3')</td><td>$fontColor $reverse</td></tr>";
*/
      echo "<tr height='35px'><td>$fontColor PNA Sense Sequence (5' to 3')</td><td>$fontColor $seq</td></tr>";
      echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Reverse Complementary Sequence (5' to 3')</td><td>$fontColor $reverse</td></tr>";
/*
      if ($pur_content > 70 || $purine_stretch_count > 7 || $comp_count > 5 || $base_c > 30) {
         $temp = "";
         if ($pur_content > 70) { $temp .= "<br>Purine content > 70%"; }
         if ($purine_stretch_count > 7) { $temp .= "<br>Purine stretch > 7bp"; }
         if ($comp_count > 5) { $temp .= "<br>Complementary > 5bp"; }
         if ($base_c > 30) { $temp .= "<br>base > 30bp"; }
         echo "<tr bgcolor=$bgColor><td>$fontColor Comment</td><td><font color='red'>Redesign recommended</font>$fontColor $temp</td></tr>";
      } else {
         echo "<tr bgcolor=$bgColor><td>$fontColor Comment</td><td>$fontColor Good</td></tr>";
      }
*/
      if ($g_content > 35 || $pur_content > 50 || $purine_stretch_count > 5 || $comp_count1 > 7 || $comp_count2 > 7 || $comp_count_allow_one > 6 || $base_count > 30) {
         $temp = "";
         //if ($pur_content > 60) { $temp .= "<br>Purine content > 60%"; }
         if ($g_content > 35) { $temp .= "<br>G content > 35%"; }
         if ($pur_content > 50) { $temp .= "<br>Purine content > 50%"; }
         if ($purine_stretch_count > 5) { $temp .= "<br>Purine stretch > 5bp"; }
         if ($comp_count_allow_one > 6) { $temp .= "<br>>6bp complementary if allowed one mismatch"; }
         if ($base_count > 30) { $temp .= "<br>base > 30bp"; }
         if ($comp_count1 > 7 || $comp_count2 > 7) { $temp .= "<br>>7bp complementary"; }
         $temp = "<font color='red'>Redesign recommended $temp</font>";
         echo "<tr><td>$fontColor Comment</td><td>$temp</td></tr>";
      } else {
         echo "<tr><td>$fontColor Comment</td><td>$fontColor Good</td></tr>";
      }
      if ($seq != $seq1 && $seq != $seq2) {
         if ($seq1 == $seq2) {
            echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Self complementarity</td><td>$fontColor2 $seq1</td></tr>";
         } else {
            echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Self complementarity</td><td>$fontColor2 $seq1<br>$seq2</td></tr>";
         }
      } else if ($seq != $seq1) {
         echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Self complementarity</td><td>$fontColor2 $seq1</td></tr>";
      } else if ($seq != $seq2) {
         echo "<tr height='35px' bgcolor=$bgColor><td>$fontColor Self complementarity</td><td>$fontColor2 $seq2</td></tr>";
      }
      echo "<tr height='35px'><td>$fontColor </td><td>$fontColor </td></tr>";
      echo "</table>";

/*
echo "$base_count $base_comp $pur_comp $pyr_comp $formula $mw $gc $ec $odu $tm $dh $ds $dg $seq $comp $reverse<br>";
*/
   }
   echo "<br>";
   echo "<br>";
   echo "<br>";
?>
