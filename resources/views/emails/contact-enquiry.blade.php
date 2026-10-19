@php
    $rows = array_filter([
        'Name' => $submission->name,
        'Email' => $submission->email,
        'Company' => $submission->company,
        'Phone' => $submission->phone,
        'Service' => $submission->service ? __("site.services.items.{$submission->service}.title", [], 'en') : null,
        'Budget' => $submission->budget ? __("site.contact.budgets.{$submission->budget}", [], 'en') : null,
        'Language' => strtoupper($submission->locale),
    ]);
@endphp

<x-mail.shell title="New enquiry" :preheader="$submission->name.' — '.\Illuminate\Support\Str::limit($submission->message, 90)">

    <h1 style="margin:0 0 8px;color:#ffffff;font-size:22px;font-weight:700;">New enquiry</h1>
    <p style="margin:0 0 28px;color:#b0b8d4;font-size:15px;line-height:1.6;">
        Submitted {{ $submission->created_at->format('d M Y, H:i') }} CET from the {{ strtoupper($submission->locale) }} site.
    </p>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
        @foreach ($rows as $label => $value)
            <tr>
                <td style="padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.08);color:#63709c;font-size:13px;width:110px;vertical-align:top;">
                    {{ $label }}
                </td>
                <td style="padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.08);color:#ffffff;font-size:14px;">
                    @if ($label === 'Email')
                        <a href="mailto:{{ $value }}" style="color:#5d8cff;text-decoration:none;">{{ $value }}</a>
                    @elseif ($label === 'Phone')
                        <a href="tel:{{ $value }}" style="color:#5d8cff;text-decoration:none;">{{ $value }}</a>
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <p style="margin:28px 0 10px;color:#63709c;font-size:13px;">Message</p>
    <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:12px;padding:18px;color:#eceef6;font-size:15px;line-height:1.7;white-space:pre-wrap;">{{ $submission->message }}</div>

    <table role="presentation" cellpadding="0" cellspacing="0" style="margin-top:28px;">
        <tr>
            <td style="background:#ffffff;border-radius:999px;">
                <a href="mailto:{{ $submission->email }}?subject=Re: your enquiry to Leadabox"
                   style="display:inline-block;padding:13px 26px;color:#0b0e1f;font-size:15px;font-weight:600;text-decoration:none;">
                    Reply to {{ \Illuminate\Support\Str::before($submission->name, ' ') }}
                </a>
            </td>
        </tr>
    </table>

</x-mail.shell>
