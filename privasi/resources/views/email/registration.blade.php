<div style=\"background: #fafafa; padding: 0px 25px;\">
	<div style=\"background: #fff; color: #444;\">
		<div style=\"padding:25px 20px 10px; background: #025aa5; border-bottom: 1px solid #fafafa; color: #FFF;\">
			<h3><a href=\"http://sanedu.id\" style=\"font-size: 25px; text-transform: uppercase; text-decoration:none; color: #FFF;\">Sanedu</a></h3>
		</div>
		<div style=\"padding: 20px; border-bottom: 1px solid #fafafa;\">
			<h4 style=\"text-decoration: none; color:#444; font-size:18px;\">Selamat Datang di Sanedu</h4>
		</div>
		<div style=\"padding: 20px; border-bottom: 1px solid #fafafa;\">
			<p>Terima kasih sudah mendaftar di Sanedu.id. Tinggal selangkah lagi untuk melengkapi registrasi Anda.</p>
			<a href="{{ route('email.verification') }}?username={{ $username }}&&code={{$code}}" style=\"display: inline-block; padding: 10px 20px; border-radius: 3px; background: #025aa5; color: #FFF; font-weight: 600; font-size: 25px; text-decoration: none;\">Verifikasi</a>
			<br>
			atau
			<br>
			<a href="{{ route('email.verification') }}?username={{ $username }}&&code={{$code}}">{{ route('email.verification') }}?username={{ $username }}&&code={{$code}}</a>
		</div>
		<div style=\"padding: 20px; font-size: 12px; border-bottom: 1px solid #fafafa;\">
			<p style=\"font-size: 10px;\">Copyright &copy; 2016 website.com. All Rights Reserved</p>
		</div>
	</div>
</div>
