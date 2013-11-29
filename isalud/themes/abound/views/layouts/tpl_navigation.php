<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
          
          <div class="nav-collapse">
		  <?php 
		$items = array();
		
		$items[] = array('label'=>'Inicio', 'url'=>array('/site/index'));
		if(Yii::app()->user->id != 0)
		{
			$orderBy = new CDbCriteria(array('order'=>'nombre'));
			$menuUsuario = Modulo::model()->findAllByAttributes(array('id_cat_tipo_usuario'=>Yii::app()->user->tipoUsuario, 'parent_id'=>NULL),$orderBy);
			
			foreach($menuUsuario as $kk => $itemMenu)
			{
				$subMenuUsuario = Modulo::model()->findAllByAttributes(array('parent_id'=>$itemMenu->id),$orderBy);
				
				$arraySubMenu = array();
				if(count($subMenuUsuario) > 0)
				{
					foreach($subMenuUsuario as $jj => $itemSubMenu)
						$arraySubMenu[] = array('label'=>$itemSubMenu->nombre, 'url'=>array('/'.$itemSubMenu->url));
				}
					
				if(count($arraySubMenu) > 0)
					$menuItem = array('label'=>$itemMenu->nombre.' <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
							'items'=>$arraySubMenu);
				else
					$menuItem = array('label'=>$itemMenu->nombre, 'url'=>array('/'.$itemMenu->url));
				array_push($items,$menuItem);
			}
		}
		array_push($items,
			array('label'=>'Iniciar Sesión', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>'Cerrar Sesión ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest));
		  
		  $this->widget('zii.widgets.CMenu',array(
		  	'htmlOptions'=>array('class'=>'pull-right nav'),
			'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
			'itemCssClass'=>'item-test',
			'encodeLabel'=>false,
			'items'=>$items,
			)); ?>
    	</div>
    </div>
	</div>
</div>
