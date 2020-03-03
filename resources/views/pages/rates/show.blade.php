<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Valūtas | {{ $rate->pub_date }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div class="container pt-5">
        <h2>{{ $rate->pub_date }}</h2>
        <a href="{{ route('rates.index') }}" class="btn btn-link">Atpakaļ</a>
        <ul>
            <li>ID: {{ $rate->id }}</li>
            <li>Valūta: {{ $rate->base_currency }}</li>
            <li>Kursi:
                <ul>
                @foreach ($rate->formatted_rates as $frate)
                    <li>
                        {{ $frate[0] }} - {{ $frate[1] }}
                    </li>
                @endforeach
                </ul>
            </li>
            <li>Datums: {{ $rate->pub_date }}</li>
        </ul>
        <h2>Iepriekšējie datumi</h2>
        <table class="table table-responsive">
            <thead>
                <th>ID</th>
                <th>Valūta</th>
                <th>Kursi</th>
                <th>Datums</th>
            </thead>
            <tbody>
                @foreach($previousRates as $rate)
                <tr>
                    <td>{{ $rate->id }}</td>
                    <td>{{ $rate->base_currency }}</td>
                    <td><a href="{{ route('rates.show', ['id' => $rate->id]) }}" class="btn btn-link">Aplūkot</a></td>
                    <td>{{ $rate->pub_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $previousRates->links() }}
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>