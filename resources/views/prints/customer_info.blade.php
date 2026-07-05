<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Transaction info</title>
		<style>
            @page  {
                header: html_myHTMLHeader1;
                footer: html_myHTMLFooter1;
                margin-top: 10%;
                margin-bottom:8%;
                margin-left:40px;
                margin-right:40px;
                margin-header:3%;
                margin-footer:3%;
            }
            .text-bold { font-weight:bold; }
            table#address tr td { font-size:14px; }
            table#transaction tr td { font-size:14px; }
            table#payment_details tr td { text-align:center; }
		</style>
	</head>
	<body>
		<htmlpageheader name="myHTMLHeader1">
			<table style="width:100%; border-collapse:collapse; font-family:arial;" border="0">
				<tr>
					<td style="width:35%; font-size:20px; color:#595959;">Customer List</td>
					<td style="width:20%;"></td>
					<td style="width:45%; font-size:12px; color:#595959; text-align:right;"><?php echo date('Y-m-d H:i:s'); ?></td>
				</tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />

		<table id="payment_details" style="width:100%; border-collapse:collapse; font-family:arial;" border="1" cellpadding="5">
            <thead>
                <tr class="text-center">
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Lastname</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr class="text-center">
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->middle_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('M j, Y') : '' }}</td>
                        <td>{{ $customer->gender }}</td>
                    </tr>
                @endforeach
            </tbody>
		</table>

		<htmlpagefooter name="myHTMLFooter1">

			<table style="border-collapse:collapse; width:100%; font-family:arial;" border="0">
				<tr>
					<td style="text-align:right; border-top:1px solid black;"><i><b>Page: {PAGENO} of {nbpg}</b></i></td>
				</tr>
			</table>

		</htmlpagefooter>

		<sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />
	</body>
</html>
