<?php
$count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_datos_origen WHERE id_fuente_datos=2')->queryScalar();
$sql='SELECT CAST(datos->\'id_estado\' AS integer) AS id_estado, CAST(datos->\'id_institucion\' AS integer) AS id_institucion, CAST(datos->\'id_jurisdiccion\' AS integer) AS id_jurisdiccion, CAST(datos->\'id_municipio\' AS integer) AS id_municipio, CAST(datos->\'anio\' AS integer) AS anio, CAST(datos->\'mes\' AS integer) AS mes, CAST(datos->\'menor_uno\' AS integer) AS pob_ninios_menor_1 FROM tbl_datos_origen WHERE id_fuente_datos = 2 AND CAST(datos->\'menor_uno\' AS INTEGER) > 0';
$dataProvider=new CSqlDataProvider($sql, array(
    'totalItemCount'=>$count,
//    'sort'=>array(
//        'attributes'=>array(
//             'id', 'username', 'email',
//        ),
//    ),
    'pagination'=>array(
        'pageSize'=>20,
    ),
));

//$dataProvider=new CActiveDataProvider('Variable');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
));
?>
