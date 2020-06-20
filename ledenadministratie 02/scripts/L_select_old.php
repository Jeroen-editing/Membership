<?php

    try {

    /********************** Initialisatie ************************************************/
    /*************************************************************************************/

        $_srv = $_SERVER['PHP_SELF'];

        /**** includes **************/
        /****************************/
      
        /**** database connection en selection ********/
        include("../connections/pdo.inc.php");

        /**** menu creatie vanuit de DB ********/
        include("../php_lib/menu.inc.php"); 

        /**** maak variabele selectie query ********/
        include("../php_lib/inlezen.inc.php"); 
          
        $_inhoud = inlezen("L_home_I.html");
        $_commentaar = inlezen("L_home_C.html");

    /****************** Verwerking ********************************************************/
    /**************************************************************************************/


    if (! isset($_GET["act"])) {

        /**** geen actie gedefiniëerd **********/
        throw new Exception("illegal access");

    }

    /**** de actie vanuit $_GET naar de sessie variabele kopiëren ************/
    $_SESSION["actie"] = $_GET["act"];

    
    switch ($_SESSION["actie"])	{

        /**** lezen **********/		
		case 1:
			$_srv = "../scripts/l_tonen.php";
			$_start=0;
		break;
            
        /**** toevoegen **********/
		case 2:
			$_srv = "../scripts/l_toevoegen.php";
			$_start=1;
		break;
    
        /**** verwijderen **********/
		case 3:
		  $_srv = "../scripts/l_tonen.php";
		  $_start=0;
		break;
        
        /**** aanpassen **********/
		case 4:
			$_srv = "../scripts/l_tonen.php";
			$_start=0;			
		break;
                
        /**** alle andere waarden **********/
		default:
            $_srv = "../scripts/l_home.php";
            $_start=0;
	
    }
    
        

    /***************** output *************************************************************/
    /**************************************************************************************/
      
        /**** $_smarty instantiëren en initialiseren ********/ 
        require("../smarty/mySmarty.inc.php");

        /**** We kennen de variabelen toe ********/
        $_smarty->assign('inhoud',$_inhoud);
        $_smarty->assign('commentaar', inlezen("l_home.php"));
        $_smarty->assign('menu',menu(1));

        /**** display it ********/
        $_smarty->display('ledenadmin.tpl');

    }

    catch (Exception $_e) {

        /**** exception handling functions ********/ 
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>