<html>
	<body>
		<p>Hi <?= $name; ?>.</p>
		<p>We have received a password recovery application for access to our content management system. If you did not request this, please ignore this email.</p>
		<p>To write a new password, click on this link <a href="<?= base_url() ?>auth/update_password?token=<?= base64_encode($id.'/-/'.$hash) ?>"><?= base_url() ?>/auth/new_password?token=<?= base64_encode($id.'/-/'.$hash) ?></a> or copy and paste the address into your browser.</p>
		<p>remember that this URL will only be available for 5 days starting today, <?= date('Y-m-d',time()) ?>.</p>

		<p>Happy day,</p>
		<p><strong>Auto_Forms</strong></p>
	</body>
</html>