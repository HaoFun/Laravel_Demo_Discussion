<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscussionsRequest;
use App\Markdown\Markdown;
use App\Repositories\DiscussionsRepository;
use Auth;

class DiscussionsController extends Controller
{
    protected $discussionsRepository;
    protected $markdown;

    public function __construct(Markdown $markdown,DiscussionsRepository $discussionsRepository)
    {
        $this->middleware('auth')->except('index','show');
        $this->discussionsRepository=$discussionsRepository;
        $this->markdown=$markdown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = $this->discussionsRepository->getDiscussionsLatest();
        return view('forum.index',compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionsRequest $request)
    {
        $data =
            [
                'title' => $request->get('title'),
                'body'  => $request->get('body'),
                'user_id' => Auth::user()->id,
                'last_user_id' => Auth::user()->id,
            ];
        $discussions = $this->discussionsRepository->create($data);
        flash('新建帖子成功')->success();
        return redirect()->action('DiscussionsController@show',['id'=>$discussions->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussions = $this->discussionsRepository->getDiscussionsByID($id);
        $markdown_body = $this->markdown->markdown($discussions->body);
        return view('forum.show',compact('discussions','markdown_body'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussions = $this->discussionsRepository->getDiscussionsByID($id);
        return view('forum.edit',compact('discussions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDiscussionsRequest $request, $id)
    {
        $discussions = $this->discussionsRepository->getDiscussionsByID($id);
        $data = [
            'title' => $request->get('title'),
            'body'  => $request->get('body'),
        ];
        $discussions->update($data);
        flash('修改帖子成功')->success();
        return redirect()->action('DiscussionsController@show',['id'=>$discussions->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discussions = $this->discussionsRepository->getDiscussionsByID($id);
        $discussions->delete();
        flash('刪除帖子成功')->success();
        return redirect('/');
    }
}
