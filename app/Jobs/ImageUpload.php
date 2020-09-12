<?php

namespace App\Jobs;

use App\Http\Resources\API\Ad\AdResource;
use App\Models\Ad;
use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePaths;
    protected $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $imagePaths, Ad $model)
    {
        $this->imagePaths = $imagePaths;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $imageIds = [];

            foreach ($this->imagePaths as $imagePath) {
                $sha256 = hash_file('sha256', $imagePath);
                $image = Image::where('sha256', $sha256)->first();

                if (!$image) {
                    $image = Image::create([
                        'sha256' => $sha256,
                    ]);

                    Storage::disk('image_src')->putFileAs('/', $imagePath, $sha256);
                }

                $imageIds[] = $image->id;
            }

            $this->model->images()->sync($imageIds);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
