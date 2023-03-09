<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RedirectController extends Controller
{
    public function redirectToFrontOffice(Request $request)
    {
        $user = $request->user();
        $email = $user->email;
        $name = $user->name;
        $url = 'http://localhost:5173/?email=' . urlencode($email) . '&name=' . urlencode($name);
        return redirect($url);
    }
}
