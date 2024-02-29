<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function convertToHls()
    {

       $lowBitrate = (new X264)->setKiloBitrate(250);


       // Start the conversion process
       FFMpeg::fromDisk('videos')
       ->open('demo1.mp4')
       ->exportForHLS()

        ->addFormat($lowBitrate)

       ->toDisk('public')
       ->save('streamVideo/demo1.m3u8');

       return "Video đã được chuyển đổi sang định dạng HLS thành công";

    }

}
