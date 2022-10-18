<?
/*
	Plugin name: Ajax Samp
	Author: Me
*/
//Активация JQuery
wp_enqueue_script('jquery');

function my_action_javascript(){?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#countries").change(function(){
				//alert(jQuery(this).val());
				var ajaxdata = {
					action: "mysampajax",
					nonce_code: "<?=wp_create_nonce("myajax-nonce")?>",
					country_id: jQuery(this).val()
				};
				
				/*jQuery.post(
					"<?=admin_url("admin-ajax.php")?>",
					ajaxdata,
					function(responce) {
						var cities_select=jQuery("#cities");
						alert(responce);
						for(var city in responce){
							alert(city);
							//cities_select.append('<option>'+city+'</option');
						}
					}
				);*/
				
				jQuery.ajax({
					url: "<?=admin_url("admin-ajax.php")?>",
					method: "POST",
					data: ajaxdata,
					dataType: "json",					
					success: function(responce) {
						var city_options="";
						//alert(responce);
						responce.forEach(function(value){
							city_options+='<option>'+value+'</option>';							
						});
						
						jQuery("#cities").html(city_options);
					}
				});
			});
		});
	</script>
<?}
add_action("wp_footer","my_action_javascript",99);

function ajax_callback(){
	$cities=Array(
		1=>Array("Челябинск","Екатеринбург","Москва"),
		2=>Array("Париж","Марсель","Авиньон"),
		3=>Array("Барселона","Мадрид","Жирона","Calella")
	);
	
	$country_id=(int)$_POST["country_id"];
	echo json_encode($cities[$country_id]);
	//echo "Hello";
	wp_die();
}
add_action("wp_ajax_mysampajax","ajax_callback");

function frontend_filter($content) {
	return $content.'
		<select id="countries">
			<option value="1">Россия</option>
			<option value="2">Франция</option>
			<option value="3">Испания</option>
		</select>
		<select id="cities"></select>
	';
}
add_filter("the_content","frontend_filter");
