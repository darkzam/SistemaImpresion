<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author Zamir
 */
class user_model {

    public function &__get($key) {
        $CI = & get_instance();
        return $CI->$key;
    }

    public function get_fichas($param = false) {

        $this->load->database();

        if (!$param) {
            //buscar codigo para mostrar en pantalla los datos
            $uri = $this->uri->uri_to_assoc(3);
            if (array_key_exists('cod', $uri)) {

                if (empty($uri['cod']) || $uri['cod'] === 'none') {

                    $claves['cod'] = '';
                } else {

                    $claves['cod'] = $uri['cod'];
                }

                $string = strtolower($claves['cod']);
                $string = urldecode($string);
                $string = trim($string);
                $string = str_replace(' ', '', $string);


                $this->db->select('*')->from('fichas');

                $this->db->where('codigo', $string);

                $query = $this->db->get();

                $this->data['libro'] = $query->row_array();
                
                if (empty($this->data['libro'])) {
                $this->data['message'] = "No se encuentra el libro";
                }
           
            }
        } else {
            //buscar por codigo para imprimir
            $string = strtolower($param);
            $string = urldecode($string);
            $string = trim($string);
            $string = str_replace(' ', '', $string);

            $this->db->select('*')->from('fichas');

            $this->db->where('codigo', $string);

            $query = $this->db->get();

            $libro = $query->row_array();
            // $this->data['message'] = '';
            return $libro;
        }
    }

}
