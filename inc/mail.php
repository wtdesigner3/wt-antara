<?php
/**
 * Antara Globale - Email Notification Service
 * Uses Authenticated SMTP via Hostinger Mail
 */

require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Mail Configuration
defined('SMTP_HOST') || define('SMTP_HOST', 'smtp.hostinger.com');
defined('SMTP_PORT') || define('SMTP_PORT', 465);
defined('SMTP_SECURE') || define('SMTP_SECURE', 'ssl');
defined('SMTP_USER') || define('SMTP_USER', 'Taran@antaraglobale.com');
defined('SMTP_PASS') || define('SMTP_PASS', 'Nc9ORA=c@!');
defined('SMTP_FROM_NAME') || define('SMTP_FROM_NAME', 'Antara Globale Trade Desk');
defined('MAIL_NOTIFICATION_TO') || define('MAIL_NOTIFICATION_TO', 'Taran@antaraglobale.com');
defined('MAIL_NOTIFICATION_CC') || define('MAIL_NOTIFICATION_CC', 'wtdesigner3@gmail.com');

/**
 * Send B2B Enquiry Alert Email
 * 
 * @param array $data Enquiry details
 * @return array ['success' => bool, 'message' => string]
 */
function send_enquiry_notification($data) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Server Settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = (SMTP_SECURE === 'tls') ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = SMTP_PORT;
        $mail->CharSet    = 'UTF-8';
        $mail->Timeout    = 12;

        // Sender & Recipients (Primary TO + CC)
        $mail->setFrom(SMTP_USER, SMTP_FROM_NAME);
        $mail->addAddress(MAIL_NOTIFICATION_TO, 'Antara Trade Desk');
        if (defined('MAIL_NOTIFICATION_CC') && !empty(MAIL_NOTIFICATION_CC)) {
            $mail->addCC(MAIL_NOTIFICATION_CC, 'WT Designer');
        }

        // Set Reply-To as Customer's Email
        if (!empty($data['email'])) {
            $mail->addReplyTo($data['email'], $data['full_name'] ?? 'Inquiry Sender');
        }

        // Email Subject
        $division_label = (isset($data['division']) && $data['division'] === 'horeca') ? 'HORECA / Restaurant Supply' : 'Bulk Agro Export';
        $product_label = !empty($data['product_interest']) ? $data['product_interest'] : 'General Commodity Sourcing';
        $mail->Subject = "New Inquiry: {$product_label} [{$division_label}] - {$data['full_name']}";

        // Clean values for HTML
        $name    = htmlspecialchars($data['full_name'] ?? 'N/A');
        $company = htmlspecialchars(!empty($data['company_name']) ? $data['company_name'] : 'Not Specified');
        $email   = htmlspecialchars($data['email'] ?? 'N/A');
        $phone   = htmlspecialchars($data['phone'] ?? 'N/A');
        $country = htmlspecialchars(!empty($data['country']) ? $data['country'] : 'International / CIF');
        $div     = htmlspecialchars($division_label);
        $prod    = htmlspecialchars($product_label);
        $volume  = htmlspecialchars(!empty($data['volume']) ? $data['volume'] : 'Not Specified');
        $msg     = nl2br(htmlspecialchars($data['message'] ?? 'None'));
        $date    = date('d M Y, h:i A (T)');
        $ip      = htmlspecialchars($data['ip'] ?? $_SERVER['REMOTE_ADDR'] ?? 'N/A');

        // Professional HTML Template with Antara Branding
        $htmlBody = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Trade Inquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f4f6f5; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 640px; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e5e7eb;" cellspacing="0" cellpadding="0">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #091C14 0%, #123023 100%); padding: 32px 30px; text-align: left; border-bottom: 3px solid #C5A059;">
                            <div style="font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: 1px; text-transform: uppercase;">
                                Antara Globale
                            </div>
                            <div style="font-size: 13px; color: #C5A059; margin-top: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                Commercial Trade Desk Notification
                            </div>
                        </td>
                    </tr>

                    <!-- Alert Badge -->
                    <tr>
                        <td style="padding: 24px 30px 10px 30px;">
                            <div style="background-color: #ecfdf5; border-left: 4px solid #10b981; padding: 12px 16px; border-radius: 4px;">
                                <span style="color: #065f46; font-size: 14px; font-weight: 600;">
                                    A new buyer inquiry has been received via the website.
                                </span>
                            </div>
                        </td>
                    </tr>

                    <!-- Lead Details Table -->
                    <tr>
                        <td style="padding: 15px 30px 25px 30px;">
                            <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; font-size: 14px;">
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600; width: 38%;">Contact Person:</td>
                                    <td style="padding: 10px 0; color: #0f172a; font-weight: 700;">{$name}</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Company / Firm:</td>
                                    <td style="padding: 10px 0; color: #0f172a;">{$company}</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Work Email:</td>
                                    <td style="padding: 10px 0;"><a href="mailto:{$email}" style="color: #1b4d3e; font-weight: 600; text-decoration: none;">{$email}</a></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Phone / WhatsApp:</td>
                                    <td style="padding: 10px 0; color: #0f172a; font-weight: 600;">{$phone}</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Trade Division:</td>
                                    <td style="padding: 10px 0; color: #0f172a;"><span style="background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">{$div}</span></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Product of Interest:</td>
                                    <td style="padding: 10px 0; color: #b45309; font-weight: 700;">{$prod}</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Required Volume:</td>
                                    <td style="padding: 10px 0; color: #0f172a;">{$volume}</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 10px 0; color: #64748b; font-weight: 600;">Destination Country / Port:</td>
                                    <td style="padding: 10px 0; color: #0f172a;">{$country}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0 6px 0; color: #64748b; font-weight: 600; vertical-align: top;">Requirements / Message:</td>
                                    <td style="padding: 12px 0 6px 0; color: #334155; line-height: 1.6; background-color: #f8fafc; padding: 12px; border-radius: 6px;">{$msg}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Action Button -->
                    <tr>
                        <td align="center" style="padding: 10px 30px 25px 30px;">
                            <a href="mailto:{$email}?subject=RE:%20Antara%20Globale%20Trade%20Inquiry%20-%20{$prod}" style="display: inline-block; background-color: #1B4D3E; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 6px; font-weight: 600; font-size: 14px;">
                                Reply to Customer Directly
                            </a>
                        </td>
                    </tr>

                    <!-- Footer Meta -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 16px 30px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #94a3b8; text-align: center;">
                            Date Submitted: {$date} | Origin IP: {$ip}<br>
                            This notification was generated automatically by the Antara Globale Inquiry Gateway.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;

        $mail->isHTML(true);
        $mail->Body    = $htmlBody;
        $mail->AltBody = "New Lead from {$name} ({$company})\nEmail: {$email}\nPhone: {$phone}\nProduct: {$prod}\nVolume: {$volume}\nCountry: {$country}\nMessage:\n{$data['message']}\n";

        $mail->send();
        return ['success' => true, 'message' => 'Email notification sent successfully.'];

    } catch (Exception $e) {
        error_log("Antara Globale Mailer Error: " . $mail->ErrorInfo);
        return ['success' => false, 'message' => $mail->ErrorInfo];
    }
}

