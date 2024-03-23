<?php

namespace App\Jobs;

use App\Models\Gallery;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use File;
use Illuminate\Support\Facades\Storage;

class StoreGallery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $name,
        private string $relPath,
        private string $absPath
    ) {}

    /**
     * Execute the job.
     */
    public function handle(Gallery $gallery): void
    {
        if (!Storage::exists($this->relPath)) {

            return;
        }

        $size = 0;
        $files = File::allFiles($this->absPath);
        foreach ($files as $file) {
            $size += $file->getSize();
        }

        $gallery::create([
            'name' => $this->name,
            'rel_path' => $this->relPath,
            'abs_path' => $this->absPath,
            'size' => $size,
            'count' => count($files),
        ]);
    }
}
