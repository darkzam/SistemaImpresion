

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistema de Impresion de Tiquetes</title>

        <?php $this->load->view('plantillas/head'); ?>
    </head>

    <body>

        <div id="cabecera">
            <?php $this->load->view('plantillas/header'); ?>
        </div>

        <div class="ui three column centered grid">

            <div class="column">

                <h2 class="ui header">
                    <i class="book icon"></i>
                    <div class="content">
                        Busqueda de Libros
                    </div>
                </h2>

                <div id="mensaje" class="ui positive message" hidden="true">
                    <div class="header">
                        Impresion Completa:
                    </div>
                    <p>Diríjase a la ventanilla para completar su solicitud de préstamo.</p>

                </div>

                <div id="busquedacont" class="ui segment">

                    <?php echo form_open(current_url(), array('class' => 'ui form', 'id' => 'formulario')); ?>  	
                    <div class="ui doubling one column centered grid">

                        <div class="row">
                            <div class="column">

                                <div class="field ">
                                    <label for="codigo">Buscar Codigo de Barras:</label>

                                    <div class="ui left icon input">
                                        <input type="text" id="codigo" name="codigo" value="" />
                                        <i class="search icon"></i>
                                    </div>
                                </div>


                                <input type="submit" name="buscar" id="buscar" value="Buscar" class="ui search button"/>
                                <a href="<?php echo $base_url; ?>user/busqueda" class="ui button">Volver</a>
                            </div>
                        </div>
                        <?php if (!empty($libro)) { ?>
                            <div class="ui divider"></div>
                            <div class="row">
                                <div class="column">
                                    <div class="ui two fields">
                                        <div class="field ">
                                            <label for="codigoresultado">Codigo de Barras:</label>
                                            <input readonly="" type="text" id="codigo2" name="codigoresultado" value="<?php echo $libro['codigo']; ?>" />
                                        </div>
                                        <div class="field">
                                            <label for="asignatura">Serie:</label>
                                            <input readonly="" type="text" id="titulo" name="titulo" value="<?php echo $libro['serie']; ?>"/>
                                        </div> 
                                    </div>
                                    <div class="field">
                                        <label for="autor">Autor:</label>
                                        <input readonly="" type="text" id="autor" name="autor" value="<?php echo $libro['autor']; ?>"/>
                                    </div>

                                    <div class="field">
                                        <label for="titulo">Titulo:</label>
                                        <input readonly="" type="text" id="titulo" name="titulo" value="<?php echo $libro['titulo']; ?>"/>
                                    </div>

                                    <button type="button" id="imprimir" class="ui button" value="Imprimir Ticket">Imprimir</button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php echo form_close(); ?>	

                    </div>
                </div>
                <?php if (!empty($message)) { ?>
                    <div id="message" class="ui negative message">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>

            </div>
        </div>

        <div id="spinner" class="ui dimmer">
            <div class="ui indeterminate text loader">Imprimiendo</div>
        </div>






        <!-- Scripts -->  
        <?php $this->load->view('plantillas/scripts'); ?> 
    </body>
</html>