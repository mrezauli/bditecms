<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Acknowledgement Slip - {{ $payment->transaction_id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #111; margin: 0; padding: 24px; }
        .header { text-align: center; border-bottom: 2px solid #1d4ed8; padding-bottom: 12px; margin-bottom: 16px; }
        .header h1 { font-size: 20px; margin: 0 0 4px 0; color: #1d4ed8; }
        .header p { margin: 2px 0; font-size: 11px; color: #444; }
        .title { text-align: center; font-size: 15px; font-weight: bold; margin: 14px 0; text-decoration: underline; }
        table.details { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
        table.details th, table.details td { border: 1px solid #999; padding: 6px 8px; text-align: left; vertical-align: top; }
        table.details th { background-color: #f1f5f9; width: 32%; }
        .section { font-size: 13px; font-weight: bold; margin: 14px 0 6px 0; color: #1d4ed8; }
        .status-paid { color: #15803d; font-weight: bold; }
        .footer { margin-top: 24px; border-top: 1px solid #999; padding-top: 8px; font-size: 10px; color: #555; text-align: center; }
        .sign { margin-top: 48px; width: 100%; }
        .sign td { width: 50%; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BDITEC</h1>
        <p>Bangladesh Computer Council, ICT Tower, Agargaon, Dhaka</p>
        <p>Email: info@bditec.gov.bd</p>
    </div>

    <div class="title">Payment Acknowledgement Slip</div>

    <table class="details">
        <tr>
            <th>Acknowledgement No.</th>
            <td>{{ $payment->transaction_id }}</td>
            <th>Date</th>
            <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>
        </tr>
    </table>

    <div class="section">Received From</div>
    <table class="details">
        <tr>
            <th>Name</th>
            <td>{{ $payment->user?->name ?? '—' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $payment->user?->email ?? '—' }}</td>
        </tr>
        <tr>
            <th>Mobile</th>
            <td>@if($payment->user?->profile?->mobile_number)+8801{{ $payment->user->profile->mobile_number }}@else — @endif</td>
        </tr>
    </table>

    <div class="section">Enrollment Details</div>
    <table class="details">
        <tr>
            <th>Enrollment ID</th>
            <td>{{ $payment->enrollment_id }}</td>
        </tr>
        <tr>
            <th>Exam</th>
            <td>{{ $payment->enrollment?->exam?->name ?? '—' }}@if($payment->enrollment?->exam?->acronym) ({{ $payment->enrollment->exam->acronym }})@endif</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>{{ $payment->enrollment?->type?->name ?? '—' }}</td>
        </tr>
        <tr>
            <th>Site</th>
            <td>{{ $payment->enrollment?->site?->name ?? '—' }}</td>
        </tr>
        <tr>
            <th>Intake</th>
            <td>{{ $payment->enrollment?->intake?->name ?? '—' }}</td>
        </tr>
    </table>

    <div class="section">Payment Details</div>
    <table class="details">
        <tr>
            <th>Transaction ID</th>
            <td>{{ $payment->transaction_id }}</td>
        </tr>
        <tr>
            <th>Bank Transaction ID</th>
            <td>{{ $payment->bank_tran_id ?? '—' }}</td>
        </tr>
        <tr>
            <th>Amount Received</th>
            <td>BDT {{ number_format((float) $payment->amount, 2) }} {{ $payment->currency }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td class="status-paid">{{ $payment->status }}</td>
        </tr>
    </table>

    <table class="sign">
        <tr>
            <td>______________________<br>Received By</td>
            <td style="text-align: right;">______________________<br>Authorized Signature</td>
        </tr>
    </table>

    <div class="footer">
        This is a system-generated acknowledgement slip. For queries, contact info@bditec.gov.bd quoting the acknowledgement number.
    </div>
</body>
</html>
