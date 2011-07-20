<?php

class ComTokensModelTokens extends KModelTable
{
	public function __construct($config) 
	{
		parent::__construct($config);
		
		$this->_state
			->insert('user_id', 'int', 0)
			->insert('token', 'cmd', null);
	}
	
	protected function _buildQueryWhere(KDatabaseQuery $query) 
	{
		parent::_buildQueryWhere($query);
		
		if ($this->_state->user_id) {
			$query->where('tbl.user_id', '=', $this->_state->user_id);
		}
		
		if ($this->_state->token) {
			$query->where('tbl.token', '=', md5($this->_state->token));
		}
	}
}