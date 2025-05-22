<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Form Submission</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f7; font-family: Arial, sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f4f4f7; padding: 30px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ffffff; border-radius:8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;">
          <tr>
            <td style="text-align:center; padding-bottom: 20px;">
              <h1 style="margin:0; font-size: 28px; color: #333333;">Customers Inquery Form Submission</h1>
              <p style="color:#888888; font-size: 14px; margin-top:5px;">You have received a new message via your {{ config('app.name') }} contact form.</p>
            </td>
          </tr>

          <tr>
            <td style="padding: 10px 0; border-top: 1px solid #eeeeee;">
              <p style="margin:0; font-weight: bold; color: #555555;">Name:</p>
              <p style="margin:5px 0 15px 0; color: #333333;">{{ $formData['name'] }}</p>

              <p style="margin:0; font-weight: bold; color: #555555;">Email:</p>
              <p style="margin:5px 0 15px 0; color: #333333;">{{ $formData['email'] }}</p>

                   <p style="margin:0; font-weight: bold; color: #555555;">Subject:</p>
              <p style="margin:5px 0 15px 0; color: #333333;">{{ $formData['subject'] }}</p>

              <p style="margin:0; font-weight: bold; color: #555555;">Message:</p>
              <p style="margin:5px 0 15px 0; padding: 15px; background-color: #f9f9f9; border-left: 4px solid #4CAF50; color: #333333; white-space: pre-wrap;">
                {{ $formData['message'] }}
              </p>
            </td>
          </tr>

          <tr>
            <td style="text-align:center; padding-top: 20px; font-size: 12px; color: #999999;">
              <p style="margin:0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
