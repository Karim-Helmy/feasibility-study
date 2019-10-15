<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class MessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = Message::with('user')->where('receiver_id',auth()->id())->orderBy('id', 'desc')->select('sender_id')->groupBy('sender_id')->paginate(12);
        return view('super.messages.index', [
            'title' => trans('admin.show all messages'),
            'index' => $message,
        ]);
    }

    /**
     * Display the details resource.
     *param sender_id
     * @return \Illuminate\Http\Response
     */

     public function show($sender_id = null)
     {
         $messages = Message::where([
             ['receiver_id',auth()->id()],
             ['sender_id',$sender_id],
         ])->orWhere([
             ['receiver_id',$sender_id],
             ['sender_id',auth()->id()],
         ])->orderBy('id', 'asc')->get();
          $user = User::where('id',$sender_id)->first();
          $username = $user->username ?? " Super Admin";
         $all = $messages->map(function($message) use($sender_id){
             if($message->receiver_id == $sender_id){
                 $type = 'send';
             }else{
                 $type = 'receive';
             }
             return $data = [
                 'type' => $type,
                 'subject' => $message->subject,
                 'message' => $message->message,
                 'date' => $message->created_at,
             ];
         })->toArray();
         return view('super.messages.show', [
             'title' => trans('admin.show'),
             'messages' => $all,
             'username' => $username,
             'sender_id'=> $sender_id,
         ]);
     }

     /**
      * [save new message]
      * @param  Request $request [description]
      * @return [type]           [description]
      */
     public function send(Request $request,$sender_id = null){
         $data = $this->validate($request, [
             'subject'=>'required|max:150',
             'message'=>'required',
         ]);
         $data['sender_id']   = auth()->id();
         $data['receiver_id'] = $sender_id;
         $message = Message::Create($data);
         session()->flash('success', trans("admin.sent Successfully"));
         return redirect()->back();
     }

}
