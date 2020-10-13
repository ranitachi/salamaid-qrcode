<?php

namespace App\Http\Controllers;
use App\Models\KontenWeb;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Endroid\QrCode\LabelAlignment;
use App\Http\Controllers\Controller;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Response\QrCodeResponse;

class HomeController extends Controller
{

    public function index(Request $request){
        $konten = KontenWeb::orderBy('created_at','desc')->paginate(10);
        $page = isset($request->page) ? $request->page : 1;
        return view('konten.index',compact('konten','page'));
    }
    public function qr_code()
    {
        $url = 'http://salamaid.id/qr-code.php';
        return view('qr-code',compact('url'));
    }

    public function qr_code_img(){
        // Include the QRCode generator library
        $qrCode = new QrCode('http://salamaid.id/qr-code.php');
        $qrCode->setSize(600);
        $qrCode->setMargin(10); 

        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLogoPath(asset('jsan-salamaid.png'));
        $qrCode->setLogoSize(280, 110);
        $qrCode->setValidateResult(false);

        // Round block sizes to improve readability and make the blocks sharper in pixel based outputs (like png).
        // There are three approaches:
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_MARGIN); // The size of the qr code is shrinked, if necessary, but the size of the final image remains unchanged due to additional margin being added (default)
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_ENLARGE); // The size of the qr code and the final image is enlarged, if necessary
        $qrCode->setRoundBlockSize(true, QrCode::ROUND_BLOCK_SIZE_MODE_SHRINK); // The size of the qr code and the final image is shrinked, if necessary

        // Set additional writer options (SvgWriter example)
        $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

        // Directly output the QR code
        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();

        // Save it to a file
        $qrCode->writeFile(__DIR__.'/qrcode.png');

        // Generate a data URI to include image data inline (i.e. inside an <img> tag)
        $qrCode->writeDataUri();

        // Send output of the QRCode directly
        header('Content-Type: '.$qrCode->getContentType());
        $qrCode->render();
    }

    public function show_image($dir,$filename)
    {
        $path = $dir.'/'.$filename;
        return response()->file(storage_path('app').'/'.$path);
    }

    public function info()
    {
        $konten = KontenWeb::where('status',1)->orderBy('created_at','desc')->first();
        return view('info',compact('konten'));
    }
}
