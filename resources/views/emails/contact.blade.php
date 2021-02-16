<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
	<tbody>
		<tr style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
			<td style="box-sizing:border-box;color:#222222;font-family:'Helvetica Neue','Helvetica','Arial',sans-serif;font-size:14px;line-height:1.5;padding:25px;vertical-align:top" valign="top">
				<p style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;font-weight:normal;line-height:1.5;margin-bottom:14px">
					
					<span style="box-sizing:border-box;font-family:'Roboto','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:28px;color:#1b55e2;font-weight:800;line-height:1.5;margin-bottom:14px;margin-top:14px;max-width:100%;display:block;">NIIT ENUGU</span>

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					Sender: <strong>{{ $request->name }} &nbsp; &lt; {{ $request->email }} &gt;</strong>

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
				</p>

				<p style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;font-weight:normal;line-height:1.5;margin-bottom:14px">
					{{ $request->message }}
				</p>

            </td>
          </tr>
	</tbody>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
	<tbody>
		<tr style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
			<td style="border-top-color:#d0d0d0;border-top-style:solid;border-top-width:1px;box-sizing:border-box;clear:both;color:#777;font-family:'Helvetica Neue','Helvetica','Arial',sans-serif;font-size:14px;line-height:1.5;padding:25px;vertical-align:top;width:100%" valign="top">

				This message was sent by <strong>{{ $request->name }}</strong> from {{ config('app.name') }}
				<a href="{{ route('contact') }}" style="box-sizing:border-box;color:#4477bd;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5;text-decoration:underline" target="_blank" ><span style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					contact page</span>
				</a> 

				<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
				<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">

				Please, DO NOT reply any suspicious mail.

            </td>
		</tr>
	</tbody>
</table>