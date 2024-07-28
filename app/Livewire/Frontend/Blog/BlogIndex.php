<?php

namespace App\Livewire\Frontend\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModAdminBlogTag;
use App\Models\ModAdminBlogPost;
use Livewire\WithoutUrlPagination;
use App\Models\ModAdminBlogCategory;

class BlogIndex extends Component
{
    use WithPagination, WithoutUrlPagination; // Add WithoutUrlPagination trait;

    public $category = 'all';
    public $categories;
    public $search;
    public $allTags;
    public $latestPosts;
    public $selectedTags = [];

    public function mount()
    {
        $this->categories = ModAdminBlogCategory::withCount(['posts' => function ($query) {
            $query->where('start_date', '<=', now());
        }])->get();

        $this->allTags = ModAdminBlogTag::all();

        $this->latestPosts = ModAdminBlogPost::with('category')
            ->where('start_date', '<=', now())
            ->latest()
            ->take(3)
            ->get();
    }

    public function setCategory($categoryId)
    {
        $this->category = $categoryId;
    }

    public function toggleTag($tagId)
    {
        if (in_array($tagId, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tagId]);
        } else {
            $this->selectedTags[] = $tagId;
        }
    }

    public function updatedSearch($value)
    {
        $this->search = $value;
    }


    public function render()
    {
        $this->categories = ModAdminBlogCategory::withCount(['posts' => function ($query) {
            $query->where('start_date', '<=', now());
        }])->get();

        $this->allTags = ModAdminBlogTag::all();

        $query = ModAdminBlogPost::with('author', 'category')
            ->where('start_date', '<=', now());

        if ($this->category !== 'all') {
            $query->where('category_id', $this->category);
        }

        if ($this->selectedTags) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('tag_id', $this->selectedTags);
            });
        }

        if ($this->search) {
            $query->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        $posts = $query->latest()->paginate(6);

        return view('livewire.frontend.blog.blog-index', [
            'posts' => $posts,
            'latestPosts' => $this->latestPosts,
            'categories' => $this->categories,
            'allTags' => $this->allTags,
            'selectedTags' => $this->selectedTags,
        ]);
    }

}
