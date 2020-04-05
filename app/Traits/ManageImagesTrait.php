<?php
namespace Kouloughli\Traits;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

trait ManageImagesTrait
{
    public function uploadImage(UploadedFile $uploadedFile, $folder = null, $disk = 'public')
    {
        $filename =  Carbon::today()->format('m_Y') . '_' . time() . '.' .$uploadedFile->clientExtension();

        Storage::disk($disk)->putFileAs('/' . $folder,$uploadedFile,$filename);

        return $filename;
    }

    public function moveImage($oldPath,$fileName,$folder = null, $disk = 'public')
    {
        Storage::disk($disk)->move($oldPath, '/' . $folder.'/'.$fileName );
        return $fileName;
    }



    public function uploadImageTmp(UploadedFile $uploadedFile, $folder = null, $disk = 'public')
    {
        $filename =  Carbon::today()->format('m_Y') . '_' . time() . '.' .$uploadedFile->clientExtension();

        Storage::disk($disk)->putFileAs('/' . $folder,$uploadedFile,$filename);

        return $filename;
    }

    public function convertImageToPdf($file, $folder = null, $disk = 'public',$tempDisk = 'tempImages',$tempFileName)
    {

        $image = new \Imagick($file);

        $image->setImageFormat('pdf');

        $fileName =  Carbon::today()->format('m_Y') . '_' . time() . '.pdf';

        $path = Storage::disk($disk)->path('/' . $folder . '/' );

        $image->writeImage($path . $fileName);
        
        return $fileName;
    }


    public function convertMultipleImagesToPdf($images)
    {
        // TODO: implement Multiple Images in single PDF File
        /*
            $images = array("file1.jpg", "file2.jpg");

            $pdf = new Imagick($images);
            $pdf->setImageFormat('pdf');
            $pdf->writeImages('combined.pdf', true); 
         */
    }

}