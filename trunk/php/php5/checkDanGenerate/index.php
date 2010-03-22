<?php
/**
 * @filesource index.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

//include_once 'generator.php';

//$abc = new generator();
//echo $abc->test(6);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Password checking dan generator</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <center>
        <div class="m">
            <form name="cekPass" method="post" action="proses.php">
                <fieldset><legend>Password yang dicek</legend>
                    <div class="a"> <div class="l">Password</div><div class="r"><INPUT type="text" name="name"></div></div>
                    <div class="a"> <div class="l">&nbsp;</div> <div class="r"><INPUT class="button" type="submit" name="submit" value="Cek Password"></div></div>
                    <div class="a"></div>
                </fieldset>
            </form>
        </div>
    </center>
</body>
</html>

