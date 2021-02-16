<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
	<tbody>
		<tr style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
			<td style="box-sizing:border-box;color:#222222;font-family:'Helvetica Neue','Helvetica','Arial',sans-serif;font-size:14px;line-height:1.5;padding:25px;vertical-align:top" valign="top">
				<p style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;font-weight:normal;line-height:1.5;margin-bottom:14px">
					
					<span style="box-sizing:border-box;font-family:'Roboto','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:28px;color:#1b55e2;font-weight:800;line-height:1.5;margin-bottom:14px;margin-top:14px;max-width:100%;display:block;">NIIT ENUGU</span>

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					Hi {{ $attendee->first_name }},
				</p>

				<p style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;font-weight:normal;line-height:1.5;margin-bottom:14px">
					You have successfully registered for this year's NIIT Sholarship. Your invitation code is:

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">

					<code style="font-size:20px;background-color:#edeef9;padding:10px 15px;">{{ $attendee->invitation_code }}</code>

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
				</p>

				<p style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;font-weight:normal;line-height:1.5;margin-bottom:14px">
					<em>Keep your invitation code safe, as it might be required for entry into the exams.</em> <br>
					Find the details of the scholarship exams below.

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">

					<strong>Title: {{ $attendee->scholarship->title }}</strong> <br>
					@if ($attendee->scholarship->venue) <strong>Venue: {{ $attendee->scholarship->venue }}</strong> <br> @endif
					<strong>Date: {{ $attendee->scholarship->eventDate }}</strong> <br>
					@if ($attendee->scholarship->time) <strong>Your Preferred Time: {{ date('h:ia', strtotime($attendee->preferred_exam_time)) }}</strong> <br> @endif

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					
					Warm regards - we look forward to seeing you at the exams!

					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">

					Team {{ config('app.name') }}
					<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
				</p>

            </td>
          </tr>
	</tbody>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
	<tbody>
		<tr style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
			<td style="border-top-color:#d0d0d0;border-top-style:solid;border-top-width:1px;box-sizing:border-box;clear:both;color:#777;font-family:'Helvetica Neue','Helvetica','Arial',sans-serif;font-size:14px;line-height:1.5;padding:25px;vertical-align:top;width:100%" valign="top">

				Phone: {{ config('app.phone') }} 
				@if (config('app.phone_2') != '') , {{ config('app.phone_2') }} @endif  <br>
				Email: {{ config('app.email') }}

				<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">
				<br style="box-sizing:border-box;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5">

				Address: {{ config('app.address') }}

            </td>
		</tr>
	</tbody>
</table>