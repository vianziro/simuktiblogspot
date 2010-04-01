<?php
/**
 * @filesource index.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Password Checking dan Generator</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<body>
    <center>
        <div class="main">
            <form id="formCek">
                <fieldset><legend>Check Password</legend>
                    <div class="all"> <div class="left">Password</div><div class="right"><input type="text" id="password"></div></div>
                    <div class="all"> <div class="left">&nbsp;</div> <div class="right"><input class="button" type="submit" value="Check Password" id="cekPassword"></div></div>
                    <div class="all"></div>
                </fieldset>
            </form>
        </div>
        <div id="pesan"></div>
        <div class="main">
                <fieldset><legend>Generate Password</legend>
                    <div class="all"> <div class="left">&nbsp;</div> <div class="right"><input type="submit" value="Generate Password" id="generatePassword"></div></div>
                    <div class="all"></div>
                </fieldset>
            <div id="note">Info : 1 = lemah, 2 = sedang, 3 = lumayan, 4 = kuat</div>
        </div>
    </center>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup ({
            cache: false
        });
        // gambar loading
        var ajax_load   = "<img class='loading' src='css/load.png' alt='loading...' />";

        //Url yang mroses password
        var postUrl = "proses.php";

        $("#generatePassword").click(function(){
            $("#pesan").html(ajax_load).load(postUrl);
        });

        $("#formCek").submit(function(){
            var passVal = $("#password").val();
            if (passVal.length == 0) {
                $("#pesan").html("<div style=\"background: #EEE;\">Textbox password gak boleh kosong</div\>");
                $("#password").focus();
            } else {
                $("#pesan").html(ajax_load);
                $.get(
                    postUrl,
                    {password: passVal},
                    function(responseText){
                        $("#password").val('');
                        $("#pesan").html(responseText);
                    },
                    "html"
                )
            }
            return false;
        });

    </script>
</body>
</html>

