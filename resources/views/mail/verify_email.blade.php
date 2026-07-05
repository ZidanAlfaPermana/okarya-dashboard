<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px;">
<div style="max-width: 500px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; text-align: center;">
    <div style="">

    </div>

    <h2>Verifikasi Email Anda</h2>
    <p>Gunakan kode OTP di bawah ini untuk memverifikasi akun Anda. Kode ini berlaku selama 15 menit.</p>

    <div style="background-color: #f9fafb; border: 2px dashed #d1d5db; padding: 15px; margin: 20px 0; font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #1f2937;">
        {{ $otp }}
    </div>

    <p style="font-size: 12px; color: #6b7280;">Jika Anda tidak mendaftar di aplikasi kami, abaikan email ini.</p>

    <div style="border: #0a0a0a solid 2px"></div>

    <div style="display: flex; align-items: center; justify-content: center; font-size: 12px; color: #6b7280;"></div>
</div>
</body>
</html>
