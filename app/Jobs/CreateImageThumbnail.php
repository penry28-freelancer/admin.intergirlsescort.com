<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateImageThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $_videoPath;
    private $_getAt;
    private $_fileName;

    public function __construct($videoPath, $getAt, $fileName)
    {
        $this->_videoPath = $videoPath;
        $this->_getAt = $getAt;
        $this->_fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info(121212);
        shell_exec("ffmpeg -i $this->_videoPath -deinterlace -an -ss 1 -t $this->_getAt -r 1 -y -vcodec mjpeg -f mjpeg $this->_fileName 2>&1");
    }
}
