<?php
include_once("config.php");
?>

    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Spine </title>
        <link rel="icon" href="images/minilogo.png">

        <meta name="Spine" content="An interactive plataform to sell the coolest magazines.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/welcome.css">
        <link rel="stylesheet" href="../css/paypal.css">
    </head>

    <body>
        <div class="barraMenu">
            <header>
                <a href="../index.php"> <img src="../images/logo.png" alt="spinelogo" id="logo"> </a>
            </header>


            <nav>
                <ul id="nav-menu">
                    <li> <a href="../magazines.php"> Magazines </a></li>
                    <li> <a href="../about.php"> About </a></li>
                    <li> <a href="../contacts.php"> Contact </a></li>
                    <li> <a href="../welcome.php"> Profile </a></li>
                </ul>

                <div id="login"> <a href="../logout.php">Logout</a></div>
            </nav>
        </div>


        <div class="welcome">
            <h2> Cart </h2>
            <!--<div id="info">
                <div class="line">
                    <label for=""> <a href="#"> Canon EOS Rebel XS </a></label>

                    <form method="post" action="process.php?paypal=checkout">
                        <input type="hidden" name="itemname" value="Canon EOS Rebel XS" />
                        <input type="hidden" name="itemnumber" value="10000" />
                        <input type="hidden" name="itemprice" value="225.00" /> Quantity :
                        <select name="itemQty">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <input class="dw_button" type="submit" name="submitbutt" value="Buy (225.00 <?php echo PPL_CURRENCY_CODE; ?>)" />
                    </form>

                </div>
            </div>-->

            <table class="line" border="0">
                <tr>
                    <td class="label">
                        <label for=""> <a href="#"> Canon EOS Rebel XS </a></label>
                    </td>
                    <form method="post" action="process.php?paypal=checkout">
                        <input type="hidden" name="itemname" value="Nikon COOLPIX" />
                        <input type="hidden" name="itemnumber" value="20000" />
                        <input type="hidden" name="itemdesc" value="Nikon Coolpix S9050 26355 digital camera capture vibrant photos up to 12.1 megapixels." />
                        <input type="hidden" name="itemprice" value="109.99" />

                        <td class="quant">Quantity :
                            <select name="itemQty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td  class="buy">
                            <input class="dw_button" type="submit" name="submitbutt" value="Buy (109.99 <?php echo PPL_CURRENCY_CODE; ?>)" />
                        </td>

                    </form>
                </tr>
            </table>
        </div>


        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="../js/script.js"></script>
    </body>

    </html>