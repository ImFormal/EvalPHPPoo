<?php
//FICHIER D'EXECUTION, DONC IMPORT DE TOUTES LES RESSOURCES
session_start();

//IMPORT DES RESSOURCES COMMUNES
include './env.php';
include './utils/utils.php';
include './interface/interfaceModel.php';
include './abstract/abstractController.php';
include './model/playerModel.php';
include './controller/playerController.php';
include './view/viewHeader.php';
include './view/viewFooter.php';
include './view/viewPlayer.php';

$home = new PlayerController(new ViewHeader(),new ViewFooter(),  new ModelPlayer());
$home->render();