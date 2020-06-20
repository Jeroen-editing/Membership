<?php

    $_inhoud.= "
        <form method='post' action='$_srv'>
            <label>Naam</label>
                <input type='text' name='naam'>
            <label>Voornaam</label>
                <input type='text' name='voornaam'>
            <br><hr>";
            
    $_inhoud.= "<label>Gender</label>";
    $_inhoud.= dropDown("gender", "t_gender", "d_index", "d_mnemonic", $_start);

    $_inhoud.= "<label>Soort lid</label>";
    $_inhoud.= dropDown("soort", "t_soort_lid", "d_index", "d_mnemonic", $_start);


    $_inhoud.= "
            <br><hr>
            <label>Straat</label>
                <input type='text' name='straat' size='20'>
            <label>Nr & Extra</label>
                <input type='text' name='nr' size='8'>
                <input type='text' name='xtr' size='8'>
            <label>Postcode</label>
                <input type='text' name='postcode' size='8'>
            <label>Gemeente</label>
                <input type='text' name='gemnaam' size='34'>
            <br><hr>
            <label>Telefoon & Mobiel</label>
                <input type='text' name='tel' size='12'>
                <input type='text' name='mob' size='12'>
            <label>E-mail</label>
                <input type='text' name='mail' size='34'>
            <br><hr>
            <input type='submit' name='submit' id='submit' value='verzenden'>
            <br><hr>
        </form>";    

?>