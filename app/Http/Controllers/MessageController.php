<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Message;
use App\Models\MessageReply;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $type = $request->messageType ?? 'incoming';
        if (auth()->user()->user_type === 'admin') {
            $data['messages'] = Message::all();
        } else {
            if ($type === 'incoming') {
                $data['messages'] = Message::where('to', auth()->user()->department_id)->get();
            } else {
                $data['messages'] = Message::where('from', auth()->user()->department_id)->get();
            }
        }
        $data['departments'] = Department::all();
        return view('message.send-message', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
//                dd($request->all());
        $this->validate($request, [
            'department' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'attachment' => '|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);
        try {
            DB::beginTransaction();
            $message = new Message();
            $message->to = $request->department;
            $message->from = auth()->user()->department_id;
            $message->subject = $request->subject;
            $message->message = $request->message;

            if ($request->audio !== null) {

                $audioData = $request->input('audio');
                list($type, $audioData) = explode(';', $audioData);
                list(, $audioData) = explode(',', $audioData);
                $audioData = base64_decode($audioData);
                $fileName = uniqid() . time() . '.webm';
                $directory = public_path('audios');
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
                $filePath = $directory . '/' . $fileName;
                file_put_contents($filePath, $audioData);


                $message->voice = 'audios/' . $fileName;
            }
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('attachments'), $fileName);
                $message->attachment = $fileName;
            }
            $message->user_id = auth()->id();
            $message->save();
            DB::commit();
            Alert::toast('Message sent successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Message not sent', 'error');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $data['message'] = Message::findOrFail($id);
        return view('message.view-message', $data);
    }

    //    user
    public function reply(Request $request)
    {
        //        dd($request->all());

        try {
            DB::beginTransaction();
            $reply = new MessageReply();
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $fileName = $request->messageId . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('attachments'), $fileName);
                $reply->attachment = $fileName;
            }
            $reply->from = auth()->user()->department_id;
            $reply->message_id = $request->messageId;
            $reply->message = $request->replyMessage;
            $reply->user_id = auth()->id();
            $reply->save();

            DB::commit();
            Alert::toast('Message sent successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Message not sent', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        dd($id);
        try {
            return response()->json(['message' => 'Message ' . $id . ' deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Message not deleted'], 400);
        }
    }
}
