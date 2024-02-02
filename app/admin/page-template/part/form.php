<h2>Configuration des templates </h2>
<form method="post" action="options.php"> 
<input type="hidden" name="action" value="save_template_options_action">
<div>
<?php
settings_fields('ng1-template-settings');
do_settings_sections('ng1-template-settings');
submit_button();
?>
</div>
</form>