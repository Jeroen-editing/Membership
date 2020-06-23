<?php

    $_inhoud.=
        "<form method='post' action='$_srv'>
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
                  <input type='text' name='nr' class='formNr' size='8'>
                  <input type='text' name='xtr' size='10'>
                <label>Postcode</label>
                  <input type='text' name='postcode' class='formNr' size='8'>
                <label>Gemeente</label>
                  <input type='text' name='gemnaam' size='40'>
            </fieldset>
            <br><br>
            <fieldset>
              <legend>Contact gegevens</legend>
                <label>Telefoon</label>
                  <input type='text' name='tel' size='14'>
                <label>Mobiel</label>
                  <input type='text' name='mob' size='14'>
                <label>E-mail</label>
                  <input type='text' name='mail' size='40'>
            </fieldset>
            <br><br>
            <fieldset id='buttons'>
            <input type='reset' name='reset' id='reset' value='reset'>
            <input type='submit' name='submit' id='submit' value='verzenden & verwerken'>
            </fieldset>
        </form>";

?>
