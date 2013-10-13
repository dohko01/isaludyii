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
                data: 'YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val()+'&conexion='+$('#FuenteDatos_id_conexion_bdatos').val()+'&sql='+$('#FuenteDatos_sentencia_sql').val(),
            }).done(function(response) {
                if(response.error) {
                    alert('ERROR: La prueba de la sentencia SQL no fue exitosa, revise el mensaje de error. \n\n'+response.msjerror);
                } else {
                    alert('La prueba de la sentencia SQL fue exitosa. Puede ver, en la parte inferior, una muestra de los resultados obtenidos');
                    $('#result_probar_sentencia_sql').html('<h3>Resultado parcial de la ejecución de la Sentencia SQL</h3>'+ConvertJsonToTable(response.resultado));
                }
            }).fail(function() {
                alert('ERROR: No se pudo realizar la prueba de la sentencia SQL, intentelo nuevamente o notifiquelo con el administrador del sistema.')
            });
        });

        $('#FuenteDatos_archivo').change(function(){
            $.ajax({
                url: '<?php echo Yii::app()->createURL('fuentedatos/validararchivo'); ?>',
                type: 'POST',
                dataType: 'json',
                data: 'YII_CSRF_TOKEN='+$('[name=YII_CSRF_TOKEN]').val()+'&archivo='+$(this).val(),
            }).done(function(response) {
                if(response.error) {
                    alert('ERROR: Existe un archivo, previamente cargado al sistema, con el mismo nombre del que esta intentando subir ('+response.archivo+'). Si desea sobreescribirlo puede continuar, de lo contrario se recomienda renombrar el archivo seleccionado.');
                }
            }).fail(function() {
                alert('ERROR: No se pudo realizar la del archivo, intentelo cargar nuevamente o notifiquelo con el administrador del sistema.')
            });
        });
    });
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

	<?php echo $form->errorSummary($model); ?>

    <?php
        $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                'Datos Generales'=>array(
                    'content'=>$this->renderPartial('_form_datosgenerales', array('form'=>$form,'model'=>$model), true)
                ),
                'Base de Datos'=>array(
                    'content'=>$this->renderPartial('_form_bdatos', array('form'=>$form,'model'=>$model), true)
                ),
                'Archivo'=>array(
                    'content'=>$this->renderPartial('_form_archivo', array('form'=>$form,'model'=>$model), true)
                ),
            ),
        ));
    ?>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<div id="configurar_campos">

</div>

<div id="result_probar_sentencia_sql">

</div>