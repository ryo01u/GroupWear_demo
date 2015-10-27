<?php
 
class CommonComponent extends Component {
 

	public function v($_data , $type=0 , $fname="v.log")
	{
		$str_code = "Shift_Jis";

		$this->vz($_data , $type, $fname="v.log" , $str_code);
	}//v


	function vz($_data , $type=0 , $fname="v.log" , $str_code = "Shift_jis"){
		$data = debug_backtrace();
		switch($type){
			//■出力 exitする
			case 0:
			//■出力 exitしない
			case 1:
				#if(is_bj()){
				if (!headers_sent()) header("Content-Type: text/html; charset={$str_code}");
				ob_start();
				echo '<html><head><meta http-equiv="content-type" content="text/html; charset='.$str_code.'"><body>';
				echo str_repeat("\n" , 5);

				// 呼び出しもと出力
				echo "<div style=\"color:green;font-weight:bold;width:1000px\">\n";
				echo "{$data[0]["file"]} {$data[0]["line"]}行目\n";
				echo "</div>";
	
				// 引数出力
				echo "<pre style=\"background:#DDFFDD;padding:5px;width:1000px;\">";
				
				ob_start();
				var_dump($data[0]["args"][0]);
				$o = ob_get_clean();
				echo str_replace("\n" , "<br>" , $o);
				
				echo "</pre>\n";
	
				unset($data[0]);

				//呼び出しもとのコール元一覧を出力
				echo "<div style=\"color:green;font-weight:bold;width:1000px\">\n";
				foreach($data as $k=>$v){
					if(!empty($v["file"]) and !empty($v["line"]))
					echo "{$v["file"]} {$v["line"]}行目<br>\n";
				}//foreach
				echo "</div>\n";
				echo str_repeat("\n" , 5);

				echo "</body></head></html>";
	
				#$o = ob_get_clean();
				$o = mb_convert_encoding($o , "SJIS" , "UTF-8");
				echo $o;
				
				// 1の時はexitしない
				if($type===0){
					exit;
				}
				#}
				if($type===3){
					exit;
				}
				break;

			//■ログ出力
			case 2:
				//「■2009/01/03 20:16;18 --- C:\xampp\htdocs\CAKEPROJECT\aqua\mb\app_model.php at line 8 ---------------」
				$pre = "\n■" . date("Y/m/d H:i;s") ." ". str_repeat("-" , 3) . " ";
				$debug_info = "{$data[0]["file"]} at line {$data[0]["line"]} " .str_repeat("-" , 15) . "\n\n";
				$output = $pre . $debug_info .  var_export($data[0]["args"][0] , 1);
				file_put_contents(OUTPUT_FILE_PATH . $fname , $output , FILE_APPEND | LOCK_EX);
		
		}//switch
	}


}

?>