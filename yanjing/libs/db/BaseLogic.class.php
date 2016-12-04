<?php
	
	/*==================================================================*/
	/*		文件名:BaseLogic.class.php                          */
	/*		概要: 数据处理公共类.                	       	    */
	/*		作者: 李文                                          */
	/*		创建时间: 2011-07-15                                */
	/*		最后修改时间:2011-07-15                             */
	/*		copyright (c)2011 15919572@qq.com                  */
	/*==================================================================*/
	class BaseLogic extends MyDB {
		protected $tabName;		//表的名称
		protected $fieldList;
		protected $messList;


		//==========================================
		// 函数: add($postList)
		// 功能: 添加
		// 参数: $postList 提交的变量列表 
		// 返回: 刚插入的自增ID
		//==========================================
		function add($postList) {
			$fieldList='';
			$value='';
			foreach ($postList as $k=>$v) {
				if(in_array($k, $this->fieldList)){
					$fieldList.=$k.",";
					if (!get_magic_quotes_gpc())
						$value .= "'".addslashes($v)."',";
					else
						$value .= "'".$v."',";
				}
			}

			$fieldList=rtrim($fieldList, ",");
			$value=rtrim($value, ",");

			$sql="INSERT INTO {$this->tabName} (".$fieldList.") VALUES (".$value.")";
			$result=$this->mysqli->query($sql);

			if($result && $this->mysqli->affected_rows>0) 
				return $this->mysqli->insert_id;
			else
				return false;
		}

		//==========================================
		// 函数: adds($postList)
		// 功能: 添加多个记录
		// 参数: $postList 提交的变量列表 
		// 返回: 刚插入的自增ID
		//==========================================
		
		function adds($postList){
			$fieldList='';
			$value='';
			$i=0;
			foreach ($postList as $k=>$v) {
				$value.='(';
				$i++;
				foreach($v as $key=>$val){
					if(in_array($key, $this->fieldList) && $i==1){
						$fieldList.=$key.",";
					}
					if(in_array($key, $this->fieldList)){
						if (!get_magic_quotes_gpc())
							$value .= "'".addslashes($val)."',";
						else
							$value .= "'".$val."',";
					}
				}
				$value=rtrim($value, ",");
				$value.='),';
			}
			
			$fieldList=rtrim($fieldList, ",");
			$value=rtrim($value, ",");
			
			$sql="INSERT INTO {$this->tabName} (".$fieldList.") VALUES ".$value;
			$result=$this->mysqli->query($sql);

			if($result && $this->mysqli->affected_rows>0) 
				return $this->mysqli->insert_id;
			else
				return false;
			
		}

		//==========================================
		// 函数: mod($postList)
		// 功能: 修改表数据
		// 参数: $postList 提交的变量列表
		//==========================================
		function mod($postList) {
			$id=$postList["id"];
			unset($postList["id"]);
			$value='';
			foreach ($postList as $k=>$v) {
				if(in_array($k, $this->fieldList)){
					if (!get_magic_quotes_gpc())
						$value .= $k." = '".addslashes($v)."',";
					else
						$value .= $k." = '".$v."',";
				}
			}
			$value=rtrim($value, ",");
			$sql = "UPDATE {$this->tabName} SET {$value} WHERE id={$id}";
			return $this->mysqli->query($sql);	
		}
	
		//==========================================
		// 函数: mods($postList,$where)
		// 功能: 修改多条件数据
		// 参数: $postList 提交的变量列表 ,$where 附加条件
		//==========================================
		function mods($postList,$where='') {
			extract($postList);
			$value='';
			foreach ($postList as $k=>$v) {
				if(in_array($k, $this->fieldList)){
					if (!get_magic_quotes_gpc())
						$value .= $k." = '".addslashes($v)."',";
					else
						$value .= $k." = '".$v."',";
				}
			}
			$value=rtrim($value, ",");
			$sql = "UPDATE {$this->tabName} SET {$value} WHERE id={$id} ".$where;
			return $this->mysqli->query($sql);	
		}
	
		//==========================================
		// 函数: del($id)
		// 功能: 删除
		// 参数: $id 编号或ID列表数组
		// 返回: 0 失败 成功为删除的记录数
		//==========================================
		function del($id) {
			if(is_array($id))
				$tmp = "IN (" . join(",", $id) . ")";
			else 
				$tmp = "= $id";
			
			$sql = "DELETE FROM {$this->tabName} WHERE id " . $tmp ;
			return $this->mysqli->query($sql);	
		
		}
		
		
		//==========================================
		// 函数: get($id)
		// 功能: 获取ID所在记录
		// 参数: $id 编号或ID列表数组
		// 返回: 0 失败 成功为删除的记录数
		//==========================================
		
		function get($id) {
			$sql = "SELECT * FROM {$this->tabName} WHERE id ={$id}";
			$result=$this->mysqli->query($sql);

			if($result && $result->num_rows ==1){
				return $result->fetch_assoc();
			}else{
				return false;
			}
	
		}
		
		function get_other_datas($database,$tables,$d_id='',$id=0,$sort=''){
			$database=TAB_PREFIX.$database;
			if($sort){
				$sort="order by {$sort} desc";
			}
			if($d_id!='' || $id!=0){
				$conditions="WHERE {$d_id}={$id}";
			} else {
				$conditions="";
			}
			$sql = "SELECT ".$tables." FROM {$database} ".$conditions." ".$sort;
			$result=$this->mysqli->query($sql);
			if(!$result){
				return false;
			} else {
				while($row=$result->fetch_assoc()){
						$temp[]=$row;
				}
				return $temp;
			}
		}
		
		//获取当前SQL中的一行数据
		public function getOne($sql,$limited=false){
			if ($limited == true){
            	$sql = trim($sql . ' LIMIT 1');
       		}
			$result= $this->mysqli->query($sql);
			
			if ($result){
				$row = $result->fetch_row();
	
				if ($row){
					return $row[0];
				}
				else{
					return '';
				}
			}else{
				return false;
			}
		}
		
		//获取当前SQL中的全部数据
		public function getAll($sql){
			$result= $this->mysqli->query($sql);
			if ($result){
				 $arr = array();
				while ($row=$result->fetch_assoc()){
					$arr[] = $row;
				}
				return $arr;
			}else{
				return false;
			}
		}
		
		public function query($sql){
			$result= $this->mysqli->query($sql);
			if($result){
				return true;
			} else {
				return false;
			}
		}
		
		public function getCount($sql){
			$result= $this->mysqli->query($sql);
			if($result){
				return $result->num_rows;
			} else {
				return false;
			}
		}
		
	
		function getMessList(){
			$message="";
			if(!empty($this->messList)){
				foreach($this->messList as $value){
					$message.=$value."&nbsp;&nbsp;";
				}
			}
			return $message; 	
		}
	}
?>
