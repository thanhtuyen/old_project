<?php
Class Service_signup extends MY_Model{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getListYear()
    {
        $cur = date('Y');
        $data = array(
//             '' => '選択してください'
        );
        for ($i = $cur - 15; $i >= $cur-70; $i--)
        {
            if ($i< 10){
                $i = '0'.$i;
            }
            $data[$i] = $i; 
        }
        
        return array($data, $cur - 40);
    }
    public function getListMonth()
    {
        $data = array(
//             '' => '選択してください'
        );
        for ($i = 1; $i <= 12; $i++)
        {
        if ($i< 10){
            $i = '0'.$i;
        }
            $data[$i] = $i;
        }
        
        return array($data, date('m'));
    }
    public function getListDay()
    {
        $data = array(
//             '' => '選択してください'
        );
        for ($i = 1; $i <= 31; $i++)
        {
        if ($i< 10){
            $i = '0'.$i;
        }
            $data[$i] = $i;
        }
        
        return array($data, date('d'));
    }
    
    /**
     * get list of tags by groups ID
     * 
     * @param   array  $group_ids
     * 
     * @return  array  Tags
     */
    public function getTagsByGroups(array $group_ids)
    {
        $this->load->model('Logic_tag');
        $data = array(
//             '' => '選択してください'
        );
        $params = [
            'delete_flg' => 0,
            'group_id' => $group_ids
        ];
        $tags = $this->Logic_tag->get_list($params);

        
        foreach ((array)$tags as $tag){
            $data[$tag['tag_id']] = $tag['name'];
        }
                
        return $data;
    }
}    
    