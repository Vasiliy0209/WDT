<?php
/*
		Plugin name: Плагин с настройками
		Author: Я
*/
add_action("admin_menu","my_admin_menu");
function my_admin_menu() {
	add_options_page(
		//Заголовок (title) страницы настроек
		"CuPlug",
		//Заголовок пункта меню
		"Настройки нашего плагина",
		//Необходимые права доступа
		"manage_options",
		//Идентификатор меню
		"cuplug-options",
		//Функция, реализующая вывод страницы настроек
		"my_admin_manage"
	);
}

function my_admin_manage() {
	if(isset($_POST["btn_Save"])) {
		update_option("text",$_POST["opt_text"]);
		update_option("color",$_POST["opt_color"]);		
	}
	
	$text=get_option("text");
	$color=get_option("color");	
?>
<div class="wrap">
	<h2>Настройки нашего плагина</h2>
	<form action="" method="POST">
		<label>Текст:</label><br/>
		<input name="opt_text" type="text" value="<?=$text?>"/><br/>
		<label>Цвет:</label><br/>
		<select name="opt_color">
			<option value="#F00">Красный</option>
			<option value="#0F0">Зелёный</option>
			<option value="#00F">Синий</option>
		</select>
		<p class="description">
			Это настройки нашего плагина
		</p>
		<p class="submit">
			<input 
				name="btn_Save"
				type="submit" 
				value="Сохранить изменения"
				class="button button-primary"
			/>
		</p>
	</form>
</div>
<?
}
