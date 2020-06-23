<?php

    function menu($_menu) {

        global $_PDO;


        $_output[0] = "ERROR";


        $_query = " SELECT d_item, d_link
                    FROM t_menu
                    ORDER BY d_volgorde
                    ASC; ";

        
        $_result = $_PDO -> query("$_query");


        $_x = 0;


        while ($_row = $_result -> fetch(PDO::FETCH_ASSOC)) {
            
            $_output[$_x] = $_row;


            $_x++;

        }

        return($_output);

    }

?>