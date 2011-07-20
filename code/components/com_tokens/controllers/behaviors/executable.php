<?php

class ComTokensControllerBehaviorExecutable extends KControllerBehaviorExecutable
{
    public function canEdit()
    {
    	return false;
    }
}