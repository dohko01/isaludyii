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
		$items[] = array('label'=>'Home', 'url'=>array('/site/index'));
		if(Yii::app()->user->id != 0 && Yii::app()->user->tipoUsuario == 1)
		{
			array_push($items,
					array('label'=>'Catalogos <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
							'items'=>array(
								array('label'=>'Tipos de Usuario', 'url'=>array('/tipoUsuario')),
								array('label'=>'Usuarios', 'url'=>array('/usuario')),
								array('label'=>'Tipo Indicador', 'url'=>array('/tipoIndicador')),
								array('label'=>'Nivel', 'url'=>array('/nivel')),
								array('label'=>'Clasificacion', 'url'=>array('/clasificacion')),
								array('label'=>'Direccion', 'url'=>array('/direccion')),
                                array('label'=>'Motor de base de datos', 'url'=>array('/motorbdatos')),
                                array('label'=>'Significado de campo', 'url'=>array('/significadocampo')),
                                array('label'=>'Tipo de campo', 'url'=>array('/tipocampo')),
                                array('label'=>'Criterio de evaluación', 'url'=>array('/criterioevaluacion')),
                                array('label'=>'Periodicidad', 'url'=>array('/periodicidad')),
                                array('label'=>'Escala de evaluación', 'url'=>array('/escalaevaluacion')),
							)));
		}
		//
		if(Yii::app()->user->id != 0 && Yii::app()->user->tipoUsuario == 2)
		{
			array_push($items,
					array('label'=>'Menu Analista <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
							'items'=>array(
								array('label'=>'List 1', 'url'=>'#'),
								array('label'=>'List 2', 'url'=>'#'),
								array('label'=>'List 3', 'url'=>'#'),
							)));
		} 
		array_push($items,
			array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
			array('label'=>'Contact', 'url'=>array('/site/contact')),
			array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest));
		  
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

<div class="subnav navbar navbar-top">
    <div class="navbar-inner">
    	<div class="container">
        
        	<!--div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div-->
           <form class="navbar-search pull-right" action="">
           	 
           <!--input type="text" class="search-query span2" placeholder="Search"-->
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->