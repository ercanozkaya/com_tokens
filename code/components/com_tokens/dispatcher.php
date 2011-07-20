<?php

class ComTokensDispatcher extends KDispatcherAbstract
{
	protected function _actionDispatch(KCommandContext $context)
	{
		if (!KRequest::has('server.PHP_AUTH_USER')) {
		    header('WWW-Authenticate: Basic realm="Please enter your username/password"');
		    header('HTTP/1.0 401 Unauthorized');
		    exit;
		}

		return parent::_actionDispatch($context);
	}
	
	public function _actionForward(KCommandContext $context)
	{
		// TODO: why not just force KRequest::type to be AJAX?
		$view = KRequest::get('get.view', 'cmd');
		$context->result = $this->getController()->execute('display', $context);
		return $context->result;
	}
}