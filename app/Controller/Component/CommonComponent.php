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
			//���o�� exit����
			case 0:
			//���o�� exit���Ȃ�
			case 1:
				#if(is_bj()){
				if (!headers_sent()) header("Content-Type: text/html; charset={$str_code}");
				ob_start();
				echo '<html><head><meta http-equiv="content-type" content="text/html; charset='.$str_code.'"><body>';
				echo str_repeat("\n" , 5);

				// �Ăяo�����Əo��
				echo "<div style=\"color:green;font-weight:bold;width:1000px\">\n";
				echo "{$data[0]["file"]} {$data[0]["line"]}�s��\n";
				echo "</div>";
	
				// �����o��
				echo "<pre style=\"background:#DDFFDD;padding:5px;width:1000px;\">";
				
				ob_start();
				var_dump($data[0]["args"][0]);
				$o = ob_get_clean();
				echo str_replace("\n" , "<br>" , $o);
				
				echo "</pre>\n";
	
				unset($data[0]);

				//�Ăяo�����Ƃ̃R�[�����ꗗ���o��
				echo "<div style=\"color:green;font-weight:bold;width:1000px\">\n";
				foreach($data as $k=>$v){
					if(!empty($v["file"]) and !empty($v["line"]))
					echo "{$v["file"]} {$v["line"]}�s��<br>\n";
				}//foreach
				echo "</div>\n";
				echo str_repeat("\n" , 5);

				echo "</body></head></html>";
	
				#$o = ob_get_clean();
				$o = mb_convert_encoding($o , "SJIS" , "UTF-8");
				echo $o;
				
				// 1�̎���exit���Ȃ�
				if($type===0){
					exit;
				}
				#}
				if($type===3){
					exit;
				}
				break;

			//�����O�o��
			case 2:
				//�u��2009/01/03 20:16;18 --- C:\xampp\htdocs\CAKEPROJECT\aqua\mb\app_model.php at line 8 ---------------�v
				$pre = "\n��" . date("Y/m/d H:i;s") ." ". str_repeat("-" , 3) . " ";
				$debug_info = "{$data[0]["file"]} at line {$data[0]["line"]} " .str_repeat("-" , 15) . "\n\n";
				$output = $pre . $debug_info .  var_export($data[0]["args"][0] , 1);
				file_put_contents(OUTPUT_FILE_PATH . $fname , $output , FILE_APPEND | LOCK_EX);
		
		}//switch
	}


}

?>