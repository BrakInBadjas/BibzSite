@foreach ($adtjes as $adtje)
    <p>Voor: {{ $adtje->user->name }}</p>
    <p>Door: {{ $adtje->creator->name }}</p>
    <p>Reden: {{ $adtje->reason }}</p>
@endforeach
