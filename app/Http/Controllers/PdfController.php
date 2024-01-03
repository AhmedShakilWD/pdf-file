<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;


class PdfController extends Controller
{
    
    
    public function pdfGenerate(Request $request){
        // dd($request);
            // header('content-type:image/jpeg');
            $font=public_path('font/CALIST.TTF');
            $font_2=public_path('font/TIMES.TTF');
            $image=imagecreatefromjpeg(public_path('images/innovativeskills.jpeg'));
            $color=imagecolorallocate($image,19,21,22);
            $name=$request->input('name');
            $ins_name=$request->input('course');
            // Get the image dimensions
            $imageWidth = imagesx($image);
            $imageWidth_2 = imagesx($image)/2;
            $imageWidth_3 = imagesx($image)/9;
            $imageHeight = imagesy($image);

            // Set the font size
            $fontSize = 75;
            $fontSize_2 = 30;

            // Get the text size and bounding box
            $textInfo = imagettfbbox($fontSize, 0, $font, $name);
            $textInfo_2 = imagettfbbox($fontSize_2, 0, $font_2, $ins_name);
            $textWidth = $textInfo[2] - $textInfo[0];
            $textWidth_2 = $textInfo_2[2] - $textInfo_2[0];
            $textHeight = $textInfo[1] - $textInfo[7];

            // Calculate the center position
            $centerX = ($imageWidth - $textWidth) / 2;
            $centerXX = (($imageWidth_3*3) - $textWidth_2)/2 + $imageWidth_2;
            $centerY = ($imageHeight - $textHeight) / 2 + $fontSize;
           
            
            $file=time();
            $file_path=storage_path('app/public/certificate/').$name.".jpg";

            imagettftext($image,75,0,$centerX,490,$color,$font,$name);
            imagettftext($image,30,0,$centerXX,700,$color,$font_2,$ins_name);
            imagejpeg($image,$file_path);
            imagedestroy($image);
            $data=[
                'image'=>$file_path,
                'title'=>$name,
            ];
            
        // $pdf =App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Certificate</h1>');
        $customPaper = array();
        $pdf = Pdf::loadView('index', $data)->setPaper("a4","landscape");
        
        return $pdf->stream('certificate'.time().'.pdf');
    }
}

   