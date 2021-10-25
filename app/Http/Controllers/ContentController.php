<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\User;
use App\Models\ContentImage;
use Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{

    public function input()
    {
        return view('contents.input');
    }
    
    public function search()
    {
        return view('contents.search');
    }

    public function save(Request $request)
    {
        $input_content = new Content();
        // ↓編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $input_content->user_id =$data;
        $input_content->content = $request['content'];
        $input_content->save();

        if ($request->file('file')) {
            $this->validate($request, [
                'file' => [
                    // 空でないこと
                    'required',
                    // アップロードされたファイルであること
                    'file',
                    // 画像ファイルであること
                    'image',
                    // MIMEタイプを指定
                    'mimes:jpeg,png',
                ]
            ]);


            
            
            if ($request->file('file')->isValid([])) {
                $file_name = $request->file('file')->getClientOriginalName();
                $file_path = Storage::putFile('/images', $request->file('file'), 'public');

                $image_info = new ContentImage();
                $image_info->content_id = $input_content->id;
                $image_info->file_name = $file_name;
                $image_info->file_path = $file_path;
                $image_info->save();
            }
        }
        

        return redirect(route('output'));
    }

    public function output()
    {
        $contents_get_query = Content::select('id');
        $items = $contents_get_query->get();
        $names_get_query = User::select('name');
        $names = $names_get_query->get();

        foreach ($items as &$item) {
            $file_path = ContentImage::select('file_path')
            ->where('content_id', $item['id'])
            ->first();
            if (isset($file_path)) {
                $item['file_path'] = $file_path['file_path'];
            }
        }
        foreach($names as &$name){
            
        }

        return view('contents.output', [
            'items' => $items,
        ]);
    }

    public function detail($content_id)
    {
        $content_get_query = Content::select('*');
        $item = $content_get_query->find($content_id);

        $file_path = ContentImage::select('file_path')
        ->where('content_id', $item['id'])
        ->first();
        if (isset($file_path)) {
            $item['file_path'] = $file_path['file_path'];
        }

        return view('contents.detail', [
            'item' => $item,
        ]);
    }

    public function edit($content_id)
    {
        $content_get_query = Content::select('*');
        $item = $content_get_query->find($content_id);

        return view('contents.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request)
    {
        $content_get_query = Content::select('*');
        $content_info = $content_get_query->find($request['id']);
        $content_info->content = $request['content'];
        $content_info->save();
        return redirect(route('output'));
    }

    public function delete(Request $request)
    {
        $contents_delete_query = Content::select('*');
        $contents_delete_query->find($request['id']);
        $contents_delete_query->delete();

        $content_images_delete_query = ContentImage::select('*');
        if ($content_images_delete_query->find($request['id'] !== '[]')) {
            $content_images_delete_query->delete();
        }

        return redirect(route('output'));
    }

    //検索画面ボタン押下後検索処理
    public function searched(Request $request)
    {

        // var_dump($request);
        // exit();
        //確認済み
        $validator = Validator::make($request->all(), [
        'search' => 'required | max:250',
      ]);
      // バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('tweet.search')
          ->withInput()
          ->withErrors($validator);
      }
      $query = Tweet::query();
      //targetに検索語を格納,sortにソートの値を格納
      $words = $request ->search;
      $sort = $request ->sort;
      $sort_check = array(
        "userfilter" => 0,
        "sincefilter" => 0,
        "untilfilter" => 0,
      );
      //絞り込みがないか確かめ(上からユーザ名、いつ以降、いつ以前で絞り込み)
      if(preg_match('%flom:%',$words)){
        $sort_check["userfilter"] = 1;
      }
      if(preg_match('%since:%',$words)){
        $sort_check["sincefilter"] = 1;
      }
      if(preg_match('%until:%',$words)){
        $sort_check["sincefilter"] = 1;
      }
      //ソートの並び替えをorder格納
      if($sort == ""){
        $query->orderBy('updated_at','desc');
      }else if($sort == "new"){
        $query->orderBy('created_at','desc');
      }else if($sort = "old"){
        $query->orderBy('created_at','asc');
      }
      //空白ごとに分けて配列に格納
      $array_words = explode(' ',$words);
      $where = "";
      if($sort_check["userfilter"] == 1){
        $array_num = array_search('flom:',$array_words);
        $array_words[$array_num] = str_replace('flom:','',$array_words[$array_num]);
        //Userから名前検索してuser_idを持ってくる
        $users = User::where('name','like',"%$array_words[$array_num]%")->pluck('id');
        //条件にid追加
        $query->where('user_id',$users);
        array_splice($array_words,$array_num,1);
      }
      if($sort_check["sincefilter"] == 1){
        $array_num = array_search('since:',$array_words);
        str_replace('since:','',$array_words[$array_num]);
        $query->whereColumn('created_at','<',$array_words[$array_num]+' '+$array_words[$array_num+1]);
        if($sort_check["untilfilter"] != 1){
          array_splice($array_words,$array_num,2);
        }
      }
      if($sort_check["untilfilter"] == 1){
        $array_num = array_search('until:',$array_words);
        str_replace('until:','',$array_words[$array_num]);
        $query->whereColumn('created_at','>',$array_words[$array_num]+' '+$array_words[$array_num+1]);
        array_splice($array_words,$array_num,2);
      }
      //繰り返しで複数検索できるようにする
      foreach($array_words as $word){
        $query->orWhere('tweet','like',"%$word%")->orWhere('description','like',"%$word%");
      }
      // dd($query->toSql(),$query->getBindings());
      $result = $query->get();
      //一覧画面に検索結果を格納する
      return view('tweet.index',[
        'tweets' => $result
      ]);
    }
    

    //laraterのマイページ
    // public function mydata()
    // {
    //   // Userモデルに定義した関数を実行する．
    //   $tweets = User::find(Auth::user()->id)->mytweets;
    //   return view('tweet.index', [
    //     'tweets' => $tweets
    //   ]);
    // }
}