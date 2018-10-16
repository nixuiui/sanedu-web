<div style=\"background: #fafafa; padding: 0px 25px;\">
	<div style=\"background: #fff; color: #444;\">
		<div style=\"padding:25px 20px 10px; background: #025aa5; border-bottom: 1px solid #fafafa; color: #FFF;\">
			<h3><a href=\"http://sanedu.id\" style=\"font-size: 25px; text-transform: uppercase; text-decoration:none; color: #FFF;\">Sanedu</a></h3>
		</div>
		<div style=\"padding: 20px; border-bottom: 1px solid #fafafa;\">
			<h4 style=\"text-decoration: none; color:#444; font-size:18px;\">Selamat Datang di Sanedu</h4>
		</div>
		<div style=\"padding: 20px; border-bottom: 1px solid #fafafa;\">
			<p>Anda telah meminta untuk merubah password Anda. Klik linnk di bawah ini untuk mengubah password Anda.</p>
            <p><a href="{{ route('auth.password.reset.form', ['token' => $token]) }}">Reset Password</a></p>
            <p>atau</p>
            <p><a href="{{ route('auth.password.reset.form', ['token' => $token]) }}">{{ route('auth.password.reset.form', ['token' => $token]) }}</a></p>
		</div>
		<div style=\"padding: 20px; font-size: 12px; border-bottom: 1px solid #fafafa;\">
			<p style=\"font-size: 10px;\">Copyright &copy; 2017 sanedu.id. All Rights Reserved</p>
		</div>
	</div>
</div>
