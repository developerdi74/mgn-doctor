<?
/**
 * Created by PhpStorm.
 * User: william
 * Date: 04.10.2022
 * Time: 20:42
 */
?>
<script>
	$(document).ready(function(){
		$('input[name="form_text_32"]').each(function(){
			$(this).closest('.popup-item').css('display', 'none');
		});
	});
</script>