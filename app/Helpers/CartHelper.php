<?php

if (!function_exists('getCartCount')) {
    function getCartCount()
    {
        $cart = session('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'] ?? 1;
        }
        return $count;
    }
}

if (!function_exists('getCartTotal')) {
    function getCartTotal()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }
        return $total;
    }
}

if (!function_exists('getCartSubtotal')) {
    function getCartSubtotal()
    {
        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }
        return $subtotal;
    }
}
