<?php

/*
 * @version		default.php 1.0.1
 * @package		Bootstrap 4 Toast Module
 * @copyright   Copyright (C) 2019 Sergey Tolkachyov
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<?php if ($show_toast == 1): ?>
<script>
	jQuery(document).ready(function($) {
		var toast<?php echo $module->id;?> = '<div class="toast fade <?php echo $toast_module_classes; ?>" style="<?php echo $position_style;?>" id="mod-bootstrap4-toast-<?php echo $module->id;?>" data-autohide="<?php echo $toast_autohide;?>"  <?php echo $toast_autohide_delay.$mod_bs4_toast_important;?> aria-atomic="true"><div class="toast-header <?php echo $toast_module_header_classes; ?>"><?php echo $toast_header_img;?><strong class="mr-auto"><?php echo $toast_header_text;?></strong><?php echo $toast_header_text_small;?><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="toast-body"><?php echo $toast_main_text; echo $toast_confirmation_btn;?></div></div>';

		$('body').append(toast<?php echo $module->id;?>);
		var checkCoockie = getCookie("<?php echo $cookie_name; ?>");
			if (checkCoockie === undefined){
				setTimeout(showPanel<?php echo $toast_show_delay;?>);
			}
		
		function showPanel() {
			$("#mod-bootstrap4-toast-<?php echo $module->id;?>").toast("show");
		}
	<?php if ($toast_confirmation == 1): ?>
	function getCookie(name) {
		let matches = document.cookie.match(new RegExp(
			"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
		return matches ? decodeURIComponent(matches[1]) : undefined;
		}	
	
		$('#mod-bootstrap4-toast-<?php echo $module->id;?>-footer a').on('click', function() {
			var exp_date = new Date();
			exp_date.setTime(exp_date.getTime() + <?php echo $mod_bs4_toast_coockie_exp_date;?>);
			document.cookie = '<?php echo $cookie_name; ?>=1;expires='+exp_date.toUTCString()+';path=/';
			$("#mod-bootstrap4-toast-<?php echo $module->id;?>").toast("hide");
			return false;
		});
	<?php endif; ?>	
    });
</script>

<?php endif; ?>	