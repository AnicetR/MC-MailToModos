<?php
/**
 * Created by PhpStorm.
 * User: anice_000
 * Date: 28/02/2015
 * Time: 19:24
 */

return [

    'enable_cache' => true,                       //Activer/désactiver le cache
    'enable_logs' => true,                        //Activer/désactiver les logs
    'verbose' => false,


    'permissions_refresh_rate' => 1,              //Periode entre chaque mise à jour du cache des permissions | En heures
    'query_refresh_rate' => 1,                    //Periode entre chaque mise à jour du cache des joueurs connectés | En minutes

    'players_peaks' => [
                        [
                            'connected_players' => 10, //Nombre de joueurs connectés
                            'connected_staff' => 1,    //Nombre de modérateurs qui doivent être connectés
                            'margin' => 1              //Marge d'erreur, sur le nombre de modos connectés: Dans ce cas, minimum de modos co: 0
                        ],
                        [
                            'connected_players' => 30, //Nombre de joueurs connectés
                            'connected_staff' => 2,    //Nombre de modérateurs qui doivent être connectés
                            'margin' => 1              //Marge d'erreur, sur le nombre de modos connectés: Dans ce cas, minimum de modos co: 1
                        ],

        ],

    'mail_send_rate' => 1, //Periode à partir de laquelle un modérateur peut être recontacté | En heures

];