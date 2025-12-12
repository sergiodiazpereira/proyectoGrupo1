<?php
    require_once __DIR__.'/../config/rutas.php';
    require_once __DIR__.'/../modelos/modGaleria.php';
    class ConGaleria{
        public $modeloGal;
        public $vista;
        function __construct(){
            $this->modeloGal = new ModGaleria();
        }

        public function cargarPagina(){
            $this->vista="admin/listarGaleria.php";
        }

        public function obtenerDatosImagenes(){ 
            $datosImagenes = [
                [
                    "idImagen" => 1,
                    "nombreImagen" => "dsa",
                    "idAsoc" => 2
                ],
                [
                    "idImagen" => 4,
                    "nombreImagen" => "ddssa",
                    "idAsoc" => 1
                ],
                [
                    "idImagen" => 3,
                    "nombreImagen" => "imagendeasociacion1",
                    "idAsoc" => 1
                ],
                [
                    "idImagen" => 4,
                    "nombreImagen" => "ddssa",
                    "idAsoc" => "null"
                ],
                [
                    "IdImagen" => 7,
                    "nombreImagen" => "nombreejemplo.png",
                    "idAsoc" => "null"
                ]
            ];
            //$datosImagenes = $this->modeloJ->datosImagenes(); ---------
            echo json_encode($datosImagenes); 
            exit;
        }
    }
?>