public function backlink_action()
{
global $argv;
if (empty($argv[4])) {
print "Missing param site name! \n";
die;
}

//        $site = $argv[4];
$user = $argv[4];
$pass = $argv[5];
if (!AccessService::isLogin('https://www.jobbkk.com/employer/dashboard', ".//*[@id='login_status']/a[2]/b")) {
print "accessing to login page \n";
$response = AccessService::requestPage('https://www.jobbkk.com/login/employer/dologin',
[
'username_emp' => $user,
'password_emp' => $pass,
'remember_emp' => 1
], 'POST');
// print $response;
}

if(!AccessService::isLogin('https://www.jobbkk.com/employer/dashboard', ".//*[@id='login_status']/a[2]/b")) {
print "you need login \n";
}
// $link = urlencode('https://moz.com/researchtools/ose/api/links?site=' . $site . '&no_redirects=0&filter=&source=external&target=page&group=0&page=1&sort=page_authority&anchor_id=&anchor_type=&anchor_text=&from_site=&level=free&last_update=1450130277');
$overview_api = 'https://www.jobbkk.com/jobs/lists';
print "accessing to get data \n";
$response = AccessService::requestPage($overview_api);
print Logging::storeLogFile($response, 'reponse-data.log');
print "get data done \n";
$crawler = new Symfony\Component\DomCrawler\Crawler();
$crawler->addContent($response);
$data = $crawler->filterXPath(".//*[@id='box_left1']/div[@class='box_hilight']")
->each(function (Symfony\Component\DomCrawler\Crawler $node, $i) {
$node->addContent($node->html());
return [$node->filterXPath('//div/div[2]/h6/a/b')->text(), $node->filterXPath('//div/div[2]/p[2]/span')->text()];
});
//        $data = json_decode($response);
print_r($data);

}




<?php

class AccessService
{


    /**
     * This is  function check login status
     * @param $url | URL to check
     * @param $xpath | XPATH detect is login
     * @author ThieuLQ
     * @return bool
     */
    public static function isLogin($url, $xpath)
    {

        try {

            $response = self::requestPage($url);

            $crawler = new Symfony\Component\DomCrawler\Crawler();
            $crawler->addContent($response);


        } catch (Exception $ex) {

            print $ex->getMessage() . "\n";
            die;
        }


        return $crawler->filterXPath($xpath)->count() ? true : false;

    }

    /**
     * REQUEST page by CURL
     * @param            $url
     * @param array      $param
     * @param bool|false $headers
     * @author ThieuLQ
     * @return mixed
     */
    public static function requestPage($url, $param = [], $method = 'GET', $headers = false)
    {
        try {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            if (is_array($param) && count($param)) {
                $str_param = http_build_query($param);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $str_param);
            }

            if ($headers === false) {
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_USERAGENT, self::agentListRandom());

            } else {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

            if ($method == 'POST') {
                curl_setopt($ch, CURLOPT_POST, 1);
            }

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_COOKIEFILE, LOG_DIR . 'olive_batch_cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, LOG_DIR . 'olive_batch_cookie.txt');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

            $page = curl_exec($ch);

            return $page;
        } catch (Exception $ex) {
            print $ex->getMessage() . "\n";
            die;
        }

    }

    /**
     * Return random header-agent
     * @author ThieuLQ
     * @return mixed
     */
    public static function agentListRandom()
    {
        $header_rand = [
            "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30618; Lunascape 4.7.3)",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; MAGW; .NET4.0C; Lunascape 6.5.8.24780)",
            "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.63 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36",
            "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)",
            "Mozilla/5.0 (Macintosh; U; Intel Mac OS X; ja-jp) AppleWebKit/418 (KHTML, like Gecko) Safari/417.9.3",
            "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; ja-JP-mac; rv:1.8) Gecko/20051111 Firefox/1.5",
            "Mozilla/5.0 (X11; U; Linux i686; ja; rv:1.8.0.4) Gecko/20060508 Firefox/1.5.0.4",
            "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0; Trident/5.0)",
            "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; ARM; Trident/6.0)",
            "Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko",
            "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.224 Safari/534.10 ChromePlus/1.5.2.0",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.220 Safari/535.1",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.106 Safari/535.2",
            "Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.2 (KHTML, like Gecko) Ubuntu/10.04 Chromium/15.0.874.106 Chrome/15.0.874.106 Safari/535.2",
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/536.5 (KHTML, like Gecko) Iron/19.0.1100.0 Chrome/19.0.1100.0 Safari/536.5",
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.46 Safari/536.5 Nichrome/self/19",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1300.0 Iron/23.0.1300.0 Safari/537.11",
            "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17",
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.97 Safari/537.22",
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_3) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31",
            "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36",
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36 Sleipnir/4.1.4",
            "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0",
            "Mozilla/5.0 (Windows; U; Windows NT 5.0; de-DE; rv:1.7.5) Gecko/20041122 Firefox/1.0",
            "Mozilla/5.0 (Windows; U; Windows NT 5.0; fr-FR; rv:1.7.5) Gecko/20041108 Firefox/1.0"

        ];

        $random_array = array_rand($header_rand);

        return $header_rand[$random_array];
    }
}