<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function index() {
        $forum = DB::table('forums')
                    ->leftJoin('users', 'forums.user_id', '=', 'users.id')
                    ->select('forums.*', 'users.name')
                    ->get();

        return view('forum', ['forums' => $forum]);
    }

    public function show($id) {
        $forum = DB::table('forums')
                    ->leftJoin('users', 'forums.user_id', '=', 'users.id')
                    ->select('forums.*', 'users.name')
                    ->where('forums.id', '=', $id)
                    ->first();

        $forum_chat = DB::table('forum_chats')        
                    ->leftJoin('users', 'forum_chats.user_id', '=', 'users.id')
                    ->select('forum_chats.*', 'users.name', 'users.id as user_id')
                    ->where('forum_chats.id', '=', $id)
                    ->get();

        return view('forumDetail', ['forum' => $forum, 'forum_chats' => $forum_chat]);
    }

    public function store(Request $request) {
        $forum = new Forum();
        $forum->forum_title = $request->forum_title;
        $forum->user_id = session('user_id');
        $forum->save();

        return redirect('/forum')->with('success', 'Forum Diskusi Berhasil Dibuat');
    }
    
    public function storeForumChat(Request $request, $id) {
        $forum_chat = new ForumChat();
        $forum_chat->forum_chat_text = $request->forum_chat_text;
        $forum_chat->forum_id = $id;
        $forum_chat->user_id = session('user_id');
        $forum_chat->save();

        return redirect('/forum/'. $forum_chat->forum_id)->with('success', 'Berhasil membalas forum diskusi');
    }

    public function destroyForumChat($id, $forum_chat_id) {
        $forum = DB::table('forum_chats')
                    ->where('id', '=', $forum_chat_id)
                    ->delete();

        return redirect('/forum/'. $id)->with('success', 'Berhasil menghapus balasan forum diskusi');
    }

    public function destroy($id) {
        $forum = DB::table('forums')
                    ->where('id', '=', $id)
                    ->delete();

        return redirect('/forum')->with('success', 'Berhasil menghapus forum diskusi');
    }
}
