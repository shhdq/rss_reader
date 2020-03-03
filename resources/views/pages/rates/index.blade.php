<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Valūtas | Sākums</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div class="container pt-5">
        <h2>Visi datumi</h2>
        <table class="table table-responsive">
            <thead>
                <th>ID</th>
                <th>Valūta</th>
                <th>Kursi</th>
                <th>Datums</th>
            </thead>
            <tbody>
                @foreach($rates as $rate)
                <tr>
                    <td>{{ $rate->id }}</td>
                    <td>EUR</td>
                    <td><a href="{{ route('rates.show', ['id' => $rate->id]) }}" class="btn btn-link">Aplūkot</a></td>
                    <td>{{ $rate->pub_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rates->links() }}
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>