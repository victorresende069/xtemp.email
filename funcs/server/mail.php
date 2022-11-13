<?php
class aaPanelAPiMail {
	private $BT_KEY = "ghlW2qbA5espavvBzF2d7HcWPVxmsE7h";  //接口密钥
  	private $BT_PANEL = "https://serv1.xtemp.email:7800/";	   //面板地址
	

	public function __construct($bt_panel = null,$bt_key = null){
		if($bt_panel) $this->BT_PANEL = $bt_panel;
		if($bt_key) $this->BT_KEY = $bt_key;
	}
	
	
	public function GetMails($mail){

		$url = $this->BT_PANEL.'/plugin?action=a&name=mail_sys&s=get_mails';
		
		$p_data = $this->GetKeyData();		//取签名
		$p_data['username'] = $mail;
		$p_data['p'] = 1;

		$result = $this->HttpPostCookie($url,$p_data);
		
		$data = json_decode($result,true);
      	return $data;
	}
		
	public function GetListDomainMail(){

		$url = $this->BT_PANEL.'/plugin?action=a&name=mail_sys&s=get_domains';
		
		$p_data = $this->GetKeyData();		//取签名
		$p_data['p'] = 1;
        $p_data['size'] = 10;

		$result = $this->HttpPostCookie($url,$p_data);
		
		$data = json_decode($result,true);
      	return $data;
	}

	public function addMail($type, $name, $user, $domain, $password, $storage){

		$url = $this->BT_PANEL.'/plugin?action=a&name=mail_sys&s=add_mailbox';
		
		$p_data = $this->GetKeyData();		//取签名
		$p_data['quota'] = "$storage MB";
        $p_data['username'] = "$user@$domain";
		$p_data['password'] = "$password";
		$p_data['full_name'] = "$name";
		$p_data['is_admin'] = $type;

		$result = $this->HttpPostCookie($url,$p_data);
		
		$data = json_decode($result,true);
      	return $data;
	}

	public function deleteMail($email){

		$url = $this->BT_PANEL.'/plugin?action=a&name=mail_sys&s=delete_mailbox';
		
		$p_data = $this->GetKeyData();		//取签名
		$p_data['username'] = $email;

		$result = $this->HttpPostCookie($url,$p_data);
		
		$data = json_decode($result,true);
      	return $data;
	}

	
  	private function GetKeyData(){
  		$now_time = time();
    	$p_data = array(
			'request_token'	=>	md5($now_time.''.md5($this->BT_KEY)),
			'request_time'	=>	$now_time
		);
    	return $p_data;    
    }
  	
  
  	/**
     * 发起POST请求
     * @param String $url 目标网填，带http://
     * @param Array|String $data 欲提交的数据
     * @return string
     */
    private function HttpPostCookie($url, $data,$timeout = 60)
    {
    	//定义cookie保存位置
        $cookie_file='./'.md5($this->BT_PANEL).'.cookie';
        if(!file_exists($cookie_file)){
            $fp = fopen($cookie_file,'w+');
            fclose($fp);
        }
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}


$api = new aaPanelAPiMail();