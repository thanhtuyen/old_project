<?php
// File: /app/Lib/Error/CustomExceptionRenderer.php
App::uses('ExceptionRenderer', 'Error');
class CustomExceptionRenderer extends ExceptionRenderer {

    // override
    public function error400($error) {

        if ($this->controller->request->is('ajax')){
            $this->_respondJson($error);
        }
        $this->_prepareView($error, '');
        $code = ($error->getCode() > 500 && $error->getCode() < 506) ? $error->getCode() : 500;
        $this->controller->response->statusCode($code);
        $this->_outputMessage('error500');
    }

    // override
    public function error500($error) {

        if ($this->controller->request->is('ajax')){
            $this->_respondJson($error);
        }
        $this->_prepareView($error, '');
        $code = ($error->getCode() > 500 && $error->getCode() < 506) ? $error->getCode() : 500;
        $this->controller->response->statusCode($code);
        $this->_outputMessage('error500');
    }

    private function _respondJson($error) {
        $this->controller->response->type('application/json');
        $code = $error->getCode() ;
        if ($code==0) $code = 404;
        $object = array(
            'code' => $code,
            'message' => $error->getMessage()
        );
        $this->controller->response->body(json_encode($object));

        $this->controller->response->send();
        exit;
    }

    private function _prepareView($error, $genericMessage) {
        $message = $error->getMessage();
        if(!Configure::read('debug') && !Configure::read('detailed_exceptions')) {
            $message = __d('cake', $genericMessage);
        }
        $url = $this->controller->request->here();
        $renderVars = array(
            'name' => h($message),
            'url' => h($url),
            'message' => $message,
            'error' => $error
        );
        if(isset($this->controller->viewVars['csrf_token'])) {
            $renderVars['csrf_token'] = $this->controller->viewVars['csrf_token'];
        }
        $renderVars['_serialize'] = array_keys($renderVars);
        $this->controller->set($renderVars);
    }
}