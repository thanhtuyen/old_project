<?php

class Service_scout extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logic_template');
        $this->load->model('Logic_scout');
    }

    /**
     * get scout detail
     * @param  [string] $id = scout_id
     * @return [array]
     */
    public function get_scout_detail($id)
    {
        $this->load->model('Logic_scout');
        $param = array(
            'scout_id' => $id
        );
        $data[] = $this->Logic_scout->get_detail($param);
        if(isset($data[0])){
            //整形
	    $list = $this->replace_content($data);
            if(isset($list[0])){
                return $list[0];
            }
        }
        return false;
    }

    public function  get_total_count($condition){
        $this->load->model('Logic_scout');
//var_dump($condition);exit;
        return $this->Logic_scout->get_total_count($condition);
    }

    /* Get all scout data for admin side
     * @author Aya
     */
    public function get_list_of_scout($condition, $parameters){
        if ($parameters['total'] == 0) {
            return array();
        }
        $param = array(
            'offset'     => $parameters['offset'],
            'limit'      => $parameters['limit'],
            'delete_flg' => 0 //$this->config->item('not_deleted','common_config')
        );

        $this->load->model('Logic_scout');
        $data = $this->Logic_scout->get_scout_list($condition, $param);

	$list = $this->replace_content($data);
        return $list;
    }

    private function replace_content($data){
	foreach($data as $key => $val){
            $job_url = base_url() . "detail_" . $val["job_id"];
            $mail_1st = str_replace("{求人票タイトル}",$val["title"],$val["content"]);
            $mail_2nd = str_replace("{求人票URL}",$job_url,$mail_1st);
            $val['content_after'] = str_replace("{送り先名}",$val["username"],$mail_2nd);
            $list[$key] = $val;
        }
        return $list;
    }


    // BEGIN SEARCH USER
    /**
     * get all nurseries by client logged in
     *
     * @return array ['nursery_id', 'name']
     */
    public function getNurseries($client_id)
    {
        $this->load->model('Logic_nursery');

        $where = [
            'client_id' => $client_id,
            'status' => Logic_nursery::STATUS_PUBLIC,
            'delete_flg' => Logic_nursery::DELETE_FLG_FALSE
        ];

        $results = $this->Logic_nursery->read($where, [
            'nursery_id',
            'name'
        ]);

        if ($results == false) {
            return [];
        }

        $nurseries = [];
        foreach ((array) $results as $key => $value) {
            $nurseries[$value['nursery_id']] = $value;
        }

        return $nurseries;
    }

    /**
     * get all jobs by nursery_id
     *
     * @return array ['job_id', 'title']
     */
    public function getJobs($nursery_id)
    {
        $this->load->model('Logic_job');

        $where = [
            'nursery_id' => $nursery_id,
            'status' => Logic_job::STATUS_PUBLIC,
            'delete_flg' => $this->config->item('not_deleted','common_config')
        ];

        $results = $this->Logic_job->read($where, [
            'job_id',
            'title'
        ]);
        if ($results == false) {
            return [];
        }

        $jobs = [];
        foreach ((array) $results as $key => $value) {
            $jobs[$value['job_id']] = $value;
        }
        return $jobs;
    }

    /**
     * get all jobs by nursery_ids in json
     *
     * @return array json ['nursery_id', 'job_id', 'title']
     */
    public function getAllJobs($nursery_ids)
    {
        $this->load->model('Logic_job');

        $where = sprintf("`nursery_id` in (%s) AND `status` = %d AND `delete_flg`=%d", implode(',', $nursery_ids), Logic_job::STATUS_PUBLIC, $this->config->item('not_deleted','common_config'));

        $results = $this->Logic_job->read($where, [
            'nursery_id',
            'job_id',
            'title'
        ]);

        if ($results == false) {
            return json_encode([]);
        }

        $jobs = [];
        foreach ((array) $results as $key => $value) {
            // $value['province_id'] = $value['pref_id'];
            $nursery_id = $value['nursery_id'];
            unset($value['nursery_id']);
            $jobs[$nursery_id][] = $value;
        }

        $jobs = json_encode($jobs);

        return $jobs;
    }

    /**
     * get all jobs by nursery_id
     *
     * @return array ['province_id', 'pref_id', 'name']
     */
    public function getProvinces()
    {
        $this->load->model('Logic_area');

        $where = "`pref_id` > 0 AND `city_id`=0 AND `delete_flg`=" . $this->config->item('not_deleted','common_config');

        $results = $this->Logic_area->read($where, [
            'pref_id',
            'name'
        ]);

        if ($results == false) {
            return [];
        }

        $provinces = [];
        foreach ((array) $results as $key => $value) {
            $value['province_id'] = $value['pref_id'];
            $provinces[] = $value;
        }

        return $provinces;
    }

    /**
     * get all cities by province
     *
     * @return array ['pref_id','city_id', 'name']
     */
    public function getCities($province_id)
    {
        $this->load->model('Logic_area');

        $where = sprintf("`pref_id` = %d AND `city_id` > 0 AND `delete_flg`=%d", $province_id, Logic_area::DELETE_FLG_FALSE);

        $results = $this->Logic_area->read($where, [
            'pref_id',
            'area_id',
            'city_id',
            'name'
        ]);

        if ($results == false) {
            return [];
        }

        $cities = [];
        foreach ((array) $results as $key => $value) {
            $cities[$value['area_id']] = $value;
        }

        return $cities;
    }

    /**
     * get all cities in json
     *
     * @return array json ['province_id','pref_id','city_id', 'name']
     */
    public function getAllCities()
    {
        $this->load->model('Logic_area');

        $where = sprintf("`city_id` > 0 AND `delete_flg`=%d", Logic_area::DELETE_FLG_FALSE);

        $results = $this->Logic_area->read($where, [
            'pref_id',
            'area_id',
            'city_id',
            'name'
        ]);

        if ($results == false) {
            return json_encode([]);
        }

        $cities = [];
        foreach ((array) $results as $key => $value) {
            // $value['province_id'] = $value['pref_id'];
            $pref_id = $value['pref_id'];
            unset($value['pref_id']);
            $pref_id = $pref_id;
            $cities[$pref_id][] = $value;
        }

        $cities = json_encode($cities);

        return $cities;
    }

    public function getAllEmployTags()
    {
        $this->load->model('Logic_tag');

        $where = sprintf("`tag_group_id` = %d AND `delete_flg`=%d", Logic_tag::TAG_GROUP_ID_EMPLOY, Logic_tag::DELETE_FLG_FALSE);

        $results = $this->Logic_tag->read($where, [
            'tag_group_id',
            'tag_id',
            'name'
        ]);

        if ($results == false) {
            return [];
        }

        $tags = [];
        foreach ((array) $results as $key => $value) {
            $value['employ_tag_id'] = $value['tag_id'];
            $tags[$value['tag_id']] = $value;
        }

        return $tags;
    }

    public function getAllLicenseTags()
    {
        $this->load->model('Logic_tag');

        $where = sprintf("`tag_group_id` = %d AND `delete_flg`=%d", Logic_tag::TAG_GROUP_ID_LICENSE, Logic_tag::DELETE_FLG_FALSE);

        $results = $this->Logic_tag->read($where, [
            'tag_group_id',
            'tag_id',
            'name'
        ]);

        if ($results == false) {
            return [];
        }

        $tags = [];
        foreach ((array) $results as $key => $value) {
            $value['license_tag_id'] = $value['tag_id'];
            $tags[$value['tag_id']] = $value;
        }

        return $tags;
    }

    public function searchUsers($param)
    {
        $this->load->model('Logic_scout');
        $this->load->helper('date');
        $data['users'] = [];
        $data['total'] = 0;

        $data = $this->Logic_scout->searchUsers($param);

        if (empty($data['users'])) {
            return $data;
        }

        $values = [];
        $values['total'] = $data['total'];
        foreach ($data['users'] as $key => $user) {

            $values['users'][$user['user_id']] = $this->parseUserInfo($user);
        }

        return $values;
    }

    /**
     * Support for view info
     */
    protected function parseUserInfo($user)
    {
	$this->load->model('Service_area');

        $user['age'] = getAge($user['birthdate']);
        $user['license_tags'] = $this->getAllLicenseTagsByUser($user['user_id']);
        $user['employ_tags'] = $this->getAllEmployTagsByUser($user['user_id']);
	$user['address'] = $this->Service_area->get_area_name($user['area_id']);
        return $user;
    }

    protected function getAllLicenseTagsByUser($user_id)
    {
        $this->load->model('Logic_scout');
        $tags = $this->Logic_scout->getAllLicenseTagsByUser($user_id, 'name');

        if ($tags == false) {
            return '';
        }

        $license_tags = [];
        foreach ($tags as $key => $tag) {
            $license_tags[] = $tag['name'];
        }

        return implode(', ', $license_tags);
    }

    protected function getAllEmployTagsByUser($user_id)
    {
        $this->load->model('Logic_scout');
        $tags = $this->Logic_scout->getAllEmployTagsByUser($user_id, 'name');

        if ($tags == false) {
            return '';
        }

        $employ_tags = [];
        foreach ($tags as $key => $tag) {
            $employ_tags[] = $tag['name'];
        }

        return implode(', ', $employ_tags);
    }


    // BEGIN CONFIRM SCOUT
    public function getTemplates($client_id)
    {
        $this->load->model('Logic_template');
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $param['client_id'] = $client_id;
        $param['select'] = [
            'template_id',
            'title'
        ];

        $templates = $this->Logic_template->get_list($param);
        if ($templates == false) {
            return [];
        }
        return $templates;
    }

    /**
     * get template details
     */
    public function getTemplateDetails($template_id, $client_id)
    {
        $this->load->model('Logic_template');
        $param['select'] = array(
            'template_id',
            'title',
            'content'
        );
        $param['delete_flg'] = $this->config->item('not_deleted','common_config');
        $param['client_id'] = $client_id;
        $param['template_id'] = $template_id;
        $template = $this->Logic_template->get_detail($param);
        if ($template == false) {
            return false;
        }
        $template = array_shift($template);
        return $template;
    }

    /**
     * Get Job Title
     */
    public function getJobTitle($job_id)
    {
        $this->load->model('Logic_job');
        $result = $this->Logic_job->read([
            'job_id' => $job_id,
            'delete_flg' => $this->config->item('not_deleted','common_config'),
            'status' => Logic_job::STATUS_PUBLIC
        ], 'title');
        if ($result == false) {
            return false;
        }
        $job = array_shift($result);
        $job['job_id'] = $job_id;
        return $job;
    }

    /**
     * Get user names to send email for scout
     */
    public function getUsers($user_ids)
    {
        $this->load->model('Logic_scout');
        $users = $this->Logic_scout->getUsers($user_ids);

        return $users;
    }

    public function getUserJobDetailUrl($job_id)
    {
        $base_url = $this->config->config["base_url"];
        $jobDetailsUrl = $base_url . 'user/job/detail/' . $job_id;
        return $jobDetailsUrl;
    }

    /**
     * Parse Content with job title, job url, user name
     *
     * @return email ['to', 'subject', 'message'], scout ['user_id', 'job_id', 'template_id' ]
     */
    public function parseContent($job, $user, $template)
    {
        $data['email'] = [
            'to' => $user['mail'],
            'subject' => $template['title'],
            'message' => $this->parseEmailContent($job['title'], $job['job_id'], $user['name'], $template['content'])
        ];

        $data['scout'] = [
            'user_id' => $user['user_id'],
            'job_id' => $job['job_id'],
            'template_id' => $template['template_id'],
            'created' => date('Y-m-d H:i:s')
        ];
        return $data;
    }

    public function create($data,$client_id = false)
    {
      if(empty($client_id)){
        return false;
      }
        $this->load->model('Service_plan');
        $use_plan = $this->Service_plan->using_cpgr($client_id);
        if($use_plan === false){
            return false;
        }
        $data['cpgr_id'] = $use_plan;
        $this->load->model('Logic_scout');
        $result = $this->Logic_scout->create($data);
        return $result;
    }

    // END SEARCH USER & CONFIRM SCOUT

    /*
     * BEGIN HISTOTY
     */
    public function parseEmailContent($jobTitle, $jobId, $userName, $templateContent, $includeLink = false)
    {
        $jobDetailsUrl = $this->getUserJobDetailUrl($jobId);
        if ($includeLink) {
            // $jobTitle = sprintf('<a href="%s">%s</a>', $jobDetailsUrl, $jobTitle);
            $jobDetailsUrl = sprintf('<a href="%s">%s</a>', $jobDetailsUrl, $jobDetailsUrl);
        }
        $content = str_replace([
            '{求人票タイトル}',
            '{求人票URL}',
            '{送り先名}'
        ], [
            $jobTitle,
            $jobDetailsUrl,
            $userName
        ], $templateContent);

        return $content;
    }

    public function parseEmailTemplateContent($jobTitle, $jobId, $templateContent, $includeLink = false)
    {
        $jobDetailsUrl = $this->getUserJobDetailUrl($jobId);
        if ($includeLink) {
            // $jobTitle = sprintf('<a href="%s">%s</a>', $jobDetailsUrl, $jobTitle);
            $jobDetailsUrl = sprintf('<a href="%s">%s</a>', $jobDetailsUrl, $jobDetailsUrl);
        }
        $content = str_replace([
            '{求人票タイトル}',
            '{求人票URL}',

        ], [
            $jobTitle,
            $jobDetailsUrl,
        ], $templateContent);

        return $content;
    }

    public function parseScoutInfo($scout)
    {
        $this->load->helper('date');
        $scout['age'] = getAge($scout['birthdate']);
        $scout['edit_job_url'] = '/client/job/edit/' . $scout['job_id'];
        $scout['edit_nursery_url'] = '/client/nursery/edit/' . $scout['nursery_id'];
        $scout['scout_url'] = '/client/scout/detail/' . $scout['scout_id'];
        return $scout;
    }

    public function getHostories($client_id, $limit = 10, $offset = 0)
    {
        $this->load->model('Logic_scout');

        $data = $this->Logic_scout->getHostories($client_id, $limit, $offset);
        $values = [];
        $values['total'] = $data['total'];
        $values['scouts'] = [];
        foreach ($data['scouts'] as $key => $scout) {
            $scout = $this->parseScoutInfo($scout);
            $values['scouts'][$scout['scout_id']] = $scout;
        }

        return $values;
    }

    public function getScoutDetails($client_id, $scout_id)
    {
        $this->load->model('Logic_scout');
        $scout = $this->Logic_scout->getScoutDetails($client_id, $scout_id);
        if ($scout == false) {
            return false;
        }
        $scout['template_content'] = $this->parseEmailTemplateContent($scout['job_title'] , $scout['job_id'] ,  $scout['template_content'] , true);
        $scout['template_content'] = str_replace("\n", '<br/>', $scout['template_content']);
        $scout = $this->parseScoutInfo($scout);

        return $scout;
    }

    /*
     * END HISTOTY
     */

    // BEGIN TEMPLATE LIST
    /*
     * 1. list all template
     * 2. delete template
     * 3. duplicate template
     */

    public function getTemplateList($client_id, $limit, $offset, $contentLength =60){
        $this->load->model('Logic_scout');

        $data = $this->Logic_scout->getTemplateList($client_id, $limit, $offset);

        $values = [];
        $values['total'] = $data['total'];
        $values['templates'] = [];
        foreach ($data['templates'] as $key => $template) {
            $values['templates'][$template['template_id']] = $this->parseTemplateInfo($template, $contentLength);
        }

        return $values;
    }

    public function parseTemplateInfo($template, $contentLength =60){
        $this->load->helper('string');
        $template['content'] = str_replace("\n", '', $template['content']);
        $template['content'] = shortenString($template['content']);

        $template['edit_url'] = '/client/scout/confirm_template/' . $template['template_id'];
        $created = strtotime( $template['created']);
        $template['created'] = sprintf('%s</br>%s', date('Y/m/d', $created), date('H:i:s', $created));
        return $template;
    }
    /**
     * delete template
     *
     * @return boolean
     */
    public function deleteTemplate($client_id, $template_id)
    {
        $this->load->model('Logic_template');
        $data['client_id'] = $client_id;
        $data['template_id'] = $template_id;
        $data['updated'] = date('Y-m-d H:i:s');
        $data['delete_flg'] = (int) Logic_template::DELETE_FLG;

        return (bool) $this->Logic_template->delete($data);
    }

    /**
     * 3.
     * duplicate template
     *
     * @return false/int template id
     */
    public function duplicateTemplate($client_id, $template_id)
    {
        $this->load->model('Logic_template');

        $param['select'] = array(
            'template_id',
            'title',
            'content'
        );
        $param['template_id'] = $template_id;
        $param['delete_flg'] = (int) $this->config->item('not_deleted','common_config');
        $template = $this->Logic_template->get_detail($param);
        if($template == false){
            return false;
        }
        $template = array_shift($template);
        //remove old id
        unset( $template['template_id']);
        $template['updated'] = date('Y-m-d H:i:s');
        $template['created'] = date('Y-m-d H:i:s');
        $template['delete_flg'] = (int) $this->config->item('not_deleted','common_config');
        $template['client_id'] = $client_id;
        //title is copy
        $template['title'] .= 'のコピー';


        $template_id = $this->Logic_template->insert($template);
        return $template_id;
    }

    // END TEMPLATE LIST
    public function get_list($client_id = null)
    {
        if (is_null($client_id)) {
            return false;
        }
        $param['select'] = array(
            'template_id',
            'title',
            'content',
            'created'
        );
        $param['delete_flg'] = $this->config->item('not_deleted', 'common_config');
        $param['client_id'] = $client_id;
        $result = $this->Logic_template->get_list($param); 
        if (! empty($result[0])) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_detail($template_id)
    {
        if (is_null($template_id)) {
            return false;
        }
        $param['select'] = array(
            'template_id',
            'title',
            'content'
        );
        $param['delete_flg'] = $this->config->item('not_deleted', 'common_config');
        $param['template_id'] = $template_id;

        $result = $this->Logic_template->get_detail($param);
        if (! is_null($result[0])) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function get_detail_html($template_id)
    {
        if (is_null($template_id)) {
            return false;
        }
        $param['select'] = array(
            'template_id',
            'title',
            'content'
        );
        $param['delete_flg'] = $this->config->item('not_deleted', 'common_config');
        $param['template_id'] = $template_id;
        $result = $this->Logic_template->get_detail($param);
        if (! is_null($result[0])) {
            $result[0]['content'] = $this->_convert_str_to_html($result[0]['content']);
            return $result[0];
        } else {
            return false;
        }
    }

    public function insert($param)
    {
        $this->load->model('Logic_template');
        $content = $param['content'];
        $param['title'] = strip_tags($param['title']);
        $param['content'] = $this->_convert_html_to_str($content);
        $now = new DateTime('NOW');
        $param['created'] = $now->format('Y-m-d H:i:s');
        $param['updated'] = $now->format('Y-m-d H:i:s');
        $param['title'] = htmlentities($param['title']);
        $param['content'] = htmlentities($param['content']);
        $param['delete_flg'] = $this->config->item('not_deleted', 'common_config');
        $result = $this->Logic_template->insert($param);
        return $result;
    }

    public function update($param)
    {
        $param['title'] = strip_tags($param['title']);
        $content = $param['content'];
        $param['content'] = $this->_convert_html_to_str($content);
        $now = new DateTime('NOW');
        $param['updated'] = $now->format('Y-m-d H:i:s');
        $result = $this->Logic_template->update($param);
        return $result;
    }

    public function delete($param)
    {
        $now = new DateTime('NOW');
        $param['updated'] = $now->format('Y-m-d H:i:s');
        $result = $this->Logic_template->delete($param);
        $param['delete_flg'] = $this->config->item('deleted', 'common_config');
        return $result;
    }

    /**
     * this function is to parse html tag into correct word tag like {xxxx}
     * and if included br tag, execute nl2br
     * and if other html contains, remove from it.
     *
     * @param [type] $array
     *            [description]
     * @return [type] [description]
     */
    private function _convert_data($data)
    {
        $result['title'] = $this->_convert_str_to_html($data['title']);
        $result['content'] = $this->_convert_str_to_html($data['content']);
        return $result;
    }

    private function _convert_html($str)
    {

        // preg_match('/src=["\']?([^"\' ]*?)?([^\/"\' ]+)\.([^\.\/"\' >]+)/i',$str,$result);
        // $patterns[0] = '/<img.*alt=\"\{送り先名\}\".*toname\.png\"\s\/>/';
        // $patterns[1] = '/<img.*alt=\"\{求人票タイトル\}\".*jtitle\.png\"\s\/>/';
        // $patterns[2] = '/<img.*alt=\"\{求人票URL\}\".*jurl\.png\"\s\/>/';
        // $patterns[0] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票タイトル}" src=" http://local.fine.me/static/common/library/ckeditor/jtitle.png" />';

        // echo('<pre>[string]');
        // var_dump($str);
        // $patterns = "/<img(.+?)toname\.png\"\s\/>/i";
        // $replacements = "<送り先名>";
        // $result_1 = preg_replace($patterns, $replacements, $str);
        // echo("<br>[result_1]");
        // var_dump($result_1);
        // echo("<br>[pattern_1]");
        // var_dump($patterns);
        // echo("<br>[replace_1]");
        // var_dump($replacements);
        // $replacements = "<求人票タイトル>";
        // $patterns = '/<img(.+?)jtitle\.png\"\s\/>/i';
        // $result_2 = preg_replace($patterns, $replacements, $result_1);
        // echo("<br>[result2]");
        // var_dump($result_2);
        // echo("<br>[pattern_2]");
        // var_dump($patterns);
        // echo("<br>[replace_2]");
        // var_dump($replacements);
        // $replacements = "<求人票URL>";
        // $patterns = '/<img(.+?)jurl\.png\"\s\/>/i';
        // $result_3 = preg_replace($patterns, $replacements, $result_2);
        // echo("<br>[result3]");
        // var_dump($result_3);
        // echo("<br>[pattern_3]");
        // var_dump($patterns);
        // echo("<br>[replace_3]");
        // var_dump($replacements);
        //
        $str_decoded = html_entity_decode($str, ENT_HTML5);
        echo ('<pre>');
        echo ('<br>[raw]');
        var_dump($str);
        echo ('<br>[decoded]');
        var_dump($str_decoded);
        echo ('<br>[ok]');
        $str_s = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{送り先名}" src=" http://local.fine.me/static/common/library/ckeditor/toname.png" />様！！<br /><img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票タイトル}" src=" http://local.fine.me/static/common/library/ckeditor/jtitle.png" />と<img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票URL}" src=" http://local.fine.me/static/common/library/ckeditor/jurl.png" />をよろしくお願いします！！！';

        $str2 = preg_replace("/<img(.+?)toname\.png\"\s\/>/", "<送り先名>", $str_s);
        $str3 = preg_replace("/<img(.+?)jtitle\.png\"\s\/>/", "<求人票タイトル>", $str2);
        $res = preg_replace("/<img(.+?)jurl\.png\"\s\/>/", "<求人票URL>", $str3);
        echo ('<br>[result]');

        // $result_notag = strip_tags($result_1);
        // $result
        // echo("<br>[result]");
        // var_dump($result);
        // echo preg_match('/<img(.+?)toname\.png\"\s\/>/', $str, $match);
        // var_dump($match);
        // echo("<br>[result_notag]");
        // var_dump($result_notag);
        // return $result_notag;
    }


      private function _convert_html_to_str($str){
      //replace image tag
      $this->load->helper('url');
      $patterns = array();
      $patterns[0] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票タイトル}" src=" '.base_url().'static/common/library/ckeditor/jtitle.png">';
      $patterns[1] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票URL}" src=" '.base_url().'static/common/library/ckeditor/jurl.png">';
      $patterns[2] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{送り先名}" src=" '.base_url().'static/common/library/ckeditor/toname.png">';
      $replacements = array();
      $replacements[0] = "求人票タイトル";
      $replacements[1] = "求人票URL";
      $replacements[2] = "送り先名";
      $data = preg_replace($patterns, $replacements, $str);
      // replace br tag
      $data_nobr = preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "\n", $data);
      // replace delimiter
      $pattern_delimiter[0] = '/</';
      $replacement_delimiter[0] = "{";
      $pattern_delimiter[1] = '/\s\/>/';
      $replacement_delimiter[1] = "}";
      $result = preg_replace($pattern_delimiter, $replacement_delimiter, $data_nobr);
      $data_nohtml = strip_tags($result);
      return $data_nohtml;

      }

    private function _convert_str_to_html($str)
    {
        // replace image tag
        $this->load->helper('url');
        $patterns = array();
        $patterns[0] = '/\{求人票タイトル\}/';
        $patterns[1] = '/\{求人票URL\}/';
        $patterns[2] = '/\{送り先名\}/';
        $replacements = array();
        $replacements[0] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票タイトル}" src=" ' . base_url() . 'static/common/library/ckeditor/jtitle.png">';
        $replacements[1] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{求人票URL}" src=" ' . base_url() . 'static/common/library/ckeditor/jurl.png">';
        $replacements[2] = '<img height="32px" width="auto" style="vertical-align:middle;" alt="{送り先名}" src=" ' . base_url() . 'static/common/library/ckeditor/toname.png">';
        $data = preg_replace($patterns, $replacements, $str);
        // replace br tag
        $data_br = nl2br($data);
        return $data_br;
    }

    public function get_sent_count($array){
        if(empty($array)){
            return false;
        }
        $this->load->model('Logic_scout');
        foreach($array as $cpgr_id){
            $result[] = $this->Logic_scout->get_sent_count($cpgr_id);
        }
       if(!empty($result)){
            $num = 0;
            foreach($result as $data){
                $num = $num + $data[0]['sent_count'];
            }
          return $num;
       }else{
          return false;
       }
    }
    public function get_each_sent_count($cpgr_id){
        if(empty($cpgr_id)){
            return 0;
        }

            $result = $this->Logic_scout->get_sent_count($cpgr_id);
       if(!empty($result[0]['sent_count'])){
          return $result[0]['sent_count'];
       }else{
          return 0;
       }
    }

    public function export_file($format)
    {
        $this->load->helper('user');
        $headers = $this->config->item('scouted', 'export_column_config');

        $results = $this->Logic_scout->get_export_data();

         list($export_results,  $license, $employ_type) = $results;
        $employ_types = array();
         $licenses = array();

         foreach ($license as $key => $value) {
             $licenses[$key][$value['scout_id']] = $value['license'];
             $scout_id[] = $value['scout_id'];
         }

         if (!empty($scout_id)) {
             $license = array_map(function($id) use($licenses){
                 return array('scout_id' => $id, 'license' => array_unique(array_column($licenses, (int) $id)));
             }, array_unique($scout_id));
         }

         unset($licenses);
         foreach ($license as $value) {
             $licenses[$value['scout_id']] = implode(' ', $value['license']);
         }

         foreach ($employ_type as $key => $value) {
             $employ_types[$key][$value['scout_id']] = $value['employ_type'];
             $scout_id[] = $value['scout_id'];
         }

         if (!empty($scout_id)) {
             $employ_type = array_map(function($id) use($employ_types){
                 return array('scout_id' => $id, 'employ_type' => array_unique(array_column($employ_types, (int) $id)));
             }, array_unique($scout_id));
         }

         unset($employ_types);
         foreach ($employ_type as $value) {
             $employ_types[$value['scout_id']] = implode(' ', $value['employ_type']);
         }


         foreach ($export_results as &$result) {
            $result['address'] = $result['province'] . $result['city'] . $result['address'];
            $result['employ_type'] = isset($employ_types[$result['scout_id']]) ? $employ_types[$result['scout_id']] : null;
            $result['license'] = isset($licenses[$result['scout_id']]) ? $licenses[$result['scout_id']] : null;
            $result['gender'] = gender_text($result['gender']);
            $result['birthdate'] = date('Y') - date('Y', strtotime($result['birthdate']));
         }
         unset($result);

        $this->load->model('Service_export_file');

        return $this->Service_export_file->export($headers, $export_results, $format);
    }

    public function export_template_file($format)
    {
        $headers = $this->config->item('template', 'export_column_config');

        $export_results = $this->Logic_scout->get_template_export_data();

         foreach ($export_results as &$result) {
            $result['delete_flg'] = delete_text($result['delete_flg']);
         }
         unset($result);

        $this->load->model('Service_export_file');

        return $this->Service_export_file->export($headers, $export_results, $format);
    }

}
