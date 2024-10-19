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

    public $confirmingPostId;
    public $showDeleteOverlay = false;
    public $postTitle;

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
            'custom' => [320, 213]
        ];

        foreach ($sizes as $size => $dimensions) {
            $img = Image::make($image->getRealPath());

            if ($dimensions[0] && $dimensions[1]) {
                $img->resize($dimensions[0], null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                if ($img->height() < $dimensions[1]) {
                    $img->resize(null, $dimensions[1], function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                $x = round(($img->width() - $dimensions[0]) / 2);
                $y = round(($img->height() - $dimensions[1]) / 2);
                $cropWidth = round($dimensions[0]);
                $cropHeight = round($dimensions[1]);
                $img->crop($cropWidth, $cropHeight, $x, $y);
            }

            $filename = $size . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/' . $filename;

            // Ensure the directory exists
            Storage::disk('public')->makeDirectory('images');

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
            'image' => 'image|max:2048', // 2MB Max
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
            'newCategoryName' => 'required|unique:mod_admin_blog_categories,name',
        ]);

        ModAdminBlogCategory::create([
            'name' => $this->newCategoryName,
        ]);

        $this->categories = ModAdminBlogCategory::all();
        $this->newCategoryName = '';

        session()->flash('message', 'Category successfully created.');

        // Seite neu laden
        return redirect()->route('admin.blog-all');
    }

    public function saveTag()
    {
        $this->validate([
            'newTagName' => 'required|unique:mod_admin_blog_tags,name',
        ]);

        ModAdminBlogTag::create([
            'name' => $this->newTagName,
        ]);

        $this->allTags = ModAdminBlogTag::all();
        $this->newTagName = '';

        session()->flash('message', 'Tag successfully created.');

        // Seite neu laden
        return redirect()->route('admin.blog-all');
    }

    public function confirmDelete($id)
    {
        $post = ModAdminBlogPost::find($id);
        if ($post) {
            $this->confirmingPostId = $id;
            $this->postTitle = $post->title;
            $this->showDeleteOverlay = true;
        }
    }

    public function deletePost()
    {
        $post = ModAdminBlogPost::find($this->confirmingPostId);
        if ($post) {
            // Lösche die Bilddateien
            $imagePaths = [
                str_replace('storage/', '', $post->image_original),
                str_replace('storage/', '', $post->image_large),
                str_replace('storage/', '', $post->image_medium),
                str_replace('storage/', '', $post->image_thumbnail)
            ];

            foreach ($imagePaths as $path) {
                \Log::info("Checking path: " . $path);

                if (Storage::disk('public')->exists($path)) {
                    \Log::info("Deleting path: " . $path);
                    Storage::disk('public')->delete($path);
                } else {
                    \Log::info("Path does not exist: " . $path);
                }
            }

            // Entferne die Verknüpfungen zu den Tags und lösche den Beitrag
            $post->tags()->detach();
            $post->delete();

            session()->flash('message', 'Post successfully deleted.');
        }
        $this->confirmingPostId = null;
        $this->postTitle = '';
        $this->showDeleteOverlay = false;
        $this->render();  // Aktualisiere die Komponente
    }



    public function resetForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->category_id = '';
        $this->tags = [];
        $this->start_date = Carbon::now()->toDateString();

        // Trigger JS-Ereignis
        $this->dispatch('resetForm');
    }

    public function render()
    {
        $latestPosts = ModAdminBlogPost::latest()->take(5)->get();

        return view('livewire.backend.admin.blog.blog-component', [
            'latestPosts' => $latestPosts,
            'tagsAll' => $this->allTags,
        ]);
    }

    public function uploadImage($base64Image)
{
    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
    $fileName = 'blog-images/' . uniqid() . '.png';
    Storage::disk('public')->put($fileName, $imageData);

    $this->emit('blogimageUploaded', [asset('storage/' . $fileName)]);
}

public function deleteImage($imagePath)
{
    $fileName = str_replace(asset('storage/'), '', $imagePath);
    Storage::disk('public')->delete($fileName);
}

}
