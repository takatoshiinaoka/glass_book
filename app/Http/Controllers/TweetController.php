<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searched(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'search' => 'required | max:250',
      ]);
      if ($validator->fails()) {
        return redirect()
          ->route('tweet.search')
          ->withInput()
          ->withErrors($validator);
      }
      $query = glasses::query();
      $words = $request ->search;
      $sort = $request ->sort;
    //   $filter_check = array(
    //     "userfilter" => 0,
    //     "sincefilter" => 0,
    //     "untilfilter" => 0,
    //   );
    //   if(preg_match('%flom:%',$words)){
    //     $filter_check["userfilter"] = 1;
    //   }
    //   if(preg_match('%since:%',$words)){
    //     $filter_check["sincefilter"] = 1;
    //   }
    //   if(preg_match('%until:%',$words)){
    //     $filter_check["sincefilter"] = 1;
    //   }
      if($sort == ""){
        $query->orderBy('updated_at','desc');
      }else if($sort == "new"){
        $query->orderBy('created_at','desc');
      }else if($sort = "old"){
        $query->orderBy('created_at','asc');
      }
      $array_words = explode(' ',$words);
    //   if($sort_check["userfilter"] == 1){
    //     $array_num = array_search('flom:',$array_words);
    //     $array_words[$array_num] = str_replace('flom:','',$array_words[$array_num]);
    //     $users = User::where('name','like',"%$array_words[$array_num]%")->pluck('id');
    //     $query->where('user_id',$users);
    //     array_splice($array_words,$array_num,1);
    //   }
    //   if($sort_check["sincefilter"] == 1){
    //     $array_num = array_search('since:',$array_words);
    //     str_replace('since:','',$array_words[$array_num]);
    //     $query->whereColumn('created_at','<',$array_words[$array_num]+' '+$array_words[$array_num+1]);
    //     if($sort_check["untilfilter"] != 1){
    //       array_splice($array_words,$array_num,2);
    //     }
    //   }
    //   if($sort_check["untilfilter"] == 1){
    //     $array_num = array_search('until:',$array_words);
    //     str_replace('until:','',$array_words[$array_num]);
    //     $query->whereColumn('created_at','>',$array_words[$array_num]+' '+$array_words[$array_num+1]);
    //     array_splice($array_words,$array_num,2);
    //   }
      foreach($array_words as $word){
        $query->orWhere('tweet','like',"%$word%")->orWhere('description','like',"%$word%");
      }
      // dd($query->toSql(),$query->getBindings());
      $result = $query->get();
      return view('tweet.index',[
        'tweets' => $result
      ]);
    }
    //検索画面呼び出し
    public function search()
    {
      return view('tweet.search');
    }
}
    public function searched(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'search' => 'required | max:250',
      ]);
      if ($validator->fails()) {
        return redirect()
          ->route('tweet.search')
          ->withInput()
          ->withErrors($validator);
      }
      $query = glasses::query();
      $words = $request ->search;
      $sort = $request ->sort;
    //   $filter_check = array(
    //     "userfilter" => 0,
    //     "sincefilter" => 0,
    //     "untilfilter" => 0,
    //   );
    //   if(preg_match('%flom:%',$words)){
    //     $filter_check["userfilter"] = 1;
    //   }
    //   if(preg_match('%since:%',$words)){
    //     $filter_check["sincefilter"] = 1;
    //   }
    //   if(preg_match('%until:%',$words)){
    //     $filter_check["sincefilter"] = 1;
    //   }
      if($sort == ""){
        $query->orderBy('updated_at','desc');
      }else if($sort == "new"){
        $query->orderBy('created_at','desc');
      }else if($sort = "old"){
        $query->orderBy('created_at','asc');
      }
      $array_words = explode(' ',$words);
    //   if($sort_check["userfilter"] == 1){
    //     $array_num = array_search('flom:',$array_words);
    //     $array_words[$array_num] = str_replace('flom:','',$array_words[$array_num]);
    //     $users = User::where('name','like',"%$array_words[$array_num]%")->pluck('id');
    //     $query->where('user_id',$users);
    //     array_splice($array_words,$array_num,1);
    //   }
    //   if($sort_check["sincefilter"] == 1){
    //     $array_num = array_search('since:',$array_words);
    //     str_replace('since:','',$array_words[$array_num]);
    //     $query->whereColumn('created_at','<',$array_words[$array_num]+' '+$array_words[$array_num+1]);
    //     if($sort_check["untilfilter"] != 1){
    //       array_splice($array_words,$array_num,2);
    //     }
    //   }
    //   if($sort_check["untilfilter"] == 1){
    //     $array_num = array_search('until:',$array_words);
    //     str_replace('until:','',$array_words[$array_num]);
    //     $query->whereColumn('created_at','>',$array_words[$array_num]+' '+$array_words[$array_num+1]);
    //     array_splice($array_words,$array_num,2);
    //   }
      foreach($array_words as $word){
        $query->orWhere('tweet','like',"%$word%")->orWhere('description','like',"%$word%");
      }
      // dd($query->toSql(),$query->getBindings());
      $result = $query->get();
      return view('tweet.index',[
        'tweets' => $result
      ]);
    }
    //検索画面呼び出し
    public function search()
    {
      return view('tweet.search');
    }
