<?php

namespace App\Livewire\Frontend\Blog;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\AvatarHelper;
use App\Models\ModAdminBlogComment;
use App\Helpers\BadWordsFilterHelper;

class AddComment extends Component
{
    public $postId;
    public $author;
    public $email;
    public $content;
    public $website;

    protected $rules = [
        'author' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'content' => 'required|string',
        'website' => 'nullable|url|max:255',
    ];

    public function submit()
    {
        $this->validate();

        $token = Str::random(32);
        $encodedToken = base64_encode($token);

        // Generiere den Avatar für den Kommentar
        $avatarUrl = AvatarHelper::createAvatar($this->author);


        // Filtere den Inhalt mit BadWordsFilterHelper
        $filterResult = BadWordsFilterHelper::filterComment($this->content);
        $filteredContent = $filterResult['filteredContent'];
        $containsBadwords = $filterResult['containsBadwords'];

//dd($containsBadwords);


        $comment = ModAdminBlogComment::create([
            'post_id' => $this->postId,
            'author' => $this->author,
            'email' => $this->email,
            'content' => $filteredContent,
            'website' => $this->website,
            'approved' => false,
            'moderate' => $containsBadwords, // Setzt moderate auf true oder false
            'avatar' => $avatarUrl, // Speichern des Avatar-URLs
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
        //    return redirect()->route('admin.forgot-password');
        }



        // Send verification email
      //  Mail::to($this->email)->send(new CommentVerification($comment));





        $this->reset(['author', 'email', 'content', 'website']);

    }

    public function render()
    {
        return view('livewire.frontend.blog.add-comment');
    }
}
