@foreach(Auth::user()->orders as $order)
    <div class="mb-4 border p-4">
        <strong>Bestelling #{{ $order->id }}</strong>
        <ul>
            @foreach($order->coffees as $coffee)
                <li>{{ $coffee->name }} (x{{ $coffee->pivot->quantity }}) - €{{ number_format($coffee->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
@endforeach
