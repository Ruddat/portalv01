<?php

namespace App\Livewire\Backend\Admin\Blog;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ModAdminBlogPost;
use App\Models\ModAdminBlogCategory;
use App\Models\ModAdminBlogTag;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BlogComponent extends Component
{
    use WithFileUploads;

    public $title;
    public $image;
    public $category_id;
    public $tags = [];
    public $start_date;
    public $categories;
    public $newCategoryName;
    public $newTagName;
    public $allTags;
    public $content = '';


    public function mount()
    {
        $this->categories = ModAdminBlogCategory::all();
        $this->allTags = ModAdminBlogTag::all();
        $this->start_date = Carbon::now()->toDateString();
    }

    private function processImage($image)
    {
        $imagePaths = [];
        $sizes = [
            'original' => [null, null],
            'large' => [980, 464],
            'medium' => [800, 533],
            'thumbnail' => [120, 80],
            'custom' => [320, 213] // Example with rounded integer dimensions
        ];

        foreach ($sizes as $size => $dimensions) {
            $img = Image::make($image->getRealPath());

            if ($dimensions[0] && $dimensions[1]) {
                // Resize to the larger dimension while maintaining aspect ratio
                $img->resize($dimensions[0], null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                // Resize again to ensure it fits both dimensions
                if ($img->height() < $dimensions[1]) {
                    $img->resize(null, $dimensions[1], function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // Calculate cropping coordinates to center the image
                $x = round(($img->width() - $dimensions[0]) / 2);
                $y = round(($img->height() - $dimensions[1]) / 2);

                // Ensure the dimensions are integers for the crop method
                $cropWidth = round($dimensions[0]);
                $cropHeight = round($dimensions[1]);

                // Crop the image to the exact dimensions
                $img->crop($cropWidth, $cropHeight, $x, $y);
            }

            $filename = $size . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/' . $filename;
            $fullPath = storage_path('app/public/' . $path);

            $img->save($fullPath);

            $imagePaths[$size] = 'storage/' . $path;
        }

        return $imagePaths;
    }




    public function savePost()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|max:1024', // 1MB Max
            'category_id' => 'required',
            'tags' => 'required|array',
            'start_date' => 'required|date'
        ]);

        $imagePaths = $this->processImage($this->image);

        $post = ModAdminBlogPost::create([
            'title' => $this->title,
            'content' => $this->content,
            'image_original' => $imagePaths['original'],
            'image_large' => $imagePaths['large'],
            'image_medium' => $imagePaths['medium'],
            'image_thumbnail' => $imagePaths['thumbnail'],
            'category_id' => $this->category_id,
            'start_date' => $this->start_date,
            'user_id' => Auth::guard('admin')->id(),
        ]);

        $post->tags()->attach($this->tags);

        session()->flash('message', 'Post successfully created.');
        $this->resetForm();
    }

    public function saveCategory()
    {
        $this->validate([
            'newCategoryName' => 'required',
        ]);

        ModAdminBlogCategory::create([
            'name' => $this->newCategoryName,
        ]);

        $this->categories = ModAdminBlogCategory::all();
        $this->newCategoryName = '';

        session()->flash('message', 'Category successfully created.');
    }

    public function saveTag()
    {
        $this->validate([
            'newTagName' => 'required',
        ]);

        ModAdminBlogTag::create([
            'name' => $this->newTagName,
        ]);

        $this->allTags = ModAdminBlogTag::all();
        $this->newTagName = '';

        session()->flash('message', 'Tag successfully created.');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->category_id = '';
        $this->tags = [];
        $this->start_date = Carbon::now()->toDateString();
    }

    public function render()
    {
        $latestPosts = ModAdminBlogPost::latest()->take(5)->get();

        return view('livewire.backend.admin.blog.blog-component', [
            'latestPosts' => $latestPosts,
            'tagsAll' => $this->allTags,
        ]);
    }
}
