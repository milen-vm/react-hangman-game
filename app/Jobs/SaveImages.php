<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SaveImages implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const DS = DIRECTORY_SEPARATOR;

    private $urls = [];
    private $baseName = '';
    private $start = 0;
    private $zeros = 4;
    private $baseFile = '';

    /**
     * Create a new job instance.
     */
    public function __construct(array $urls, string $baseName, int $start, int $zeros, string $galliesPath)
    {
        $this->urls = $urls;
        $this->baseName = $baseName;
        $this->start = $start;
        $this->zeros = $zeros;
        $this->setBaseFile($galliesPath);
    }

    private function setBaseFile(string $galleiesPath): void
    {
        $this->baseFile = $galleiesPath . self::DS . $this->baseName . self::DS . $this->baseName . '_';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $num = $this->start;

        foreach($this->urls as $url) {
            if ($this->sotreImage($url, $num)) {
                ++$num;
            }
        }
    }

    private function sotreImage(string $imgUrl, int $num): bool
    {
        try {
            $image = file_get_contents($imgUrl);
        } catch (\Exception $e) {

            return false;
        }

        $ext = '.' . pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
        $path = $this->baseFile . sprintf("%0{$this->zeros}d", $num);

        if (Storage::disk('local')->exists($path . $ext)) {
            $path = $path . uniqid();
        }

        if ($image) {
            Storage::disk('local')->put($path . $ext, $image);

            return true;
        }

        return false;
    }
}
