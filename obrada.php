<?php
    include "Database.php";
    $mydb = new Database('rest');
    if(isset($_POST["posalji"]) && $_POST["posalji"]="Posalji zahtev"){
        // novosti_post
        if($_POST["naslov_novosti"]!=null && $_POST["tekst_novosti"]!=null && $_POST["kategorija_odabir"]!=null){
            $niz = ["naslov"=> "'".$_POST["naslov_novosti"]."'", "tekst"=>"'".$_POST["tekst_novosti"]."'", "datumvreme"=>"NOW()", "kategorija_id"=>$_POST["kategorija_odabir"]];
            if($mydb->insert("novosti", "naslov, tekst, datumvreme, kategorija_id", $niz)){
                echo "vrednosti ubacene";
            }else{
                echo "vrednosti nisu ubacene";
            }
            $_POST = array();
            exit();
        // brisanje_reda
        }elseif($_POST["brisanje"]!=null && $_POST["odabir_tabele"]!=null){
            $tabela = $_POST["odabir_tabele"];
            $id = "id";
            $id_val = $_POST["brisanje"];
            if($mydb->delete($tabela,$id,$id_val)){
                echo "red obrisan";
            }else{
                echo "greska prilikom brisanja";
            }
            $_POST = array();
            exit();
        // kategorije_post
        } else if ($_POST["kategorija_naziv"]!=null) {
            $naziv = $_POST["kategorija_naziv"];
            if($mydb->insert("kategorija", "naziv", [$naziv])){
                echo "vrednosti ubacene";
            }else{
                echo "vrednosti nisu ubacene";
            }
            $_POST = array();
            exit();
        // kategorije_put
        } else if ($_POST["kategorija_id"] != null && $_POST["kategorija_naziv_put"] != null) {
            $id = $_POST["kategorija_id"];
            $naziv = $_POST["kategorija_naziv_put"];

            if($mydb->update("kategorija", $id, "naziv", [$naziv])){
                echo "vrednosti izmenjene";
            }else{
                echo "vrednosti nisu izmenjene";
            }
            $_POST = array();
            exit();
        }
    }
?>