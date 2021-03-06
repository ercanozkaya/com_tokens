<?php
try {
	echo KFactory::get('site::com.tokens.dispatcher')->dispatch();	
}
catch (KException $e) {
	if (KRequest::format() == 'json') {
		$response = new stdclass;
		$response->error = true;
		$response->code = KHttpResponse::isError($e->getCode()) ? $e->getCode() : 500;
		$response->message = $e->getMessage();
		
		echo json_encode($response);
	}
	else {
		throw $e;
	}
}
