@php
    app()->setLocale($locale);
    $align = \App\Support\Locales::isRtl() ? 'right' : 'left';
@endphp

<x-mail.shell :title="__('site.contact.email.subject')" :preheader="__('site.contact.email.preheader')">

    <h1 style="margin:0 0 16px;color:#ffffff;font-size:22px;font-weight:700;text-align:{{ $align }};">
        {{ __('site.contact.email.heading', ['name' => \Illuminate\Support\Str::before($submission->name, ' ')]) }}
    </h1>

    <p style="margin:0 0 18px;color:#b0b8d4;font-size:15px;line-height:1.7;text-align:{{ $align }};">
        {{ __('site.contact.email.intro') }}
    </p>

    <p style="margin:0 0 10px;color:#63709c;font-size:13px;text-align:{{ $align }};">
        {{ __('site.contact.email.your_message') }}
    </p>
    <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:18px;color:#eceef6;font-size:15px;line-height:1.7;white-space:pre-wrap;text-align:{{ $align }};">{{ $submission->message }}</div>

    <p style="margin:24px 0 0;color:#b0b8d4;font-size:15px;line-height:1.7;text-align:{{ $align }};">
        {{ __('site.contact.email.urgent') }}
    </p>

    <table role="presentation" cellpadding="0" cellspacing="0" style="margin-top:24px;">
        <tr>
            <td style="background:#ffffff;border-radius:999px;">
                <a href="https://wa.me/{{ config('site.company.whatsapp') }}"
                   style="display:inline-block;padding:13px 26px;color:#0b0e1f;font-size:15px;font-weight:600;text-decoration:none;">
                    WhatsApp {{ config('site.company.phone_display') }}
                </a>
            </td>
        </tr>
    </table>

    <p style="margin:28px 0 0;color:#8390b8;font-size:15px;line-height:1.7;text-align:{{ $align }};">
        {{ __('site.contact.email.signoff') }}<br>
        <strong style="color:#ffffff;">{{ __('site.contact.email.team') }}</strong>
    </p>

</x-mail.shell>
