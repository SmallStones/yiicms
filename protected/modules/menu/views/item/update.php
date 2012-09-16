<?php
/** @var $model Item */
$this->breadcrumbs = array(
	Yii::t('menu', 'Меню')        => array('default/admin'),
	Yii::t('menu', 'Пункты меню') => array('admin'),
	Yii::t('menu', 'Изменение ' . $model->title),
);
$this->menu        = array(
	//@formatter:off
	array('label' => Yii::t('menu', 'Меню')),
	array('icon' => 'list', 'label' => Yii::t('menu', 'Управление'), 'url' => array('default/admin')),
	array('icon' => 'file', 'label' => Yii::t('menu', 'Добавить'), 'url' => array('default/create')),

	array('label' => Yii::t('menu', 'Пункты меню')),
	array('icon' => 'list-alt', 'label' => Yii::t('menu', 'Управление'), 'url' => array('item/admin')),
	array('icon' => 'file', 'label' => Yii::t('menu', 'Добавить'), 'url' => array('item/create')),
	array(
		'icon'       => 'pencil white',
		'encodeLabel'=> false,
		'label'      => Yii::t('page', 'Изменение'),
		'url'        => array('/menu/item/update', 'id'=> $model->id)
	),
	//@formatter:on
);
?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>