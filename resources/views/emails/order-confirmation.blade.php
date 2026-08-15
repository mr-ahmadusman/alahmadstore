<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Confirmed | Al Ahmad Store</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Google Font — works in clients that support <style> (Apple Mail, iOS, some Android).
           Falls back to system font stack everywhere else (Gmail, Outlook desktop). */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        body { margin: 0; padding: 0; width: 100% !important; height: 100% !important; }

        .font-poppins {
            font-family: 'Poppins', 'Segoe UI', Helvetica, Arial, sans-serif;
        }

        /* Subtle badge pulse — safe progressive enhancement.
           Apple Mail / iOS Mail will animate it, Gmail/Outlook will just show it static. No layout risk either way. */
        @media screen {
            .pulse-badge {
                animation: pulseGlow 2.2s ease-in-out infinite;
            }
        }
        @keyframes pulseGlow {
            0%   { box-shadow: 0 0 0 0 rgba(108,92,231,0.35); }
            70%  { box-shadow: 0 0 0 8px rgba(108,92,231,0); }
            100% { box-shadow: 0 0 0 0 rgba(108,92,231,0); }
        }

        /* Responsive */
        @media only screen and (max-width: 620px) {
            .wrapper { width: 100% !important; padding: 0 !important; }
            .container { width: 100% !important; border-radius: 0 !important; }
            .stack { display: block !important; width: 100% !important; padding-left: 0 !important; padding-right: 0 !important; margin-bottom: 14px !important; }
            .px { padding-left: 18px !important; padding-right: 18px !important; }
            .btn-full { width: 100% !important; text-align: center !important; }
            .prod-thumb { width: 56px !important; }
        }
    </style>
</head>

<body class="font-poppins" style="margin:0; padding:0; background:#f2f1f8;">

    @php
        // Same logic as header.blade.php — dynamic backend logo with fallback.
        // Email can't use asset() (localhost URLs break in Gmail/Outlook), so we
        // resolve the actual file path and embed it directly into the email.
        $logoPath = $logo && $logo->image
            ? public_path($logo->image)
            : public_path('web/img/logo/logo.png');
    @endphp

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f1f8; padding:30px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0" class="container"
                    style="width:600px; background:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 12px 34px rgba(108,92,231,0.14);">

                    {{-- ===== VIP Top Strip ===== --}}
                    <tr>
                        <td style="background:linear-gradient(90deg,#ffd400,#ffc700); padding:9px 30px; font-size:12px; color:#1a1a1a; text-align:center; font-weight:700; letter-spacing:0.3px;">
                            ✨ Free Delivery across Pakistan &nbsp;|&nbsp; Cash on Delivery Available
                        </td>
                    </tr>

                    {{-- ===== Header / Logo ===== --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#6c5ce7,#5a4bd4); padding:26px 30px; text-align:center;">
                            <img src="{{ $message->embed($logoPath) }}"
                                alt="{{ config('app.name', 'Al Ahmad Store') }}" height="40"
                                style="height:40px; max-width:200px; display:inline-block; vertical-align:middle;">
                        </td>
                    </tr>

                    {{-- ===== VIP Order Placed Banner ===== --}}
                    <tr>
                        <td style="padding:0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background:#1a1a1a; padding:26px 30px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="color:#ffffff;">
                                                    <span class="pulse-badge" style="display:inline-block; background:#ffd400; color:#1a1a1a; font-size:10px; font-weight:800; letter-spacing:0.6px; padding:3px 10px; border-radius:20px; margin-bottom:8px;">
                                                        VIP ORDER
                                                    </span>
                                                    <div style="font-size:20px; font-weight:700; margin:6px 0 4px;">Order Placed ✅</div>
                                                    <div style="font-size:13px; color:#bbbbbb;">
                                                        Placed on {{ $order->created_at->format('d M, Y - h:i A') }}
                                                    </div>
                                                </td>
                                                <td align="right" style="color:#ffffff;">
                                                    <div style="font-size:12px; color:#bbbbbb;">Order Number</div>
                                                    <div style="font-size:16px; font-weight:700;">#{{ $order->id }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== Thank You Message ===== --}}
                    <tr>
                        <td class="px" style="padding:32px 30px 10px;">
                            <h2 style="margin:0 0 10px; font-size:22px; color:#1a1a1a;">Thank you for your purchase, {{ $order->name }}! 🎉</h2>
                            <p style="margin:0; font-size:14px; line-height:22px; color:#666666;">
                                We're getting your order ready to be shipped. We'll notify you as soon as it's on the way.
                                You can track this order anytime using the button below.
                            </p>
                        </td>
                    </tr>

                    {{-- ===== View Order Button ===== --}}
                    <tr>
                        <td class="px" style="padding:20px 30px 30px;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="btn-full" style="border-radius:10px; background:linear-gradient(90deg,#ffd400,#ffc700);">
                                        <a href="{{ $viewOrderUrl }}"
                                            style="display:inline-block; padding:14px 34px; font-size:15px; font-weight:700; color:#1a1a1a; text-decoration:none; border-radius:10px;">
                                            View Order &nbsp;→
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== Order Summary ===== --}}
                    <tr>
                        <td class="px" style="padding:0 30px;">
                            <h3 style="font-size:16px; color:#1a1a1a; border-bottom:2px solid #6c5ce7; display:inline-block; padding-bottom:8px; margin-bottom:18px;">
                                Order Summary
                            </h3>
                        </td>
                    </tr>

                    <tr>
                        <td class="px" style="padding:0 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="prod-thumb" style="padding:12px 0; border-bottom:1px solid #f0f0f0; width:70px;">
                                            <img src="{{ $message->embed(public_path(!empty($item->product->image) ? $item->product->image : 'web/img/product/home1-pro-1.jpg')) }}"
                                                width="60" height="60"
                                                style="width:60px; height:60px; border-radius:10px; border:1px solid #eee; object-fit:cover; display:block;"
                                                alt="{{ $item->product_name }}">
                                        </td>
                                        <td style="padding:12px 10px; border-bottom:1px solid #f0f0f0; vertical-align:middle;">
                                            <div style="font-size:14px; font-weight:600; color:#1a1a1a;">{{ $item->product_name }}</div>
                                            <div style="font-size:13px; color:#888888;">Qty: {{ $item->qty }} &nbsp;×&nbsp; Rs {{ number_format($item->price, 2) }}</div>
                                        </td>
                                        <td align="right" style="padding:12px 0; border-bottom:1px solid #f0f0f0; vertical-align:middle;">
                                            <div style="font-size:14px; font-weight:700; color:#1a1a1a;">Rs {{ number_format($item->subtotal, 2) }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    {{-- ===== Totals ===== --}}
                    <tr>
                        <td class="px" style="padding:20px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:6px 0; font-size:14px; color:#666;">Subtotal</td>
                                    <td align="right" style="padding:6px 0; font-size:14px; color:#666;">Rs {{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0; font-size:14px; color:#666;">Shipping</td>
                                    <td align="right" style="padding:6px 0; font-size:14px; color:#27ae60; font-weight:600;">Free</td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 0 0; font-size:17px; font-weight:800; color:#1a1a1a; border-top:2px solid #eee;">Total</td>
                                    <td align="right" style="padding:14px 0 0; font-size:17px; font-weight:800; color:#6c5ce7; border-top:2px solid #eee;">
                                        Rs {{ number_format($order->total_amount, 2) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== Shipping + Payment Info ===== --}}
                    <tr>
                        <td class="px" style="padding:10px 30px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="50%" class="stack" style="vertical-align:top; padding-right:10px;">
                                        <div style="background:#f8f7ff; border-radius:10px; padding:16px;">
                                            <div style="font-size:12px; font-weight:700; color:#6c5ce7; text-transform:uppercase; margin-bottom:8px;">Shipping Address</div>
                                            <div style="font-size:13px; color:#444; line-height:20px;">
                                                {{ $order->name }}<br>
                                                {{ $order->address }}<br>
                                                {{ $order->city }} {{ $order->postal_code }}<br>
                                                Pakistan<br>
                                                {{ $order->phone }}
                                            </div>
                                        </div>
                                    </td>
                                    <td width="50%" class="stack" style="vertical-align:top; padding-left:10px;">
                                        <div style="background:#fff9e6; border-radius:10px; padding:16px;">
                                            <div style="font-size:12px; font-weight:700; color:#c99a00; text-transform:uppercase; margin-bottom:8px;">Payment Method</div>
                                            <div style="font-size:13px; color:#444; line-height:20px;">
                                                Cash on Delivery (COD)<br>
                                                Status:
                                                <span style="display:inline-block; background:#ffefc2; color:#8a6d00; font-weight:700; padding:2px 8px; border-radius:20px; font-size:11px;">
                                                    Unpaid
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ===== Footer ===== --}}
                    <tr>
                        <td style="background:#1a1a1a; padding:28px 30px; text-align:center;">
                            <img src="{{ $message->embed($logoPath) }}"
                                alt="{{ config('app.name', 'Al Ahmad Store') }}" height="26"
                                style="height:26px; margin-bottom:12px; opacity:0.95;">
                            <div style="color:#ffffff; font-size:14px; font-weight:700; margin-bottom:6px;">AL AHMAD STORE</div>
                            <div style="color:#999999; font-size:12px; line-height:20px;">
                                Any questions about your order? Reply to this email or contact us at
                                <a href="mailto:support@alahmadstore.com" style="color:#ffd400; text-decoration:none;">support@alahmadstore.com</a>
                            </div>
                            <div style="margin-top:14px; color:#666666; font-size:11px;">
                                &copy; {{ date('Y') }} Al Ahmad Store. All rights reserved.
                            </div>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
