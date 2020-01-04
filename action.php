<html>
   <head>
        <title>Manuscript</title>
   </head>
   <body>
     <?php 
          $text = htmlspecialchars($_POST['text']);
          $text = nl2br($text);
          $files = scandir('fonts');
          
          for ($i=2; $i<count($files); $i++)
		{
               $file[$i-2] = pathinfo('fonts/'.$files[$i], PATHINFO_FILENAME);
          }
          //print_r($files);echo "<br>";print_r($file);echo "<br>";
          echo $text; 
          for ($i=0; $i<strlen($_POST['lol']); $i++)
		{
               
          }
     ?>     
    </body>   
</html>