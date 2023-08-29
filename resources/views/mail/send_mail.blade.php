@php
$SettingsData = gSettings();
$site_title = $SettingsData['site_title'] ? $SettingsData['site_title'] : 'EXP';
@endphp
<table style='background-color:#edf2f7;color:#111111;padding:40px 0px;line-height:24px;font-size:14px;' border='0' cellpadding='0' cellspacing='0' width='100%'>	
	<tr>
		<td>
			<table style='background-color:#fff;max-width:600px;margin:0 auto;padding:30px;' border='0' cellpadding='0' cellspacing='0' width='100%'>
				<tr><td style='font-size:20px;font-weight:bold;padding:0px 0px 15px 0px;'>Hello!</td></tr>
				<tr><td style='padding-bottom:7px;'><strong>Name: </strong>{{ $details['name'] }}</td></tr>
				<tr><td style='padding-bottom:7px;'><strong>Email: </strong>{{ $details['email'] }}</td></tr>
				<tr><td style='padding-bottom:7px;'><strong>Subject: </strong>{{ $details['subject'] }}</td></tr>
				<tr><td style='padding-bottom:50px;'><strong>Message: </strong>{{ $details['message'] }}</td></tr>
				<tr><td style='padding-top:10px;'>Thank you!</td></tr>
				<tr><td style='padding-top:5px;padding-bottom:40px;'><strong>{{ $site_title }}</strong></td></tr>
				<tr><td style='padding-top:10px;border-top:1px solid #ddd;'>Mail from {{ $site_title }} contact form: {{ url('/') }}</td></tr>
			</table>
		</td>
	</tr>
</table>