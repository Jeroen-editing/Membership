<?php

    try {

        /********************** Initialisatie ******************************************/
        /*******************************************************************************/

        /**** $_srv gebruiken we als "action" in onze formulieren ************/
        $_srv = $_SERVER['PHP_SELF'];


        /**** includes **************/
        /****************************/

        /**** instantiering van $_PDO ************/
        /**** (connectie met dbms en selectie van de datbase) ************/
        require("../connections/pdo.inc.php");

        /**** functie om vanuit het model (database) based drop-downs te creëren  ************/
        require("../php_lib/dropDown.inc.php");

        /**** functie om selectie query samen te stellen ************/
        require("../php_lib/createSelect.inc.php");

        /**** functie om de primary key van t_gemeente op te zoeken op basis van gemeente naam en/of postcode ************/
        require("../php_lib/PK_t_gemeente.inc.php");


        //**** initialisaties *******/
        /****************************/
        $_output = "";

        /********************** (Input en) verwerking **********************************/
        /*******************************************************************************/

        /**** !! opgepast !! ************/
        /**** 2 soorten formulieren ************/
        /**** indien geen formulier --> error ************/

        if (! isset($_POST["submit_bev"]) && ! isset($_POST["submit_aanpassen"])) {
            /**** geen enkel formulier formulier ************/

            throw new Exception("Illegal access");

        }

        if (isset($_POST["submit_bev"])) {
            /**** bevestigings formulier ************/

            /**** verwerk inhoud van het formulier ************/
            /**** copieer de inhoud van $_POST[lidnr'] (super global) naar lokale parameter $_lidnr ************/
            $_lidnr = $_POST['lidnr'];

            /**** Query samenstellen ************/
            $_query = " SELECT  * 
                        FROM    v_leden 
                        WHERE   d_lidnr = '$_lidnr';";

            // Query naar DB sturen ************/
            $_result = $_PDO -> query("$_query");

            /**** Resultaat van query verwerken ************/

            if ($_result -> rowCount() == 0) {
                /**** geen resultaat is db inconsistency ************/

                throw new Exception("Database inconsistency");
                }

            /**** hier gaan komen we enkel indien er geen 'db inconsistency'  was *******/

            while ($_row = $_result -> fetch(PDO::FETCH_ASSOC)) {

                /**** maak voor het geselecteerde lid een formulier  ************/
                /**** en vul de velden inmet de huidige waarden ************/
                /**** voorzie een 'hidden formfield' met de key ************/
                $_output =  "   <h1>Lid aanpassen</h1>
                                <hr>
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
                                        <input type='submit' name='submit_aanpassen' id='submit' value='Aanpassen'>
                                    </fieldset>
                                </form>";
            }

        } else {
            /**** formulier met aangepaste data ************/

            /**** verwerk inhoud van het formulier ************/
            /**** copieer de inhoud van $_POST (super global) naar lokale parameters ************/

            /**** input uitpakken ************/
            $_naam = $_POST["naam"];
            $_voornaam = $_POST["voornaam"];
            $_straat = $_POST["straat"];
            $_nr = $_POST["nr"];
            $_xtr = $_POST["xtr"];
            $_telefoon = $_POST["tel"];
            $_postcode = $_POST["postcode"];
            $_gemeenteNaam = $_POST["gemnaam"];
            $_mob = $_POST["mob"];
            $_mail = $_POST["mail"];
            $_gender = $_POST["gender"];
            $_soort = $_POST["soort"];

            $_lidnr = $_POST["lidnr"];
            $_gemeentePK = PK_t_gemeente($_postcode, $_gemeenteNaam);

            /**** Maak met de ingevoerde waarden de bijhorende update query. ***********/
            /**** we updaten alle velden ************/

            $_query = " UPDATE  t_leden
                        SET     d_naam = '$_naam',
                                d_voornaam = '$_voornaam',
                                d_straat = '$_straat',
                                d_nr = '$_nr',
                                d_Xtr = '$_xtr',
                                d_gemeente = '$_gemeentePK',
                                d_tel = '$_telefoon',
                                d_mob = '$_mob',
                                d_mail = '$_mail',
                                d_gender = '$_gender',
                                d_soort = '$_soort'
                        WHERE   d_lidnr = '$_lidnr';";
                

            /**** Query naar DB sturen ************/
            $_result = $_PDO -> query("$_query");

            /**** gegevens van het lid zijn aangepast ************/
            $_output = "<br><br><br><br>
                        <p>
                            De gegevens voor: &nbsp;
                            <em>
                                $_voornaam
                            </em>
                            &nbsp;&nbsp;
                            <em>
                                $_naam
                            </em>
                            zijn aangepast.
                        </p>";

        }

        /*****************  output *****************************************************/
        /*******************************************************************************/

        /**** $_smarty instantiëren en initialiseren ********/
        require("../smarty/mySmarty.inc.php");

        /**** functie om "menu" samen te stellen vanuit DB ********/
	    require("../php_lib/menu.inc.php");

        /**** functie om text (html) files in te lezen ************/
        require("../php_lib/inlezen.inc.php");

        /**** We kennen de variabelen toe ************/
        $_smarty->assign('inhoud', $_output);
        $_smarty->assign('commentaar',inlezen("L_data_aanpassen_C.html"));
        $_smarty->assign('menu',menu(1));

        /**** display it ************/
        $_smarty->display('ledenadmin.tpl');

    }

    catch (Exception $_e) {

        /**** exception handling functions ************/
        include("../php_lib/myExceptionHandling.inc.php");
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>
