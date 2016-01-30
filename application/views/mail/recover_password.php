<html>
	<body>
		<?php $url = base_url().'auth/update_password?token='.base64_encode($id.'/-/'.$hash); ?>
		<?= sprintf($this->lang->line('recover_password_email'), $name, $url, $url, date('Y-m-d')) ?>
	</body>
</html>