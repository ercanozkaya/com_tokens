<?php

class ComTokensControllerToken extends KControllerService
{
	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->registerCallback('before.add', array($this, 'beforeAdd'));
	}

	public function beforeAdd(KCommandContext $context)
	{
		if ($this->isDispatched()) {
			$context->data->user_id = KFactory::get('lib.joomla.user')->id;
			$context->data->token = KFactory::get('admin::com.users.helper.password')->getRandom(32);
		}
	}
	
	public function getRequest()
	{
		$request = parent::getRequest();
		
		if ($this->isDispatched()) {
			$request->user_id = KFactory::get('lib.joomla.user')->id;
		}
		
		return $request;
	}
}