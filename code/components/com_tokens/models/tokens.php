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
	
	protected function _buildQueryColumns(KDatabaseQuery $query)
	{
		parent::_buildQueryColumns($query);
		
		$query->select('u.username AS username, u.email AS email');
	}
	
	protected function _buildQueryJoins(KDatabaseQuery $query)
	{
		parent::_buildQueryJoins($query);
		
		$query->join('LEFT', 'users AS u', 'tbl.user_id = u.id');
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