<?php
	
	/*==================================================================*/
	/*		文件名:Database.class.php                             */
	/*		概要: 数据库管理类.                	       	    */
	/*		作者: 李文                                        */
	/*		创建时间: 2011-07-15                                */
	/*		最后修改时间:2011-07-15                             */
	/*		copyright (c)2011 15919572@qq.com                  */
	/*==================================================================*/
	class Database extends BaseLogic{
		
		const BACKUP_PATH="data/backup/";
		private $files_arr=array();
		private $tablesName=array();
		
		public function __construct(){
			parent:: __construct($showError);
		}
		
		public function get_backup_files($start=0,$num=0){
			if(!file_exists(self::BACKUP_PATH)){
				mkdir(self::BACKUP_PATH);
				return false;
			}
			if($dir_handle=@opendir(self::BACKUP_PATH)){
				while($filename=readdir($dir_handle)){
					$filePath=self::BACKUP_PATH.$filename;
					$time=filemtime($filePath);
					$filesize=Common::sizeCount(filesize($filePath));
					if(is_file($filePath)){
						$temp=array($filename,$filesize,date("Y-m-d H:i:s",$time));
						array_push($this->files_arr,$temp);
					}
				}
				return array_slice($this->files_arr,$start,$num);
			} else {
				return false;
			}
		}
		
		
		
		public function delDatabase($id){
			if(count($id)==0){
					$this->messList[] = "请选择您要删除的文件！";
					return false;
			} else{
				if(!is_array($id)){
					$filename=self::BACKUP_PATH.$id;
					if(@unlink($filename)){
						$this->messList[] = "删除成功！";
						return true;
					}else{
						$this->messList[] = "删除失败！";
						return false;
					}
				} else {
					if($this->groupDel($id)){
						$this->messList[] = "批量删除成功！";
						return true;
					}else{
						$this->messList[] = "批量删除失败！";
						return false;
					}
				}
			}
		}
		/**
		 * 备份数据库
		 */
		public function backup_database(){
			date_default_timezone_set('PRC');
			$add_time = date("Y-m-d H:i:s");
			$sql="";
			$sql.="--".APP_NAME.",Version：".VERSION."\r\n".
				  "--Mysql VERSION：".$this->getVersion()."\r\n".
				  "--Create time：".$add_time."\r\n";
			$this->getTablesName();
			
			
			foreach($this->tablesName as $var){
				$sql.= "DROP TABLE IF EXISTS `".$var."`;\r\n";
				$result=$this->mysqli->query("show create table {$var}"); 
				$row_struct=$result->fetch_assoc();
				$sql.= $row_struct['Create Table'].";\r\n";
				$row_data=$this->getTablesData($var);
				if(!$row_data){
					$this->messList[] = "数据库打开失败！";
					return false;
				} else {
					foreach((array)$row_data[1] as $var_data){
						$sql_data= "INSERT INTO `{$var}` VALUES (";
						foreach($var_data as $row){
							$sql_data.="'".addslashes($row)."',";
						}
						$sql_data=substr($sql_data,0,-1);  //删除最后一个逗号
						$sql_data.= ");\r\n";
						$sql.=$sql_data;
					}
					
				}
					
			}

			if($this->saveSqltoFile($sql)){
				$this->messList[] = "备份成功！";
				return true;
			}else{
				$this->messList[] = "备份失败！";
				return false;
			}
		}
		/**
		 * 数据恢复
		 * @param fileName $id
		 */
		public function restore($id){
			$mydb=new MyDB();
			$filename=self::BACKUP_PATH.$id;
			$handle=@fopen($filename,"rb");
			$head=@fread($handle,97);
			fclose($handle);
			$arr=$this->getSqlInfo($head);
			
			$sql=$this->removeComments(file_get_contents($filename));
			$sql = trim($sql);
			$sql = str_replace("\r", '', $sql);
       		$segmentSql = explode(";\n", $sql);
			foreach($segmentSql as $var){
				if($var!=''){
					$result=$this->mysqli->query($var);
				}
				if(!$result){
					$this->messList[] = "恢复数据失败！";
					return false;
				}
			}
			
			if($arr['cms_ver']!=VERSION){
				$this->messList[] = "恢复数据失败，系统版本不一致！";
				return false;
			}elseif($arr['mysql_ver']!=$mydb->getVersion()){
				$this->messList[] = "恢复数据失败，数据库版本不一致！";
				return false;
			}else{
				$this->messList[] = "恢复数据成功！";
				return true;
			}
		}
		
		 private function removeComments($sql){
			/* 删除SQL行注释，行注释不匹配换行符 */
			$sql = preg_replace('/^\s*(?:--|#).*/m', '', $sql);
	
			/* 删除SQL块注释，匹配换行符，且为非贪婪匹配 */
			//$sql = preg_replace('/^\s*\/\*(?:.|\n)*\*\//m', '', $sql);
			$sql = preg_replace('/^\s*\/\*.*?\*\//ms', '', $sql);
	
			return $sql;
   		 }
		
		private function getSqlInfo($head){
			$file_info = array('cms_ver'=>'', 'mysql_ver'=> '', 'add_time'=>'');
			$head=str_replace("--","",$head);
			$arr = explode("\n", $head);
			foreach($arr as $var){
				$temp = explode("：", $var);
				switch($temp[0]){
					case '乐尚团购CMS,Version':
						$file_info['cms_ver']=trim($temp[1]);
					break;
					case 'Mysql VERSION':
						$file_info['mysql_ver']=trim($temp[1]);
					break;
					case 'Create time':
						$file_info['add_time']=trim($temp[1]);
					break;
				}
			}
			return $file_info;
		}
		private function getTablesData($tabName){
			$allData=array();
			$sql="select * from {$tabName}";
			$result=$this->mysqli->query($sql);
			if(!$result){
				return false;
			} else {
				while($row=$result->fetch_assoc()){
						$temp[]=$row;
						
				}
				
			}
			//$num=$result->num_rows;
			array_push($allData,$num,$temp);
			return $allData;
		}
		
		private function getTablesName(){ 
         	$result=$this->mysqli->query("show table status"); 
			if(!$result){
				return false;
			} else {
				while($row=$result->fetch_assoc()){ 
	             $this->tablesName[]=$row["Name"]; 
           		} 
				 return $this->tablesName; 
			}
        } 
		
		private function saveSqltoFile($sql_text){
//			 $fileName=self::BACKUP_PATH.time().".sql"; 
			 $fileName=self::BACKUP_PATH.date("Ymd-His").".sql"; 
			 if(file_exists($fileName)) { 
             	unlink($fileName); 
             } 
             $fp=fopen($fileName,"w+"); 
             if(fwrite($fp,$sql_text)){
				 return true;
			 } else {
				 return false;
			 }

		}
		
		private function groupDel($arr){
			foreach($arr as $var){
				$tmp=self::BACKUP_PATH.$var;
				if(!@unlink($tmp)){
					return false;
				}
			}
			return true;
		}
		
		public function get_database_num(){
			$arr = scandir(self::BACKUP_PATH); 
			$all = count($arr)-2;//所有文件总数除./和../ 
			$sql = count(preg_grep("/\.sql$/", $arr));
			return $sql;
		}
		
	}
?>