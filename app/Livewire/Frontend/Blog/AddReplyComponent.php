<?php

namespace App\Livewire\Frontend\Blog;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\AvatarHelper;
use App\Models\ModAdminBlogComment;

class AddReplyComponent extends Component
{
    public $commentId;
    public $author;
    public $content;
    public $email;

    protected $rules = [
        'author' => 'required|string|max:255',
        'content' => 'required|string|max:1000',
        'email' => 'required|email',
    ];

    public function mount($commentId)
    {
        $this->commentId = $commentId;
    }

    public function submit()
    {
        $this->validate();

        $token = Str::random(32);
        $encodedToken = base64_encode($token);


        // Generiere den Avatar für den Kommentar
        $avatarUrl = AvatarHelper::createAvatar($this->author);

        ModAdminBlogComment::create([
            'post_id' => ModAdminBlogComment::findOrFail($this->commentId)->post_id,
            'parent_id' => $this->commentId,
            'author' => $this->author,
            'content' => $this->content,
            'email' => $this->email,
            'approved' => false,
            'moderate' => true,
            'avatar_reply' => $avatarUrl, // Speichern des Avatar-URLs
            'verification_token' => $token,
        ]);


        // $verificationUrl = route('comment-verify-email', ['token' => $encodedToken, 'email' => $this->email]);
        $verificationUrl = route('comment-verify-email', ['token' => $encodedToken]);


        //  dd($verificationUrl);
        $data = [
            'author' => $this->author,
            'verificationUrl' => $verificationUrl
        ];

        $email_body = view('email-templates.omment-verify-email-template', $data)->render();

        $mailConfig = [
            'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => custom_env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $this->email,
            'mail_recipient_name' => $this->author,
            'mail_subject' => 'Email Verification',
            'mail_body' => $email_body
        ];

        if (sendEmail($mailConfig)) {
            session()->flash('message', 'Comment added successfully. Please check your email to verify your comment.');
         //   return view('backend.pages.seller.auth.email-verificaton', $data);
        } else {
            session()->flash('fail', 'Something went wrong');

        }

        $this->reset();
        $this->dispatch('replyAdded');
    }

    public function render()
    {
        return view('livewire.frontend.blog.add-reply-component');
    }
}
