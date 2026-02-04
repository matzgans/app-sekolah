<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notifikasi Pengaduan</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <table style="background-color: #f4f6f8; padding: 40px 0;" border="0" cellpadding="0" cellspacing="0"
        width="100%">
        <tr>
            <td align="center">

                <table
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; width: 600px; max-width: 100%;"
                    border="0" cellpadding="0" cellspacing="0" width="600">

                    <tr>
                        <td style="background-color: #2563eb; font-size: 0; line-height: 0;" bgcolor="#2563eb"
                            height="6">&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">

                            <h1 style="color: #1e293b; font-size: 24px; margin: 0 0 20px 0; font-weight: bold;">
                                Hello, {{ $name }} 👋
                            </h1>
                            <p style="color: #475569; font-size: 16px; line-height: 24px; margin: 0 0 25px 0;">
                                Terima kasih telah menghubungi kami. Laporan pengaduan Anda telah kami terima dan
                                tercatat di dalam sistem.
                            </p>

                            <table style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;"
                                border="0" cellpadding="0" cellspacing="0" width="100%">

                                <tr>
                                    <td style="padding: 15px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 14px; font-weight: 600;"
                                        width="40%">
                                        No Tiket
                                    </td>
                                    <td style="padding: 15px; border-bottom: 1px solid #e2e8f0; color: #0f172a; font-size: 14px; font-weight: bold; font-family: monospace;"
                                        width="60%">
                                        #{{ $no_tiket }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="padding: 15px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 14px; font-weight: 600;">
                                        Tanggal
                                    </td>
                                    <td
                                        style="padding: 15px; border-bottom: 1px solid #e2e8f0; color: #0f172a; font-size: 14px;">
                                        {{ $tanggal_pengaduan }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 15px; color: #64748b; font-size: 14px; font-weight: 600;">
                                        Status
                                    </td>
                                    <td style="padding: 15px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td
                                                    style="background-color: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                                                    {{ $status_pengaduan }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                            <p style="color: #64748b; font-size: 14px; line-height: 22px; margin: 30px 0 0 0;">
                                Mohon menunggu, tim kami akan segera menindaklanjuti laporan Anda. Anda akan menerima
                                notifikasi email selanjutnya jika status berubah. Cek Berkala Tiket Anda Di Halaman
                                Pengaduan.
                            </p>

                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background-color: #f1f5f9; padding: 20px; text-align: center; color: #94a3b8; font-size: 12px;">
                            &copy; {{ date('Y') }} {{ env('APP_NAME') }}, All Rights Reserved.
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>

</html>
