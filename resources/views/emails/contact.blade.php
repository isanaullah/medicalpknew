<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .email-header {
            background: linear-gradient(135deg, #2563EB, #4338CA);
            padding: 30px 40px;
            text-align: center;
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .email-header p {
            color: rgba(255,255,255,0.8);
            margin: 5px 0 0;
            font-size: 14px;
        }
        .email-body {
            padding: 40px;
        }
        .email-body h2 {
            color: #0F172A;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .message-details {
            background: #F8FAFC;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-item {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #E2E8F0;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #475569;
            width: 100px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #0F172A;
            word-break: break-word;
        }
        .message-box {
            background: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 16px;
            margin-top: 10px;
            line-height: 1.6;
            color: #475569;
        }
        .message-box p {
            margin: 0;
        }
        .email-footer {
            background: #F1F5F9;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #E2E8F0;
        }
        .email-footer p {
            color: #64748B;
            font-size: 13px;
            margin: 5px 0;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: #DBEAFE;
            color: #1D4ED8;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .contact-info {
            margin-top: 20px;
            padding: 15px;
            background: #EFF6FF;
            border-radius: 8px;
            border-left: 4px solid #2563EB;
        }
        .contact-info p {
            margin: 5px 0;
            color: #1D4ED8;
        }
        .contact-info strong {
            color: #0F172A;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>📩 New Contact Message</h1>
            <p>You have received a new message from your website contact form</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Message Details</h2>

            <div class="message-details">
                <div class="detail-item">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value"><strong>{{ $name }}</strong></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><a href="mailto:{{ $email }}">{{ $email }}</a></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Subject:</span>
                    <span class="detail-value"><span class="badge">{{ $subject ?? 'General Inquiry' }}</span></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">IP Address:</span>
                    <span class="detail-value">{{ $ip ?? 'N/A' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Device:</span>
                    <span class="detail-value" style="font-size: 12px; color: #64748B;">{{ $user_agent ?? 'N/A' }}</span>
                </div>
            </div>

            <div style="margin-top: 20px;">
                <h3 style="color: #0F172A; font-size: 16px; margin-bottom: 10px;">Message:</h3>
                <div class="message-box">
                    <p>{{ $messageBody }}</p>
                </div>
            </div>

            <div class="contact-info">
                <p><strong>📞 Quick Actions:</strong></p>
                <p>
                    <a href="mailto:{{ $email }}" style="color: #2563EB; text-decoration: none; font-weight: 600;">
                        Reply to {{ $name }}
                    </a>
                    &nbsp;|&nbsp;
                    <a href="#" style="color: #2563EB; text-decoration: none; font-weight: 600;">
                        View in Dashboard
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>This message was sent from your website contact form.</p>
            <p style="font-size: 12px; color: #94A3B8;">
                Medical.pk Support System
            </p>
        </div>
    </div>
</body>
</html>
