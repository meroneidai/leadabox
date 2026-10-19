@props(['title' => '', 'preheader' => ''])

@php
    $stack = \App\Support\Locales::isRtl()
        ? "Tajawal,'Segoe UI',Arial,sans-serif"
        : "-apple-system,BlinkMacSystemFont,'Segoe UI',Inter,Helvetica,Arial,sans-serif";
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ \App\Support\Locales::dir() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <title>{{ $title }}</title>
</head>
<body style="margin:0;padding:0;background:#0b0e1f;font-family:{{ $stack }};">

    @if ($preheader)
        <div style="display:none;max-height:0;overflow:hidden;opacity:0;">{{ $preheader }}</div>
    @endif

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#0b0e1f;padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;">

                    <tr>
                        <td style="padding-bottom:24px;" align="{{ \App\Support\Locales::isRtl() ? 'right' : 'left' }}">
                            <a href="{{ config('app.url') }}" style="text-decoration:none;color:#ffffff;font-size:20px;font-weight:700;">
                                Leadabox
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#171b33;border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:36px 32px;">
                            {{ $slot }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:24px;color:#63709c;font-size:13px;line-height:1.7;" align="{{ \App\Support\Locales::isRtl() ? 'right' : 'left' }}">
                            <strong style="color:#8390b8;">{{ config('site.company.name') }}</strong><br>
                            {{ config('site.company.street') }}, {{ config('site.company.postal_code') }} {{ config('site.company.city') }}, {{ config('site.company.country_name') }}<br>
                            <a href="mailto:{{ config('site.company.email') }}" style="color:#5d8cff;text-decoration:none;">{{ config('site.company.email') }}</a>
                            &nbsp;&middot;&nbsp;
                            <a href="tel:{{ config('site.company.phone') }}" style="color:#5d8cff;text-decoration:none;">{{ config('site.company.phone_display') }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
