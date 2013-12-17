<?php
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/json-to-table.js');
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#probar_sentencia_sql').click(function(){
            $.ajax({
                url: '<?php echo Yii::app()->createURL('conexionbdatos/probarsql'); ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#fuente-datos-form').serialize(),
            }).done(function(response) {
                if(response.error) {
                    showError('ERROR: La prueba de la sentencia SQL no fue exitosa, revise el mensaje de error. \n\n'+response.msjerror);
                } else {
                    showExito('La prueba de la sentencia SQL fue exitosa. Puede ver, en la parte inferior, una muestra de los resultados obtenidos');
                    $('#result_probar_sentencia_sql').html('<h3 align="center">Resultado parcial de la ejecución de la Sentencia SQL</h3>'+ConvertJsonToTable(response));
                }
            }).fail(function() {
                showError('ERROR: No se pudo realizar la prueba de la sentencia SQL, intentelo nuevamente o notifiquelo con el administrador del sistema.')
            });
        });

        $('#FuenteDatos_archivo').change(function(){
            extension = ($(this).val().substring($(this).val().lastIndexOf("."))).toLowerCase();
                
            $.ajax({
                url: '<?php echo Yii::app()->createURL('fuentedatos/validararchivo'); ?>',
                type: 'POST',
                dataType: 'json',
                data: 'YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val()+'&archivo='+$(this).val(),
            }).done(function(response) {
                if(response.error) {
                    showAdvertencia('ADVERTENCIA: Existe un archivo, previamente cargado al sistema, con el mismo nombre del que esta intentando subir ('+response.archivo+'). Si desea sobreescribirlo puede continuar, de lo contrario se recomienda renombrar el archivo seleccionado.');
                }
                $('#archivoActual').val('');
            }).fail(function() {
                showError('ERROR: No se pudo realizar la verificación del archivo, intentelo cargar nuevamente o notifiquelo con el administrador del sistema.')
            }).always(function() {
                if(extension == '.csv' || extension == '.txt') {
                    $('#advertencia_csv').fadeIn();
                }
            });
        });
    });

    function mostrarCargando(){
        $('body').prepend('<div class="loading"></div>');
    }
</script>

<?php
/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fuente-datos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php
        echo $form->errorSummary($model);
        
       if(!empty($msjError)) echo '<div class="errorSummary">'.$msjError.'</div>';
    ?>

    <?php
        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                'Datos Generales'=>array(
                    'id'=>'DatosGenerales',
                    'content'=>$this->renderPartial('_form_datosgenerales', array('form'=>$form,'model'=>$model), true)
                ),
                'Base de Datos'=>array(
                    'id'=>'BaseDatos',
                    'content'=>$this->renderPartial('_form_bdatos', array('form'=>$form,'model'=>$model), true)
                ),
                'Archivo'=>array(
                    'id'=>'Archivo',
                    'content'=>$this->renderPartial('_form_archivo', array('form'=>$form,'model'=>$model), true)
                ),
            ),
        ));
    ?>

    <div class="row buttons">
		<?php
        $this->widget('zii.widgets.jui.CJuiButton',array(
            'buttonType'=>'submit',
            'name'=>'btnEnviarForm',
            'value'=>'1',
            'caption'=>($model->isNewRecord ? 'Guardar' : 'Actualizar'),
            'onclick'=>new CJavaScriptExpression('mostrarCargando'),
            )
        );
        ?>
	</div>
<?php $this->endWidget(); ?>
    
    <div id="advertencia_csv" style="display: none">
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>
                Un archivo en formato CSV (Comma Separated Values) o en texto plano debe tener el siguiente formato: 
                La primera Fila debe contener el nombre de las columnas. 
                Las columnas deben estar separada por una coma (,) y las filas se delimitan con una nueva linea de lo contrario 
                el sistema no podrá leer los datos de manera correcta
            </strong>
        </div>
    </div>
    
</div><!-- form -->

<div id="result_probar_sentencia_sql" style="margin: auto;">

</div>