<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.fileDownload.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/exportarDatos.js');

/* @var $this FuenteDatosController */
/* @var $model FuenteDatos */

$this->breadcrumbs=array(
	$this->title_sin=>array('index'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Listar '.$this->title_plu, 'url'=>array('index')),
	array('label'=>'Crear '.$this->title_sin, 'url'=>array('create')),
    array('label'=>'Ver '.$this->title_sin, 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar '.$this->title_plu, 'url'=>array('admin')),
);
?>

<h1>Datos de la <?php echo $this->title_sin.' '.$model->nombre; ?> </h1>

<?php

if($countDatos == 0) {
    echo '<div class="errorSummary"><strong>No se encontraron datos en la '.$this->title_sin.'</strong></div>';
}
else {
    $dataProvider=new CSqlDataProvider($sqlAllDatos, array(
        'totalItemCount'=>$countDatos,
        'pagination'=>array(
            'pageSize'=>Yii::app()->params['filasPorPagina'],
        ),
    ));

    // Cuando se exportan los datos a excel,
    // se deshabilita la paginacion
    if(Yii::app()->request->getQuery('grid_mode') == 'export')
       $dataProvider->pagination = false;

    /**
     * Fuente http://www.yiiframework.com/extension/eexcelview/
     */
    $this->widget('ext.EExcelView.EExcelView', array(
        'dataProvider'=> $dataProvider,
        'title'=>$model->nombre,
        'autoWidth'=>true,
        'libPath'=>'ext.phpexcel.Vendor.PHPExcel',
        'exportType'=>'Excel2007',
        'stream' => 'true',
        'disablePaging' => 1,
        //'grid_mode' => 'grid',//export
        // grid_mode_var => 'grid_mode'
    ));

    $this->widget('zii.widgets.jui.CJuiButton',array(
        'buttonType'=>'link',
        'name'=>'exportarDatos',
        'caption'=>'Exportar Datos a Excel',
        'options'=>array(
            'icons'=>array(
                'primary'=>'ui-icon-document',
            )
        ),
        'url'=>Yii::app()->createUrl("/fichatecnica/verdatos", array("id" => $model->id)).'?grid_mode=export',
        'onclick'=>new CJavaScriptExpression('fnExportarDatos'),
    ));
}
?>