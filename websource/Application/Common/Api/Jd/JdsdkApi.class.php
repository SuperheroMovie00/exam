<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/27 0027
 * Time: 下午 3:55
 */
namespace Common\Api\Jd;

//京东系统错误码




class JdsdkApi {

    const CSRF_TOKEN = 1;
    const CSRF_AUTHORIZE = 2;
    protected $authorizeUrl = 'https://oauth.jd.com/oauth/authorize';
    protected $tokenUrl = 'https://oauth.jd.com/oauth/token';
    protected $gatewayUrl='https://api.jd.com/routerjson';
    protected $apiVersion='2.0';
    public $appKey;
    public $secretKey;
    public $redirectUri = "http://www.erp.com/index.php/Api/index/jd_login_back";


    public function __construct($params){
        $this->appkey=$params['app_key'];
        $this->secretKey=$params['app_secret'];
    }



    /**
     * 授权登录
     **/

    public function login($state) {
        $url = $this->getAuthorizeUrl($state);
        header("location:" . $url);
    }

    public function getAuthorizeUrl($state){
        $redirectUri = $this->redirectUri;
        $param['response_type'] = 'code';
        $param['client_id'] = $this->appkey;
        $param['redirect_uri'] = $redirectUri;
        $param['state'] = $state;
        $param['scope'] = 'read';
        return $this->authorizeUrl . '?' . http_build_query($param);
    }

    public function fetchAccessToken($code, $redirectUri = null,$state){
        $redirectUri || $redirectUri = $this->redirectUri;
        $param = array(
            'grant_type' => 'authorization_code',
            'client_id' => $this->appkey,
            'client_secret' => $this->secretKey,
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'scope' => 'read',
            'state' => $state,
        );
    ;
        $json = $this->curl($this->tokenUrl, $param);

        $json = iconv('gbk', 'utf-8', $json);
        $json = json_decode($json);
        if (isset($json->code) && isset($json->error_description)) {
            throw new \Exception($json->error_description, intval($json->code));
        }
        return $json;
    }


    //curl请求
    public function curl($url, $postFields = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // https 请求
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields)) {
            curl_setopt($ch, CURLOPT_POST, true);
            $postMultipart = false;
            foreach ($postFields as $k => $v) {
                if ('@' == substr($v, 0, 1)) {
                    $postMultipart = true;
                    break;
                }
            }
            unset($k, $v);
            if ($postMultipart) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
            }
        }
        $reponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch), 0);
        } else {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new \Exception($reponse, $httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }

}