<?php

namespace App\Jobs;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
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
    private $_video;
    private $_duration;
    private $_savePath;

    public function __construct($video, $duration, $savePath)
    {
        $this->_video       = $video;
        $this->_duration    = $duration;
        $this->_savePath    = $savePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($this->_video);
        $frame = $video->frame(TimeCode::fromSeconds($this->_duration));
        $frame->save($this->_savePath);
    }
}
