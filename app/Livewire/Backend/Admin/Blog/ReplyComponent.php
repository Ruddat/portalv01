<?php

namespace App\Livewire\Backend\Admin\Blog;

use Livewire\Component;
use App\Models\ModAdminBlogComment;

class ReplyComponent extends Component
{
    public $comments;
    public $editingCommentId = null;
    public $editingContent = '';

    public function mount()
    {
        $this->comments = ModAdminBlogComment::all();
    }

    public function render()
    {
        return view('livewire.backend.admin.blog.reply-component', [
            'comments' => $this->comments,
        ]);
    }

    public function approveComment($id)
    {
        $comment = ModAdminBlogComment::find($id);
        if ($comment) {
            $comment->approved = 1;
            $comment->moderate = 0;
            $comment->save();
            $this->comments = ModAdminBlogComment::all();
        }
    }

    public function deleteComment($id)
    {
        $comment = ModAdminBlogComment::find($id);
        if ($comment) {
            $comment->delete();
            $this->comments = ModAdminBlogComment::all();
        }
    }

    public function toggleModerate($id)
    {
        $comment = ModAdminBlogComment::find($id);
        if ($comment) {
            $comment->moderate = !$comment->moderate;
            $comment->save();
            $this->comments = ModAdminBlogComment::all();
        }
    }

    public function editComment($id)
    {
        $comment = ModAdminBlogComment::find($id);
        if ($comment) {
            $this->editingCommentId = $id;
            $this->editingContent = $comment->content;
        }
    }

    public function saveComment()
    {
        if ($this->editingCommentId) {
            $comment = ModAdminBlogComment::find($this->editingCommentId);
            if ($comment) {
                $comment->content = $this->editingContent;
                $comment->save();
                $this->comments = ModAdminBlogComment::all();
                $this->editingCommentId = null;
                $this->editingContent = '';
            }
        }
    }
}
