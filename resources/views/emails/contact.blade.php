<x-mail::message>

# New Contact Form Submission

**Name:** {{ $data['name'] }}<br>
**Email:** {{ $data['email'] }}<br>

**Message:**<br>
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
