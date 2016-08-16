<?php
class AppException {
    public static function handleException($error) {
		 CakeLog::write(EXCEPTION_LOG, $error);
		 return ErrorHandler::handleException($error);
   }
}

