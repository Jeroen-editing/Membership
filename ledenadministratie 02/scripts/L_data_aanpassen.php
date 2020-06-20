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

        /************ !! !! !! opgepast !! !! !! ************/
        /**** 2 soorten formulieren ************/
        /**** indien geen formulier --> error ************/

        if (! isset($_POST["submit_bev"]) && ! isset($_POST["submit_aanpassen"])) {
            /**** geen enkel formulier formulier ************/

            throw new Exception("illegal access");
        }

        if (isset($_POST["submit_bev"])) {
            /**** bevestigings formulier ************/

            /**** verwerk inhoud van het formulier ************/
            /**** copieer de inhoud van $_POST[lidnr'] (super global) naar lokale parameter $_lidnr ************/
            $_lidnr = $_POST['lidnr'];

            /**** Query samenstellen ************/
            $_query = "Select * FROM v_leden WHERE d_lidnr = '$_lidnr'";

            // Query naar DB sturen ************/
            $_result = $_PDO -> query($_query);

            /**** Resultaat van query verwerken ************/

            if ($_result -> rowCount() == 0) {
                /**** geen resultaat is db inconsistency ************/

                throw new Exception("database inconsistency");
                }

            /**** hier gaan komen we enkel indien er geen 'db inconsistency'  was *******/

            while ($_row = $_result -> fetch(PDO::FETCH_ASSOC)) {

                /**** maak voor het geselecteerde lid een formulier  ************/
                /**** en vul de velden inmet de huidige waarden ************/
                /**** voorzie een 'hidden formfield' met de key ************/
                $_output =
                    "<h1>Gegevens aanpassen</h1>
                    <form  method='post' action='$_srv'>
                        <input type ='hidden' name ='lidnr' value ='".$_row['d_lidnr']."'>
                        <label>Naam</label>
                            <input type='text' name='naam' value ='".$_row['d_naam']."'>
                        <label>Voornaam</label>
                            <input type='text' name='voornaam'value ='".$_row['d_voornaam']."'>
                            <br><hr>

                        <label>Gender</label>";
                /**** dropdown voor gender ************/
                $_output .= dropDown("gender","t_gender","d_index", "d_mnemonic",1,$_row['d_gender']);


                $_output.= "<label >Soort lid</label>";
                /**** dropdown voor soort lid ************/
                $_output.= dropDown("soort","t_soort_lid","d_index", "d_mnemonic",1,$_row['d_soortlid']);
                $_output.="
                        <br><hr>
                        <label>Straat</label>
                            <input type='text' name='straat' value ='".$_row['d_straat']."'>
                        <label>Nr & Extra</label>
                            <input type='text' name='nr' size='10' value ='".$_row['d_nr']."'>
                            <input type='text' name='xtr' size='10' value ='".$_row['d_xtr']."'>
                        <label>Postcode</label>
                            <input type='text' name='postcode' size='10' value ='".$_row['d_postnummer']."'>
                        <label>Gemeente</label>
                            <input type='text' name='gemnaam'size='20' value ='".$_row['d_gemeenteNaam']."'>
                            <br><hr>
                        <label>Telefoon</label>
                            <input type='text' name='tel' size='15' value ='".$_row['d_tel']."'>
                        <label>Mobiel</label>
                            <input type='text' name='mob' size='15' value ='".$_row['d_mob']."'>
                        <label>E-mail</label>
                            <input type='text' name='mail' size='80' value ='".$_row['d_mail']."'>
                            <br><hr>
                            <input type='submit' name='submit_aanpassen' id='Submit_Aanpassen' value='Aanpassen'>
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
            $_gemeenteNaam = $_POST["gemnaam"];
            $_postcode = $_POST["postcode"];
            $_mob = $_POST["mob"];
            $_mail = $_POST["mail"];
            $_gender = $_POST["gender"];
            $_soort = $_POST["soort"];

            $_lidnr =$_POST["lidnr"];
            $_gemeentePK = PK_t_gemeente($_postcode, $_gemeenteNaam);

            /**** Maak met de ingevoerde waarden de bijhorende update query. ***********/
            /**** we updaten alle velden ************/

            $_query = "
                UPDATE t_leden
                SET d_naam = '$_naam',
                    d_voornaam = '$_voornaam',
                    d_straat = '$_straat',
                    d_nr = '$_nr',
                    d_Xtr = '$_xtr',
                    d_gemeente = '$_gemeentePK',
                    d_tel = '$_telefoon',
                    d_mob = '$_mob',
                    d_mail = '$_mail',
                    d_gender ='$_gender',
                    d_soort = '$_soort'
                WHERE d_lidnr = '$_lidnr';";

            /**** Query naar DB sturen ************/
            $_result = $_PDO -> query("$_query");

            /**** gegevens van het lid zijn aangepast ************/
            $_output = "<br><br><br><br><br><br>
                        <h2>De gegevens voor&nbsp;&nbsp;$_voornaam&nbsp;&nbsp;$_naam zijn aangepast</h2>";

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
