<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(__DIR__ . '/mi_controlador.php');

class productos extends mi_controlador {

    function __construct() {
        parent::__construct();
    }

    /**
     * muestra los productos destacados paginados
     * @param type $inicio
     */
    function pro_destacados($inicio = 0) {

        //parametros para el paginador
        $url = site_url('productos/pro_destacados');
        $total_pagina = 6;
        $total_filas = $this->productos_model->total_destacados();

        //llamada al paginador      
        $datas['paginador'] = $this->paginador($url, $total_pagina, $total_filas);

        $datas['titulo'] = "<h1>Productos Destacados</h1>";

        $datas['productos'] = $this->productos_model->listar_destacados($inicio, $total_pagina);

        $cuerpo = $this->load->view('destacados', $datas, TRUE);

        $this->plantilla($cuerpo);
    }

    function producto_categoria($categoria, $inicio = 0) {

        //parametros para el paginador
        $url = site_url('productos/producto_categoria/' . $categoria . '/');
        $total_pagina = 2;
        $total_filas = $this->productos_model->total_product_categoria($categoria);
        $segm = 4;
        //llamada al paginador      
        $datas['paginador'] = $this->paginador($url, $total_pagina, $total_filas, $segm);

        $productos = $this->productos_model->buscar_productos($categoria, $inicio, $total_pagina);

        $tittle = $this->categorias_modelo->nombre_categoria($categoria);
        $datas['titulo'] = "<h1>" . $tittle . "</h1>";
        $datas['productos'] = $productos;
        $categ['categoria'] = $this->categorias_modelo->todas_categorias();

        $datos['encabezado'] = $this->load->view("encabezado", $categ, TRUE);
        $datos['cuerpo'] = $this->load->view('lista_productos', $datas, TRUE);
        $datos['pie'] = $this->load->view("pie", 0, TRUE);
        $this->load->view('plantilla', $datos);
    }

}
