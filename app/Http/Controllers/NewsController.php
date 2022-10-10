<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\News;

class NewsController extends Controller
{
    //
    public function index()
    {
        // RSSのURL
        $url = 'https://kicker.town/feed';
        // 制御文字を取り除く
        $str = preg_replace('/[\x00-\x1f]/',' ',file_get_contents($url));
        //contentを取り出す
        $str = str_replace('<content:' ,'<content_',$str);  
        $str = str_replace('</content:' ,'</content_',$str);
        $rss = simplexml_load_string($str, NULL, LIBXML_NOCDATA);
        
        //dd($rss);
        // 初期化
        $rss_contents = [];
        
        foreach($rss->channel->item as $item){
            $title = (string)$item->title;  //タイトル　＊＊＊
            $link = (string)$item->link;  //リンク　＊＊＊
            $pubDate = (string)$item->pubDate;  //元の日時Fri, 03 Jun 2022 22:44:14 +0000
            $date = date('Y/m/d', strtotime($pubDate));  //0000/00/00　＊＊＊
            $team = (string)$item->category[0];  //チーム名　＊＊＊
            $guid = (string)$item->guid;  //元ページのリダイレクトURL
            $news_id = substr($guid, 23);  //記事のURLから抽出した番号　＊＊＊
            //説明文
            $description = $item->description;  //元の説明文
            $description = str_replace('　','',$description);  //空白削除
            $description = str_replace('<p>','',$description);  //<p>削除
            $description = mb_substr($description, 0, 40);  //40文字だけ切り取り　＊＊＊
            $content = $item->content_encoded;  //本文全部　＊＊＊
            //画像URL抽出
            $target_text = $content;  //対象の文字列
            $delimiter_start = 'src="';  //区切り文字（開始）
            $delimiter_end = '" alt=""';  //区切り文字（終了）
            $start_position = strpos($target_text, $delimiter_start) + strlen($delimiter_start);  //開始位置
            $length = strpos($target_text, $delimiter_end) - $start_position;  //切り出す部分の長さ
            $img_path = substr($target_text, $start_position, $length);  //切り出し　＊＊＊
            //contennt不要部分削除
            $delimiter_end2 = '<p>The post';  //区切り文字（終了）
            $start_position2 = 0;  //開始位置
            $length2 = strpos($target_text, $delimiter_end2) - $start_position2;  //切り出す部分の長さ
            $content = substr($target_text, $start_position2, $length2);  //切り出し　＊＊＊
            
            // 登録用の配列を作る
            $rss_content = [
                'news_id' => $news_id,
                'title' => $title,
                'date' => $date,
                'link' => $link,
                'team' => $team,
                'description' => $description,
                'content' => $content,
                'img_path' => $img_path,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ];
            
            $check = News::where('news_id', '=',  $news_id)->first();
                if ($check === null) {
                // DBに情報がなければ登録する
                News::insert($rss_content);
            };
            
            $rss_contents[] = $rss_content;
            // dd($rss_contents);
            // $feed->insertOrignore([$rss_content]);
        }
        return view('news.index', ['rss_contents' => $rss_contents]);
    }
    
    public function newsApi()
    {
        $news = News::orderByDesc('created_at')
            ->limit(5)
            ->get();
            
        return response()->json($news);
    }
}



// public function apiFeed(): \Illuminate\Http\JsonResponse