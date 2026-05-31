<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Array</title>
</head>
<body>
    <h1>Shopping Cart (Session Array)</h1>

    @if(isset($message))
        <p>{{ $message }}</p>
    @endif

    <h2>Items in Cart</h2>
    @if($items && count($items) > 0)
        <ul>
            @foreach($items as $index => $item)
                <li>{{ $index + 1 }}. {{ $item }}</li>
            @endforeach
        </ul>
        <p>Total Items: {{ count($items) }}</p>
    @else
        <p>Your shopping cart is empty. <a href="/session/form">Add items</a></p>
    @endif

    <h2>Working with Session Arrays</h2>
    <ul>
        <li>session(['cart' => $items]) - Store array in session</li>
        <li>$items = session('cart', []) - Get array with default</li>
        <li>$items[] = 'new_item' - Add item to array</li>
        <li>session(['cart' => $items]) - Update session array</li>
    </ul>

    <a href="/session/form">Store More Data</a> | 
    <a href="/session">Back to Session Home</a>
</body>
</html>
