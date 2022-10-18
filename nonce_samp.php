<?php
/*
	Plugin name: Нонсдемо
	Author: Me
*/

function invoker() {
	if(isset($_GET["demo-nonce"])){
		if(!wp_verify_nonce($_GET["demo-nonce"]))
			wp_die("Плохой нонс");
		else {
			header("Location: $_SERVER[HTTP_REFERER]");
			exit();
		}
	}
}
add_action("plugins_loaded","invoker");

function link_to_click($content) {
	$nonce=wp_create_nonce();
return $content."<a href=\"?demo-nonce=$nonce\">Нажми сюда!</a>";
}
add_action("the_content","link_to_click");
