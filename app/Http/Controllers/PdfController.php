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
            $font=public_path('font/BRUSHSCI.TTF');
            $font_2=public_path('font/AGENCYR.TTF');
            $image=imagecreatefromjpeg(public_path('images/innovativeskills.jpeg'));
            $color=imagecolorallocate($image,19,21,22);
            $name=$request->input('name');
            $ins_name=$request->input('course');
            $file=time();
            $file_path=storage_path('app/public/certificate/').$name.".jpg";
            imagettftext($image,75,0,390,490,$color,$font,$name);
            imagettftext($image,30,0,725,700,$color,$font_2,$ins_name);
            imagejpeg($image,$file_path);
            imagedestroy($image);
            $data=[
                'image'=>$file_path,
                'title'=>$name,
            ];
            
        // $pdf =App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Certificate</h1>');
        $customPaper = array();
        $pdf = Pdf::loadView('index', $data)->setPaper("a4","portrait");
        
        return $pdf->download('certificate'.time().'.pdf');
    }
}

   