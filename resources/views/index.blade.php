@component('layout', [
    'countries' => $countries,
])

    <ul>
        @foreach($countries as $country)
            <li><a href="{{ route('country', $country->country) }}">{{ $country->country }}</a></li>
        @endforeach
    </ul>
@endcomponent
