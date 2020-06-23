<?php

    $_inhoud.= "<div id='toontabel'>
                    <table>
                        <thead>
                            <tr>
                                <th>".
                                    $_row['d_voornaam'].
                                "</th>
                                <th>".
                                    $_row['d_naam'].
                                "</th>
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
                            <tr></tr>
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
                </div>";

?>