<?php

    try {

        /****************** Initialisatie **********************************************/
        /*******************************************************************************/

        /**** $_srv gebruiken = "action" in onze formulieren **************/
        $_srv = $_SERVER['PHP_SELF'];


        /**** includes **************/
	    /****************************/

        /**** connectie met dbms en selectie van de datbase **************/
        require("../connections/pdo.inc.php");

        /**** functie om text (html) files in te lezen **************/
        require("../php_lib/inlezen.inc.php");

        /**** functie om vanuit het model (database) based drop-downs te creëren **************/
        require("../php_lib/dropDown.inc.php");

        /**** functie om selectie query samen te stellen **************/
        require("../php_lib/createSelect.inc.php");


        /**** initialisaties ********/
	    /****************************/
        $_output = "";


        /***************** formulier behandeling ***************************************/
        /*******************************************************************************/

        /************ !! !! !! opgepast !! !! !! ************/

        /**** 2 soorten formulieren **************/
        if (! isset($_POST["submit"]) && ! isset($_POST["submit_bev"])) {
            /**** als er geen van beide formulieren is **************/
            /**** formulier klaar maken **************/

            /**** toon 1ste formulier formulier --> selectie formulier  ***********/
            $_output.=  "   <h1>Lid verwijderen</h1>
                            <form method='post' action='$_srv'>
                                <fieldset>
                                <legend>Personalia</legend>
                                    <label>Naam</label>
                                    <input type='text' name='naam' size='40'>
                                    <label>Voornaam</label>
                                    <input type='text' name='voornaam' size='40'>
                                </fieldset>
                                <br><br>
                                <fieldset>
                                <legend>Gender</legend>
                                    <label>Gender</label>".
                                    dropDown("gender", "t_gender", "d_index", "d_mnemonic", $_start).
                                "</fieldset>
                                <br><br>
                                <fieldset>
                                <legend>Lidmaatschap</legend>
                                    <label>Soort lid</label>".
                                    dropDown("soort", "t_soort_lid", "d_index", "d_mnemonic", $_start).
                                "</fieldset>
                                <br><br>
                                <fieldset>
                                <legend>Adres</legend>
                                    <label>Straat</label>
                                    <input type='text' name='straat' size='40'>
                                    <label>Nr & Extra</label>
                                    <input type='text' name='nr' id='huisnr' size='8'>
                                    <input type='text' name='xtr' size='10'>
                                    <label>Postcode</label>
                                    <input type='text' name='postcode' size='16'>
                                    <label>Gemeente</label>
                                    <input type='text' name='gemnaam' size='40'>
                                </fieldset>
                                <br><br>
                                <fieldset>
                                <legend>Contact gegevens</legend>
                                    <label>Telefoon</label>
                                    <input type='text' name='tel' size='16'>
                                    <label>Mobiel</label>
                                    <input type='text' name='mob' size='16'>
                                    <label>E-mail</label>
                                    <input type='text' name='mail' size='40'>
                                </fieldset>
                                <br><br>
                                <fieldset id='buttons'>
                                <input type='reset' name='reset' id='reset' value='reset'>
                                <input type='submit' name='submit' id='submit' value='verzenden & verwerken'>
                                </fieldset>
                            </form>";
                

        } else if (isset($_POST["submit"])) {
            /**** inhoud selectie formulier verwerken *************/

            /**** input uitpakken ************/
            $_naam = $_POST["naam"];
            $_voornaam = $_POST["voornaam"];
            $_straat = $_POST["straat"];
            $_nr = $_POST["nr"];
            $_xtr = $_POST["xtr"];
            $_telefoon = $_POST["tel"];
            $_gemeenteNaam = $_POST["gemnaam"];
            $_postcode = $_POST["postcode"];
            $_mob = $_POST["mob"];
            $_mail = $_POST["mail"];
            $_gender = $_POST["gender"];
            $_soort = $_POST["soort"];


            /******************* consistency checks ************************************/
            /***************************************************************************/

            /**** nakijken of "te verwijderen lid" wel bestaat ************/

            //**** Query samenstellen ***********/
            $_query = createSelect(
                        "v_leden",
                        array($_naam, $_voornaam,
                              $_straat, $_nr, $_xtr, $_postcode, $_gemeenteNaam,
                              $_telefoon, $_mob,  $_mail, $_gender, $_soort),
                        array('d_naam', 'd_voornaam',
                              'd_straat','d_nr','d_xtr','d_Postnummer', 'd_GemeenteNaam',
                              'd_tel','d_mob', 'd_mail', 'd_gender', 'd_soortlid'));

            //**** Query naar DB sturen ***********/
            $_result = $_PDO -> query("$_query");

            //**** Resultaat van query verwerken ***********/
            if ($_result -> rowCount() == 0) {

                //**** gezocht lid bestaat niet ***********/
                $_output = "<br><br><br><br><br><br>
                			<h2>
                				Geen records gevonden voor deze input
                			</h2>
                			<br><br>
                			<a href='$_srv'>volgende</a>";

            } else  {
                //**** te verwijderen lid bestaat wel ***********/
                while ($_row = $_result -> fetch(PDO::FETCH_ASSOC)) {

                /**** toon alle gevonden leden ***********/
                $_output.=  "<div id='toontabel'>
                                <h1>Lid tonen</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan='2'>
                                                <h3>".
                                                    $_row['d_voornaam'].
                                                    "&nbsp;&nbsp;".
                                                    $_row['d_naam'].
                                                "</h3>
                                            </th>
                                        </tr>       
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='2'>".
                                                $_row['d_gender_mnem'].
                                            "</td>
                                        </tr>
                                        <tr colspan='2'>
                                            <td colspan='2'>".
                                                $_row['d_soortlid_mnem'].
                                            "</td>
                                        </tr>
                                        <tr>
                                            <td colspan='2' class='tabletitle'>
                                                <h4>Adres</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>".
                                                $_row['d_straat'].
                                            "</td>
                                        </tr>
                                        <tr>
                                            <td>".
                                                $_row['d_nr'].
                                            "</td>
                                            <td>".
                                                $_row['d_xtr'].
                                            "</td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>".
                                                $_row['d_postnummer'].
                                            "</td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>".
                                                $_row['d_gemeenteNaam'].
                                            "</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan='2' class='tabletitle'>
                                                <h4>Contact gegevens</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tel : ".$_row['d_tel'].
                                            "</td>
                                            <td>
                                                Mob : ".$_row['d_mob'].
                                            "</td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>
                                                Mail : ".$_row['d_mail'].
                                            "</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>".

                            "\n<br><br>
                            <form method='POST' action='$_srv'>
                                <input type='hidden' name='lidnr' value='".$_row['d_lidnr']."'>
                                <input type='hidden' name='voornaam' value='".$_row['d_voornaam']."'>
                                <input type='hidden' name='naam' value='".$_row['d_naam']."'>
                                <input type='submit' name='submit_bev' class='single_button margLeft' value='Verwijder'>         
                            </form>
                            <br><br><hr><br>\n";
                /**** per "lid"	een formulier met hierbij de bijhorende key uit t_leden/v_leden als hidden parameter ***********/
                }
            }

        /**** bevestigings formulier met te verwijderen lid ***********/
        } else  {

            /**** input uitpakken ***********/
            $_lidnr = $_POST['lidnr'];
            $_naam = $_POST['naam'];
            $_voornaam = $_POST['voornaam'];

            /**** Query samenstellen ***********/
            $_query = "DELETE FROM t_leden WHERE d_lidnr = $_lidnr;";

            /**** Query naar DB sturen ***********/
            $_result = $_PDO -> query($_query);

            /**** lid is verwijderd ***********/
            $_output = "<br><br><br><br><br><br><h2>Lid $_voornaam $_naam is verwijderd.</h2>";

        }


        /***************** output ******************************************************/
        /*******************************************************************************/

        /**** $_smarty instantiëren en initialiseren ********/
        require("../smarty/mySmarty.inc.php");

        /**** functie om "menu" samen te stellen vanuit DB ********/
	    require("../php_lib/menu.inc.php");

        /**** We kennen de variabelen toe ***********/
        $_smarty->assign('inhoud', $_output);
        $_smarty->assign('commentaar',inlezen("L_verwijderen_C.html"));
        $_smarty->assign('menu',menu(1));

        /**** display it ***********/
        $_smarty->display('ledenadmin.tpl');
    }


    catch (Exception $_e) {

        /**** exception handling functions ***********/
        include("../php_lib/myExceptionHandling.inc.php");
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>
