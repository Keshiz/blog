<?php
$options = Helper::options();
require_once('general.php');
require_once('assetsdir.php');
require_once('codehightlight.php');
require_once('compresshtml.php');
require_once('getversion.php');
require_once('getcheck.php');
require_once('gravatar.php');
require_once('replyview.php');
require_once('spam.php');
require_once('vaptcha.php');
require_once('captcha.php');
require_once('cache.php');
require_once('tongji.php');
require_once('markdown.php');
require_once('checksec.php');
require_once('parse.php');
require_once('extend/UserAgent.class.php');


function billboard($ads,$type){
    $options = Helper::options();
    $str = explode("|",$ads);
    $target = parselink($str[1]);
    if($type == 'sidebar'){
    echo '
    <div class="ui cards"><a class="gray card" '.$target.' href="'.$str[1].'">
    <div class="image">
      <img src="';if(empty($str[0])){ echo AssetsDir().'assets/image/white-image.png'; }else{ echo $str[0];} echo'">
       
    </div>
  </a>
  </div>
    ';
}
if($type == 'other'){
     echo '
    <a href="'.$str[1].'" '.$target.'>
    <div class="image">
      <img style="display: inline-block; width: 100%; max-width: 100%; height: auto;border-radius:10px" src="';echo $str[0].'">
       
    </div>
  </a>

    ';
}
}

function parseMultilineData($str, $columnCount)
    {
        $result = array();
        if (!empty($str)) {
            $data = explode("\n", $str);
            foreach ($data as $item) {
                $item = trim($item);
                if (!empty($item)) {
                    $itemData = explode('|', $item, $columnCount);
                    if (count($itemData) == $columnCount) {
                        foreach ($itemData as $k => $v) {
                            $itemData[$k] = trim($v);
                        }
                        $result[] = $itemData;
                    }
                }
            }
        }
        return $result;
    }

function getMenu()
    {
    $options = Helper::options();
        return parseMultilineData($options->Menu, 2);
    }

function getLink()
    {
    $options = Helper::options();
        return parseMultilineData($options->WebLink, 2);
    }

function sliderget(){
    $options = Helper::options();
    return parseMultilineData($options->SliderPics, 2);
}

function getFriendLink()
    {
    $options = Helper::options();
        return parseMultilineData($options->FriendLink, 3);
    }
    
function getDoubanId($id)
    {
    $options = Helper::options();
    $DoubanId = explode(',',$id);
        return $DoubanId;
    }
    
function getBookTag()
    {
    $options = Helper::options();
    $DoubanTag = explode(',',$options->douban_tag);
        return $DoubanTag;
    }

function getMovieTag()
    {
    $options = Helper::options();
    $DoubanTag = explode(',',$options->douban_movie_tag);
        return $DoubanTag;
    }

function getMusicTag()
    {
    $options = Helper::options();
    $DoubanTag = explode(',',$options->douban_music_tag);
        return $DoubanTag;
    }
    
function curl_func($url){
$ch = curl_init ();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 200);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_NOBODY, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_exec($ch);
$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
return $httpCode;
    }
//????????????????????????

function themeInit($self){
    $file_path = file_get_contents(str_replace('core','',dirname(__FILE__)).'vendors/CheckTool/Http.Code');
    if ($self->hidden){
        if($file_path == '404'){
    $self->response->setStatus(200);
}
header('HTTP/1.1 200 OK');
    }
    $options = Helper::options();
    if ($options->VerifyChoose == '1'){
$comment = spam_protection_prejia($self, $post, $result);
}
else if ($options->VerifyChoose == '11'){
$comment = spam_protection_prejian($self, $post, $result);
}
else{
$comment = spam_protection_prejia($self, $post, $result);
}
$options->commentsOrder = 'DESC';
Helper::options()->commentsAntiSpam = false;
if($options->Pjax == '1'){
Helper::options()->commentsCheckReferer = false;
}
//Helper::options()->commentsMaxNestingLevels = 999;

            
    //Sitemap
         if (Helper::options()->SiteMap && Helper::options()->SiteMap !== 'close') {
        if (strpos($_SERVER['REQUEST_URI'], 'sitemap.xml') !== false) {

if($file_path == '404'){
    $self->response->setStatus(200);
}
        $self->setThemeFile("modules/SiteMap/sitemap.php");
    }
}
         //????????????
 if (strpos($_SERVER['REQUEST_URI'], 'usercenter') !== false) {
         if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("modules/UserCenter/user.php");
        }
        //????????????BearThumb
        if (strpos($_SERVER['REQUEST_URI'], 'bearthumb') !== false) {
          if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("modules/BearThumb/thumb.php");
        }
        //????????????
        if (strpos($_SERVER['REQUEST_URI'], 'getacg') !== false) {
          if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("vendors/Bilibili/getData.php");
        }
        //????????????
        if (strpos($_SERVER['REQUEST_URI'], 'getdouban') !== false) {
          if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("vendors/Douban/getData.php");
        }
        //?????????????????????
        if (strpos($_SERVER['REQUEST_URI'], 'write') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("core/widget/write.php");
        }
                //????????????API
        if (strpos($_SERVER['REQUEST_URI'], 'uploadimages') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("upload/upload_img.php");
        }
        //??????API
        if (strpos($_SERVER['REQUEST_URI'], 'upgrade') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("vendors/Upgrade/Upgrade.php");
        }

     
//??????????????????
        if (strpos($_SERVER['REQUEST_URI'], 'jsonapi/getarticle') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("core/widget/getarticle.php");
        }
//????????????
        if (strpos($_SERVER['REQUEST_URI'], 'commentlike') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("core/widget/commentlike.php");
        }
//????????????
        if (strpos($_SERVER['REQUEST_URI'], 'postlike') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("core/widget/postlike.php");
        }
        
//??????Github??????
        if (strpos($_SERVER['REQUEST_URI'], 'getgithub') !== false) {
if($file_path == '404'){
            $self->response->setStatus(200);
}
            $self->setThemeFile("core/widget/getgithub.php");
        }
        
//?????????-???????????????
$tempStr = str_replace("/index.php","",$_SERVER['REQUEST_URI']);

    $action = substr($tempStr,1,2 );
    if( $action == "go" ){
        if($file_path == '404'){
            $self->response->setStatus(200);
}
        $urlArr = include_once str_replace('core','',dirname(__FILE__)).'modules/url.php';
        $query = trim(substr($tempStr,4),"/");
        
        foreach($urlArr as $key=>$value){$arr[]=$key;}
        if(in_array($query,$arr)){
            header("Location: ".$urlArr[$query]);
        }
        
    }
    
}


function page_fetch(String $type, Array $ids, Int $page = 1, Int $limit = 6 , String $cachetype){
    $options = Helper::options();
    $cache_name = '';
   if($type=='movie'){
        $cache_name = 'movie_';
        $cache_name2 = 'movie_';
    }
    elseif($type=='book'){
       $cache_name = 'book_'; 
       $cache_name2 = 'book_'; 
    }
    elseif($type=='music'){
       $cache_name = 'music_'; 
       $cache_name2 = 'music_'; 
    }
    $cache_dir = __TYPECHO_ROOT_DIR__.__TYPECHO_THEME_DIR__.'/bearsimple/vendors/Douban/';
    if(!is_dir($cache_dir)) @mkdir($cache_dir);
    $cache_dir .= 'cache/';
    if(!is_dir($cache_dir)) @mkdir($cache_dir);
    $neelde = [];
    $offset = ($page - 1) * $limit;
    $end = $offset + $limit;
    $total = count($ids);
    $end > $total && $end = $total;
    $stars = [];
        switch($type){
     case 'movie':
         $rating_ch = $options->douban_movie_rating;
       switch($cachetype){
          case '1':
              $cachetypenr = $options->douban_movie1;
              break;
          case '2':
              $cachetypenr = $options->douban_movie2;
              break;
          case '3':
              $cachetypenr = $options->douban_movie3;
              break;
       }
         break;
     case 'book':
         $rating_ch = $options->douban_rating;
                switch($cachetype){
          case '1':
              $cachetypenr = $options->douban_book1;
              break;
          case '2':
              $cachetypenr = $options->douban_book2;
              break;
          case '3':
              $cachetypenr = $options->douban_book3;
              break;
       }
         break;
     case 'music':
         $rating_ch = $options->douban_music_rating;
                switch($cachetype){
          case '1':
              $cachetypenr = $options->douban_music1;
              break;
          case '2':
              $cachetypenr = $options->douban_music2;
              break;
          case '3':
              $cachetypenr = $options->douban_music3;
              break;
       }
         break;
         default:;
    }
    for($i = $offset; $i < $end; $i++){
        $id = explode('*', $ids[$i]);
        $neelde[] = $id[0];
        if(!empty($id[1])){
            $stars[$id[0]] = $id[1];
        }else{
            $stars[$id[0]] = 0;
        }
    }
    $cache_name .= md5(implode(',', $neelde)) . '.json';
    $cache_name2 .= $cachetype.'.config';
    $cache_file = $cache_dir . $cache_name;
    $cache_file2 = $cache_dir . $cache_name2;
    if(file_exists($cache_file) && filectime($cache_file) + (5 * 24 * 3600) >= time() && $cachetypenr == @file_get_contents($cache_file2)){
        // 5?????????
        $result = json_decode(@file_get_contents($cache_file), true);
    }else{
        unlink($cache_file2);
        switch($type){
            case 'movie':
        foreach($neelde as $k => $v){
            $Getdata = douban_getdata($v, 'movie');
            $result[$v] = [
        	    'url' => $Getdata["url"],
        	    'cover' => $Getdata['cover'],
        	    'title' => $Getdata['moviename'],
        	    'summary' => $Getdata['summary'],
        	    'episode' => $Getdata['episode'],
        	    'duration' => $Getdata['movie_duration'],
        	];
        }
        break;
        case 'book':
         foreach($neelde as $k => $v){
            $Getdata = douban_getdata($v, 'book');
            $result[$v] = [
        	 'url' => $Getdata["url"],
        	 'cover' => $Getdata['cover'],
        	 'title' => $Getdata['bookname'],
        	 'author' => $Getdata['author'],
        	];
        }  
        break;
        case 'music':
         foreach($neelde as $k => $v){
            $Getdata = douban_getdata($v, 'music');
            $result[$v] = [
        	 'url' => $Getdata["url"],
        	 'cover' => $Getdata['cover'],
        	 'title' => $Getdata['musicname'],
        	 'singer' => $Getdata['singer'],
        	];
        }   
        break;
        default:;
        }
        file_put_contents($cache_file, json_encode($result));
        file_put_contents($cache_file2, $cachetypenr);
    }
    $results = [];
    foreach ($result as $k=>$v){
        if(!empty($stars[$k])){
            $result[$k]['rating'] = $stars[$k];
        }else{
            $result[$k]['rating'] = 0;
        }
        $results[] = $result[$k];
    }
    return $results;
}
function douban_getdata($id,$type){
    $options = Helper::options();
    $Apikey = array('apikey'=>'0df993c66c0c636e29ecbb5344252a4a');
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.douban.com/v2/'.$type.'/'.$id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $Apikey);
    $data = curl_exec($curl);
    curl_close($curl);
    $datas = json_decode($data,true);
    $result = [];
    switch($type){
    case 'book':
$result['url'] = $datas['alt'];
    $result['cover'] = $datas['images']['small'];
    $result['bookname'] = $datas['title'];
    $result['author'] = $datas['author'][0];
    break;
    case 'movie':
    $result['url'] = str_replace('/movie/', '/subject/', $datas['alt']);
    $result['cover'] = $datas['image'];
    $result['moviename'] = $datas['title'];
    $result['summary'] = $datas['alt_title'];
    $result['episode'] = !empty($datas['attrs']['episodes'])?(is_array($datas['attrs']['episodes'])?$datas['attrs']['episodes'][0]:$datas['attrs']['episodes']):1;
    // var_dump($datas);exit;
    $result['movie_duration'] = !empty($datas['attrs']['movie_duration'])?$datas['attrs']['movie_duration'][0]:'120';
    break;
    case 'music':
$result['url'] = $datas['alt'];
    $result['cover'] = $datas['image'];
    $result['musicname'] = $datas['title'];
    if(count($datas['attrs']['singer'])>1){
    $result['singer'] = $datas['attrs']['singer'][0].'...???'.count($datas['attrs']['singer']).'???';
    }
    else{
       $result['singer'] = $datas['attrs']['singer'][0];    
    }
    break;
    }
    return $result;
}

function bilibili_getpage(){
    $options = Helper::options();
    $status = json_decode(file_get_contents('https://api.bilibili.com/x/space/bangumi/follow/list?vmid='.$options->bilibili_accountid.'&type=1&follow_status=0&pn=1&ps=15'),true);
    return $status['data']['total'];
}

function bilibili_getlist(){
    $options = Helper::options();
    $status = json_decode(file_get_contents('https://api.bilibili.com/x/space/bangumi/follow/list?vmid='.$options->bilibili_accountid.'&type=1&follow_status=0&pn=1&ps=15'),true);
    return $status['data']['list'];
}

function bilibili_getdata($i){
    $options = Helper::options();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.bilibili.com/x/space/bangumi/follow/list?vmid='.$options->bilibili_accountid.'&type=1&follow_status=0&pn='.$i.'&ps=15');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    $data = curl_exec($curl);
    curl_close($curl);
    $datas = json_decode($data,true);
    return $datas;
}


function cut_str($sourcestr,$cutlength){
$returnstr='';
$i=0;
$n=0;
$str_length=strlen($sourcestr);
while (($n<$cutlength) and ($i<=$str_length))
{
$temp_str=substr($sourcestr,$i,1);
$ascnum=Ord($temp_str);
if ($ascnum>=224)
{
$returnstr=$returnstr.substr($sourcestr,$i,3);
$i=$i+3;
$n++;
}
elseif ($ascnum>=192)
{
$returnstr=$returnstr.substr($sourcestr,$i,2);
$i=$i+2;
$n++;
}
elseif ($ascnum>=65 && $ascnum<=90)
{
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;
$n++;
}
else
{
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;
$n=$n+0.5;
}
}
if ($str_length>$cutlength){
$returnstr = $returnstr."...";
}
return $returnstr;
}

function getCommentHF($coid){
    $parser = new HyperDown();
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')
        ->from('table.comments')
        ->where('coid = ? AND status = ?', $coid, 'approved'));
    if (isset($prow['parent'])){
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('text','author','status')
                ->from('table.comments')
                ->where('coid = ?', $parent));
            $text = '??????'.$arow['author'].'???'.$arow['text'];
            $author = $arow['author'];
            $status = $arow['status'];
            if($author){
                if($status=='approved'){
                    $href   = '<div class="ui list"><div class="item"><i class="quote left icon"></i><div class="content"><div class="description">'.reEmo($parser->makeHtml(cut_str($text, 30)),'reply').'</div></div> </div></div>';
                }else if($status=='waiting'){
                    $href   = '<div class="ui list"><div class="item"><i class="quote left icon"></i><div class="content"><div class="description">?????????????????????...</div></div> </div></div>';
                }
            }
            echo $href;
        } else {
            echo "";
        }
    }
}
/**
 * ?????????????????????
 */

function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    
    $cover = new Typecho_Widget_Helper_Form_Element_Text('cover', null, null, '????????????', '??????????????????????????????');
    $layout->addItem($cover);
    
     $Hot = new Typecho_Widget_Helper_Form_Element_Select('Hot', array('1' => '??????????????????',  '2' => '??????????????????'), '2', '????????????????????????', '???????????????,??????????????????????????????????????????');
    $layout->addItem($Hot->multiMode());
    
    $copyright = new Typecho_Widget_Helper_Form_Element_Select('copyright', array('1' => '??????????????????',  '2' => '??????????????????'), '2', '??????????????????????????????', '????????????????????????????????????????????????');
    $layout->addItem($copyright->multiMode());
    
    $copyright_cc = new Typecho_Widget_Helper_Form_Element_Select('copyright_cc', array(
                        'zero' => '?????????',
                        'one' => '?????????????????? 4.0 ??????????????????',
                        'two' => '??????????????????-?????????????????? 4.0 ??????????????????',
                        'three' => '??????????????????-???????????? 4.0 ??????????????????',
                        'four' => '??????????????????-??????????????????-???????????? 4.0 ??????????????????',
                        'five' => '??????????????????-?????????????????? 4.0 ??????????????????',
                        'six' => '??????????????????-??????????????????-?????????????????? 4.0 ??????????????????',
                    ), 'one', '??????????????????', '????????????????????????????????????????????????????????????????????????????????????????????????');
    $layout->addItem($copyright_cc->multiMode());
    
    $tags = new Typecho_Widget_Helper_Form_Element_Select('tags', array('1' => '??????????????????',  '2' => '??????????????????'), '2', '????????????????????????', '???????????????????????????????????????????????????????????????????????????????????????????????????');
    $layout->addItem($tags->multiMode());
    
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('excerpt', null, null, '????????????', '??????????????????????????????????????????????????????');
    $layout->addItem($excerpt);
    $articleplo = new Typecho_Widget_Helper_Form_Element_Select('articleplo', array('1' => '??????????????????',  '2' => '???????????????????????????',  '3' => '??????????????????????????????',  '4' => '??????????????????????????????'), '1', '????????????????????????', '????????????????????????????????????????????????????????????????????????');
    $layout->addItem($articleplo->multiMode());
    $articleplonr = new Typecho_Widget_Helper_Form_Element_Textarea('articleplonr', null, null, '??????????????????', '????????????????????????????????????????????????????????????????????????????????????????????????');
    $layout->addItem($articleplonr);
    
    $Overdue = new Typecho_Widget_Helper_Form_Element_Select(
        'Overdue',
        array(
            'close' => '??????',
            '30' => '??????30???',
            '60' => '??????60???',
            '90' => '??????90???',
            '120' => '??????120???',
            '180' => '??????180???'
        ),
        'off',
        '?????????????????????????????????',
        '????????????????????????????????????????????????????????????????????????????????????'
    );
    $layout->addItem($Overdue->multiMode());
    
    $Poster = new Typecho_Widget_Helper_Form_Element_Select('Poster', array('1' => '?????????????????????',  '2' => '?????????????????????'), '2', '???????????????????????????', '????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????');
    $layout->addItem($Poster->multiMode());
    
}


