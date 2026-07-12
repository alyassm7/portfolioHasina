<p>Bonjour {{ $message->name }},</p>

<p>{!! nl2br(e($data['body'])) !!}</p>

<hr>
<p style="color:#64748b;font-size:0.9em;">
    <strong>Votre message :</strong><br>
    {{ $message->created_at->format('d/m/Y à H:i') }} — {{ $message->subject }}<br>
    {!! nl2br(e($message->body)) !!}
</p>
