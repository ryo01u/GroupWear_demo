<?php
//ユーザ定義定数
//呼び出し方:    echo FOOBAR;
//配列
//呼び出し方:    $fuga = Configure::read("fuga");
$config['fuga'] = array("a","b","c");


if ( ($_SERVER["HTTP_HOST"]) == 'qrator.gsj.intranet' ){

	define("URI_PATH","");
	// define("URL_PATH_ADMIN","/qrator_admin");
	define("TOP_URL","http://qrator.gsj.intranet/");


} else {
	define("URI_PATH","/qrator");

	define("TOP_URL","http://127.0.0.1/");

}





 
//連想配列
//呼び出し方:    $hoge = Configure::read("hoge");
$config['hoge'] = array(
  "A"=>"あ",
  "B"=>"い",
  "C"=>"う",
);

$config['sex'] = array(
  "1"=>"男",
  "2"=>"女",
  );
  
$config['job'] = array(
  "0"=>"",
  "1"=>"営業",
  "11"=>"ITコンサルタント",
  "12"=>"プロジェクトマネジャー",
  "13"=>"ディレクター",
  "14"=>"クリエイティブディレクター",
  "21"=>"デザイナー",
  "22"=>"マークアップエンジニア",
  "23"=>"コーダー",
  "31"=>"サーバーエンジニア",
  "32"=>"アプリエンジニア",
  "33"=>"インフラ担当",
  "41"=>"運用担当",
  "42"=>"経営企画",
  "43"=>"法務",
  "51"=>"経理",
  "52"=>"人事",
  "53"=>"総務",
  );

$config['project_type'] = array(
  "1"=>"サイト",
  "2"=>"営業",
  "3"=>"経理",
  "4"=>"セキュリティ",
  );

$config['client_type'] = array(
  "1"=>"NTT系",
  "2"=>"TFM系",
  "3"=>"純情系",
  "4"=>"草食系",
  "5"=>"小悪魔",
  );



$config['akasatana'] = array(
  "a"=>"あ",
  "k"=>"か",
  "s"=>"さ",
  "t"=>"た",
  "n"=>"な",
  "h"=>"は",
  "m"=>"ま",
  "y"=>"や",
  "r"=>"ら",
  "w"=>"わ",
);

$config['news_type'] = array(
  "1"=>"総務関連",
  "2"=>"ISMS関連",
  "3"=>"エンタメ系",
  "4"=>"おいしい寿司情報",
  "4"=>"B級グルメ情報",
  );

$config['busyo_type'] = array(
  "1"=>"総務",
  "2"=>"経理",
  "3"=>"ソリューション",
  "4"=>"モバイル",
  );


//マイページ
$config['mypage_type'] = array(
  "1"=>"department",
  "2"=>"group",
  "3"=>"staff",
  "4"=>"project",
  "5"=>"client",
  "999"=>"bookmark",
  );

//役職
$config['position'] = array(
  "1"=>"なし",
  "2"=>"ＧＭ",
  "3"=>"次長",
  "4"=>"部長/室長",
  "5"=>"役員",
  );


//契約タイプ
$config['contract_status'] = array(
  "1"=>"交渉中",
  "2"=>"NDA",
  "3"=>"契約中",
  );




//default_profile
$config['profile'] = (
  "Q.1 具体的にどんなお仕事をされていますか？…


  Q.2 血液型と星座を教えてください!!…


  Q.3 趣味は？…


  Q.4 好きな音楽のアーティストは？…


  Q.5 好きな本は（漫画,ライトノベルでも可）？…
   

  Q.6 好きな映画は？…
   

  Q.7 好きな食べ物は？…


  Q.8 好きなＴＶ番組は？…


  Q.9 休日は何をしていますか？…
   

  Q.10 一番リラックス出来る場所はどこですか？…


  Q.11 気を晴らすためにする行動を教えて下さい。…


  Q.12 無人島に一つだけ何か持っていけるとしたら？


  Q13. もし魔法を１つ使えるとしたら、その魔法で何をしますか？
   

  ★最後に皆さんに一言どうぞ★

                          "
  );

$config['memo'] = (
  "(メモ)代表者、資本金、業種、得意分野等


   (メモ)取引開始の経緯等"
  );

$config['states'] = array(
"<収支情報>"
  );

$config['markets'] = array(
"<リンク>"
  );

$config['plane_memo'] = array(
"<簡易スケジュールメモ>"
  );

define("MYPAGE_BOOKMARK", 999);
define("MYPAGE_DEPARTMENT", 1);
define("MYPAGE_GROUP", 2);
define("MYPAGE_STAFF", 3);
define("MYPAGE_PROJECT", 4);
define("MYPAGE_CLIENT", 5);

//契約タイプ
$config['contract_status'] = array(
  "1"=>"交渉中",
  "2"=>"NDA",
  "3"=>"契約中",
  );

define("SITE_TITLE", "QRATOR");