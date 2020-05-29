Situation pour le {{ $date->format('d/m/Y') }}

Touchés: {{ number_format($confirmed, 0, ',', ' ') }} ({{ $confirmedDelta }})
Morts: {{ number_format($deaths, 0, ',', ' ') }} - ({{ $deathsDelta }})
Rétablies: {{ number_format($recovered, 0, ',', ' ') }} - ({{ $recoveredDelta }})
