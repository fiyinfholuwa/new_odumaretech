<?php

namespace App\Http\Controllers;

use App\Models\QuestionForum;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function forum(){
        $threads = Thread::with('user')->orderByDesc('id')->get();
        return view('user.forum', ['threads'  => $threads]);
    }
    public function q_a(){
        $questions = QuestionForum::with('user')->orderByDesc('id')->get();
        return view('user.q_a', ['questions'  => $questions]);
    }
    public function q_a_detail($id){
        $question = QuestionForum::with('question_replies.user')->findOrFail($id);

        // Track unique view per user
        $sessionKey = 'viewed_thread_' . $id . '_by_user_' . Auth::id();
        if (!session()->has($sessionKey)) {
            $question->increment('views');
            session()->put($sessionKey, true);
        }

        return view('user.q&a_detail', compact('question'));
        
    }

    public function storeQuestion(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:2048',
    ]);

    $filePath = null;
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $directory = 'uploads/threads/';

        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        $file->move(public_path($directory), $filename);
        $filePath = $directory . $filename;
    }

    \App\Models\QuestionForum::create([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'attachment_path' => $filePath,
        'user_id' => Auth::user()->id,
    ]);

    return response()->json(['message' => 'Question posted successfully.']);
}


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'content' => 'required',
    //         'category' => 'required'
    //     ]);

    //     Thread::create([
    //         'title' => $request->title,
    //         'content' => $request->content,
    //         'category' => $request->category,
    //         'user_id' => Auth::id()
    //     ]);

    //     return redirect()->route('threads.index');
    // }



    public function store(Request $request): \Illuminate\Http\JsonResponse
{
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string'
        ]);

        // Optional file handling
        $filePath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $directory = 'uploads/threads/';
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }
            $file->move(public_path($directory), $filename);
            $filePath = $directory . $filename;
        }

        Thread::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'attachment_path' => $filePath
        ]);

        return response()->json(['message' => 'Thread created successfully.']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    }
}


    public function show($id)
    {
        $thread = Thread::with('replies.user')->findOrFail($id);

        // Track unique view per user
        $sessionKey = 'viewed_thread_' . $id . '_by_user_' . Auth::id();
        if (!session()->has($sessionKey)) {
            $thread->increment('views');
            session()->put($sessionKey, true);
        }

        return view('user.forum_detail', compact('thread'));
    }


    public function destroy($id)
{
    $thread = Thread::findOrFail($id);

    Reply::where('thread_id', $thread->id)->delete();

    $thread->delete();

    return redirect()->route('forum')->with([
        'message' => 'Thread and its replies deleted successfully.',
        'alert-type' => 'success'
    ]);
}


public function reply(Request $request, $id)
{
    $request->validate([
        'content' => 'required',
        'attachment' => 'nullable|file|max:2048'
    ]);

    $filePath = null;

    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $directory = 'uploads/forum_replies/';

        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        $file->move(public_path($directory), $filename);
        $filePath = $directory . $filename;
    }

    Reply::create([
        'thread_id' => $id,
        'user_id' => Auth::user()->id,
        'content' => $request->content,
        'image' => $filePath,
    ]);

    Thread::where('id', $id)->increment('reply_count');

    return response()->json(['message' => 'Reply posted successfully']);
}


public function markHelpful($id)
{
    $reply = Reply::findOrFail($id);
    $key = 'helpful_' . $id . '_user_' . Auth::id();

    if (!session()->has($key)) {
        $reply->increment('helpful_count');
        session()->put($key, true);
    }

    return response()->json(['helpful_count' => $reply->helpful_count]);
}

}
