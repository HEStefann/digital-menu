<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function generateQR($imageUrl, $menuUrl)
    {
        $qrCode = QrCode::format('png')->size(300)->generate("http://next-menu.eu-1.sharedwithexpose.com" . $menuUrl);
        if ($imageUrl != '') {
            $qrCode = QrCode::errorCorrection('H')->format('png')->size(300)->merge($imageUrl, .3, true)->generate("http://next-menu.eu-1.sharedwithexpose.com" . $menuUrl);
        }

        return $qrCode;
    }
}
