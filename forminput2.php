<!DOCTYPE html>
<html>
  <head>
    <title>Battleship</title>
  </head>


  <body style="background-color:grey;">

    <h1>Battleship v0.1</h1>
    <p>Please enter the coordinate of your target:</p>

    <?php
       // define variables and set to empty values
       $arg1 = $arg2 = $arg3 = $output = $retc = "";

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $arg1 = test_input($_POST["arg1"]);
         $arg2 = test_input($_POST["arg2"]);
         $arg3 = test_input($_POST["arg3"]);
        exec("/usr/lib/cgi-bin/sp1a/battleship1 " . $arg1 . " " . $arg2 . " " . $arg3, $output, $retc);
       }

       function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      Arg1: <input type="text" name="arg1" ><br>
      Arg2: <input type="text" name="arg2" ><br>
      State(enter 1 to init, 0 to play): <input type="text" name="arg3" value=0><br>
      <br>
      <input type="submit" value="Go!">
    </form>

    <?php
       // only display if return code is numeric - i.e. exec has been called
       if (is_numeric($retc)) {
         echo "<h2>Coordinates:</h2>";
         echo $arg1;
         echo "<br>";
         echo $arg2;
         echo "<br>";
	 echo $arg3;
         echo "<br>";
       
         echo "<h2>Board:</h2>";
         
           foreach ($output as $line) {
           echo $line;
           echo "<br>";
         }
         
       
         echo "<h2>Program Return Code:</h2>";
         echo $retc;
       }
    ?>
    
  </body>
</html>
