<?php

  $_output.=  "<br>".
              $_row['d_voornaam']." ".
              $_row['d_naam'].
              "<br><hr>".
              $_row['d_gender_mnem'].
              "&nbsp; / &nbsp;".
              $_row['d_soortlid_mnem'].
              "<br><hr>".
              $_row['d_straat']."&nbsp;&nbsp;".
              $_row['d_nr']."&nbsp;&nbsp;".
              " / ".
              $_row['d_xtr'].
              "<br>".
              $_row['d_postnummer']."&nbsp;&nbsp;".
              $_row['d_gemeenteNaam'].
              "<br><hr>".
              "Tel : ".$_row['d_tel'].
              "&nbsp; / &nbsp;".
              "Mob : ".$_row['d_mob'].
              "<br>".
              "Mail : ".$_row['d_mail'].
              "<hr>";

?>
