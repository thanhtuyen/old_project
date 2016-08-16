<?php

trait LoginTrait{

    /**
     * Get user and client data session
     * @return session false/array
     */
    protected  function getUserSession(){
        if(empty($this->session)){
            $this->load->library('session');
        }
        $user_session = $this->session->userdata("user_data");

        if(empty($user_session)){
            return false;
        }
        return $user_session;
    }


    /**
     * Get client id
     * @return false/int client_id
     *
     */
    protected function getClientId(){
        $user_session = $this->getUserSession();
        if(empty($user_session)){
            return false;
        }

        if(! isset($user_session["client_id"])){
            return  false;
        }

        $client_id = (int) $user_session["client_id"];
        return $client_id;
    }

    /**
     * Get user id
     * @return false/int user_id
     *
     */
    protected function getUserId(){
        $user_session = $this->getUserSession();
        if(empty($user_session)){
            return false;
        }

        if(! isset($user_session["user_id"])){
            return  false;
        }

        $user_id = (int) $user_session["user_id"];
        return $user_id;
    }

    /**
     * Check client is login
     * @return boolean
     */
    protected function isClientLogin(){
        return (bool) $this->getClientId();
    }

    /**
     * Check user is login
     * @return boolean
     */
    protected function isUserLogin(){
        return (bool) $this->getUserId();
    }

    protected function setUserLogin($user_id){
        if(empty($this->session)){
            $this->load->library('session');
        }
        $user_data['user_id'] = $user_id;
        $user_data['login'] = true;
        $this->session->set_userdata('user_data', $user_data);
    }

    protected function setClientLogin($client_id){
        if(empty($this->session)){
            $this->load->library('session');
        }
        $user_data['client_id'] = $client_id;
        $user_data['client_login'] = true;
        $this->session->set_userdata('user_data', $user_data);
    }

}