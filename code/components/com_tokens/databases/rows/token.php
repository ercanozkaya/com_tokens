<?php

class ComTokensDatabaseRowToken extends KDatabaseRowTable
{
	public function save()
	{
		if ($this->token) {
			$this->token_clear = $this->token;
			$this->token = md5($this->token);
		}
		
		return parent::save();
	}
	
	public function toArray()
	{
		$data = parent::toArray();
		
		$data['token'] = isset($this->token_clear) ? $this->token_clear : '';
		unset($data['token_clear']);
		unset($data['id']);
		unset($data['note']);
		
		return $data;
	}
}