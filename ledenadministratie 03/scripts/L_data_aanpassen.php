<?php

    try {

        /********************** Initialisatie ******************************************/
        /*******************************************************************************/

        require_once("../code/initialisatie.inc.php");
        
        /**** is het script op een 'legale' manier opgestart ************/
        /**** is er een actie gedefiniëerd                   ************/
        /**** is de actie gelijk aan 4 ==> 'verwijderen'     ************/
        /**** is er een formulier (aanpassen                   ************/
        /****                                                ************/
        /**** anders ==> illegale toegang                    ************/

        if (! isset( $_SESSION["actie"]) ||
					 $_SESSION["actie"] != 4 || 
			! isset( $_POST["submit_aanpassen"])) {

                throw new Exception("Illegal access");

		}


        /********************** Verwerking formulier ***********************************/
        /*******************************************************************************/

        /**** Verwerk de inhoud v/h formulier **********/
        require("../code/inputUitpakken.inc.php");

        /**** de inhoud van $_POST['lidnr'] (super global) kopiëren naar de lokale parameter $_lidnr **********/
        $_lidnr = $_POST["lidnr"];
        
        $_gemeentePK = PK_t_gemeente($_postcode, $_gemeenteNaam);

        /**** Query samenstellen **********/
        $_query = " UPDATE  t_leden
                    SET     d_naam = '$_naam',
                            d_voornaam = '$_voornaam',
                            d_straat = '$_straat',
                            d_nr = '$_nr',
                            d_xtr '$_xtr',
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
        $_output = "<br><br><br><br><br><br>
                    <h2>De gegevens voor&nbsp;&nbsp;$_voornaam&nbsp;&nbsp;$_naam zijn aangepast</h2>";
        
        
        
        /*****************  output *****************************************************/
        /*******************************************************************************/

        /**** We kennen de variabelen toe ************/
        $_menu = 1;
        
        $_commentaar = "L_data_aanpassen_C.html";

        
        require("../code/output.inc.php");
        /**** bevat alle code die nodig is om de output te genereren *********/
        /**** instantiëring v/h smarty-object                        *********/
        /**** toewijzen van de smarty variabelen                     *********/
        /**** koppeling met de gewenste template                     *********/


    }

    catch (Exception $_e) {
        
        /**** exception handling functions ************/
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>