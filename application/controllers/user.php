
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->vars('base_url', 'http://www.sistemaimpresion.com/');
        $this->load->vars('includes_dir', 'http://www.sistemaimpresion.com/includes/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
        $this->data = null;
       
    }

    public function index() {

        $this->busqueda();
    }

    public function busqueda() {
        $this->load->model('user_model');

        if ($this->input->post('buscar') && $this->input->post('codigo')) {
            $codigo = $this->input->post('codigo');
            if (!empty($codigo)) {
                $codigo = str_replace('-', ' ', $codigo);
            } else {
                $codigo = 'none';
            }
            redirect('user/busqueda/cod/' . $codigo);
        }

        $this->user_model->get_fichas();

        $this->load->view('user/user_view', $this->data);
    }

    function impresion() {

        $this->load->model('user_model');
        $libro = $this->user_model->get_fichas($this->input->post('codigo'));
        $this->imprimir($libro);
        echo json_encode($libro);
    }

    public function imprimir($libro) {


//dibujar la plantilla 
        $tempPath = "./includes/temp/" . $libro['codigo'] . ".pdf";

        if (!is_file($tempPath)) {

            $this->load->library('fpdf/Pdf');
            $this->pdf->SetMargins(0.1, 0.1, 0.1);
            $this->pdf->SetAutoPageBreak(true, 0.0);
            $this->pdf->AddPage('P', array(76, 130));

            $this->pdf->SetFont('Arial', '', 8);
            $this->pdf->SetTextColor(0, 0, 0);

            $texto = "Codigo:\n" . $libro['codigo'] . "\nTitulo:\n" . utf8_decode($libro['titulo']) . "\nAutor:\n" . utf8_decode($libro['autor']) . "\nSerie:\n" . utf8_decode($libro['serie']);

            $this->pdf->MultiCell(0, 6.0, $texto, 1, 'C', false);

            $this->pdf->Output($tempPath, 'F');
        }
//imprimir
        //para windows
        //exec('java -jar C://impresion//pdfbox.jar PrintPDF -silentPrint C://xampp//htdocs//SistemaImpresion//includes//temp//' . $libro['codigo'] . '.pdf');
        //para linux

        exec('java -jar /home/impresion/pdfbox.jar PrintPDF -silentPrint /var/www/SistemaImpresion/includes/temp/' . $libro['codigo'] . '.pdf');
    }

}
