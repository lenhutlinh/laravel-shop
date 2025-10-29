<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Yêu cầu hỗ trợ của bạn đã được ghi nhận</title>
</head>
<body>
  <div style="font-family:Arial,Helvetica,sans-serif;color:#222;line-height:1.4">
    <h2>Xin chào {{ $name ?? 'khách hàng' }},</h2>
    <p>Cảm ơn bạn đã liên hệ với VieS. Yêu cầu hỗ trợ của bạn đã được hệ thống ghi nhận với mã: <strong>{{ $ticketId ?? '—' }}</strong>.</p>
    <p>Nhóm chăm sóc khách hàng sẽ phản hồi trong vòng 24 giờ làm việc. Nội dung bạn gửi:</p>
    <blockquote style="background:#f7f7f7;padding:10px;border-left:3px solid #0B3C5D">{{ $message ?? "(không có nội dung)" }}</blockquote>
    <p>Nếu cần hỗ trợ gấp, gọi Hotline: <strong>1900-1234</strong> (8:00–22:00).</p>
    <p>Trân trọng,<br>Đội ngũ VieS</p>
  </div>
</body>
</html>
