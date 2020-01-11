<html>
   <head>
        <title>Manuscript</title>
        <style>
        	<?php
        $text = htmlspecialchars($_POST['text']);
          $text = nl2br($text);
          $files = scandir('fonts');
          
          for ($i=2; $i<count($files); $i++)
					{
               $file[$i-2] = pathinfo('fonts/'.$files[$i], PATHINFO_FILENAME);
               
               ?>@font-face {
						font-family: "<?php echo $file[$i-2]; ?>";
						src: url("fonts/<?php echo pathinfo('fonts/'.$files[$i], PATHINFO_BASENAME); ?>");
					}<?
          }
          ?>
				</style>
   </head>
   <body>
     <?php 
          
          //print_r($files);echo "<br>";print_r($file);echo "<br>";
          //echo $text; 

          $newText = '';
          $sco = 0;
          $nobring = 0;
          $isbrd = true;
          
          for ($i=0; $i<strlen($text); $i++) {
               //echo 0;
               while ((mb_substr($text,$i,1,'UTF-8')=="<"&&mb_strpos($text, '>', $i,'UTF-8'))
                    ||(mb_substr($text,$i,1,'UTF-8')=="&"&&mb_strpos($text, ';', $i,'UTF-8'))
                    ||(mb_substr($text,$i,1,'UTF-8')=="\n")) {
                    
                  //  echo ' - ';

                    if (mb_substr($text,$i,1,'UTF-8')=="<"&&mb_strpos($text, '>', $i,'UTF-8')) {
                         $oldi=$i;
                         $i = mb_strpos($text, '>', $i,'UTF-8')+1;
                         $newText.= mb_substr($text,$oldi,$i-$oldi,'UTF-8');
                    }

                    if (mb_substr($text,$i,1,'UTF-8')=="&"&&mb_strpos($text, ';', $i,'UTF-8')) {
                         $oldi=$i;
                         $i = mb_strpos($text, ';', $i,'UTF-8')+1;
                         $newText.= mb_substr($text,$oldi,$i-$oldi,'UTF-8');
                    }

                    if (mb_substr($text,$i,1,'UTF-8')=="\n") {
                         $GLOBALS['sco']++;
                         $nobring = 0;
                         $i++;
                    }
               }

               //echo 1;

               $mrand = mb_substr($text,$i,1,'UTF-8')==' '?rand(-2,2):rand(1,4);
               $font = "<font style=\"color:blue; font-size: ".rand(/*33,37*/18,24)."px; margin-right: ".$mrand."px\" face=\"".$file[rand(0,count($file)-1)]."\">";
               $font1 = "</font>";
               $newText.= $font.mb_substr($text,$i,1,'UTF-8').$font1; 
               if ($nobring&&$nobring>37) {
				$isbrd=false;
			}
			else {
				$nobring++;
			}
               
               //echo 2;

               if (!$isbrd&&mb_substr($text,$i,1,'UTF-8')==" "&&$nobring>37) {
				$r1=rand(17,19); $r2=rand(48,65);
				$isbrd=0;
				$nobring=0;
               }
               
               //echo 3;
               
          }
          echo "<div>".$newText."</div>";
     ?>     
    </body>   
</html>