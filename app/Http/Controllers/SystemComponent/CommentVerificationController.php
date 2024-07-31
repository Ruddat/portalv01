<?php

namespace App\Http\Controllers\SystemComponent;

use Illuminate\Http\Request;
use App\Models\ModAdminBlogComment;
use App\Http\Controllers\Controller;

class CommentVerificationController extends Controller
{
    public function verify($token)
    {

        // Dekodiere den Token
        $decodedToken = base64_decode($token);

        // Find the comment by token and email
        // $comment = ModAdminBlogComment::where('verification_token', $token)->where('email', $email)->first();
        $comment = ModAdminBlogComment::where('verification_token', $token)->first();

        if ($comment) {
            // Verify the comment
            $comment->approved = true;
            $comment->verification_token = null;
            $comment->save();

            return redirect()->route('blog-post', ['identifier' => $comment->post_id])->with('message', 'Your comment has been verified and approved.');
        } else {
            return redirect()->route('blog')->with('fail', 'Invalid verification link.');
        }
    }
}
