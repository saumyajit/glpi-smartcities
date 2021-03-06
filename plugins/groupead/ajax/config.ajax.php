<?php
//============================================================================//
//==    Plugin pour GLPI - Dévelloppeur: Viduc (Fleury Tristan) - ©2013     ==//
//==            http://viduc.sugarbox.fr - viduc@sugarbox.fr                ==//
//============================================================================//

/**
 * Traite toute les demandes ajax du plugin
 */
define('GLPI_ROOT', getAbsolutePath());
include (GLPI_ROOT."inc/includes.php");

//Instanciation de la class config
$config = new PluginGroupeadConfig();

if(isset($_POST['action']))
    {   
    if($_POST['action'] == "modifierAD")
        {
        if( strstr($_POST['identification'], "valider")) 
            {
            $valeur['serveur'] = $_POST['serveur'];
            $valeur['dc'] = $_POST['dc'];
            $valeur['suffix'] = $_POST['suffix'];
            $valeur['login'] = $_POST['login'];
            $valeur['passwd'] = $_POST['passwd'];
            $valeur['groupe'] = $_POST['groupe'];
            $config->setValeurInfoAD($_POST['identification'],$valeur);
            }
        else{$config->setValeurInfoAD($_POST['identification'],$_POST['valeur']);}
        }
    if($_POST['action'] == "ajoutAD")
        {$config->setAD();}
    
    if($_POST['action'] == "testerAD")
        {
            $valeur['serveur'] = $_POST['serveur'];
            $valeur['dc'] = $_POST['dc'];
            $valeur['suffix'] = $_POST['suffix'];
            $valeur['login'] = $_POST['login'];
            $valeur['passwd'] = $_POST['passwd'];
            echo $config->testerAD($valeur);
        }
    }

/**
 * Récupère le chemin absolue de l'instance glpi
 * @return String : le chemin absolue (racine principale)
 */
function getAbsolutePath()
    {return str_replace("plugins/groupead/ajax/config.ajax.php", "", $_SERVER['SCRIPT_FILENAME']);}

/**
 * Récupère le chemin http absolu de l'application glpi
 * @return string : le chemin http absolue de l'application
 */
function getHttpPath()
    {
    $temp = explode("/",$_SERVER['HTTP_REFERER']);
    $Ref = "";
    foreach ($temp as $value)
        {
        if($value != "plugins"){$Ref.= $value."/";}
        else{break;}
        }
    return $Ref;
    }

?>
