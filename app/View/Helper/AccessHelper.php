<?
    class AccessHelper extends Helper{
    var $helpers = array("Session");

    public function isLoggedin(){
        App::import('Component', 'Auth');
        $newcomp=new ComponentCollection();
                //----------------------------------------------------------------
        $auth = new AuthComponent($newcomp);
        $auth->Session = $this->Session;
        $user = $auth->user();
        return !empty($user);
    }
}