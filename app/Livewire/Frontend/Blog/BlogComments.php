<?php

namespace App\Livewire\Frontend\Blog;

use Livewire\Component;
use App\Models\ModAdminBlogPost;
use App\Models\ModAdminBlogComment;

class BlogComments extends Component
{
    public $post;
    public $commentIdForReply;

    protected $listeners = [
        'showReplyForm' => 'setCommentIdForReply',
        'replyAdded' => 'resetCommentIdForReply'
    ];

    public function mount($postId)
    {
        $this->post = ModAdminBlogPost::with('comments.replies')->findOrFail($postId);
    }

    public function setCommentIdForReply($commentId)
    {
        $this->commentIdForReply = $commentId;
    }

    public function resetCommentIdForReply()
    {
        $this->commentIdForReply = null;
    }

    public function render()
    {
        return view('livewire.frontend.blog.blog-comments', [
            'comments' => $this->post->comments
        ]);
    }

}
