<?php 
require_once 'include.php';

$helper = $fb->getRedirectLoginHelper();
if(isset($_GET['state']))
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

/*// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());*/

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
/*echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);*/

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($app); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  /*echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());*/
}

$_SESSION['fb_access_token'] = (string) $accessToken;
//require_once 'fb-callback.php';
require_once 'usernew.php';
$fb->setDefaultAccessToken($accessToken);
$details = $fb->request('GET','/me?fields=first_name,last_name,email,link,gender,locale,picture' );
$posts = $fb->request('GET','/me/posts?since=1505340000&limit=100&fields=id,parent_id,privacy,shares,created_time');
$batch_array = [
'posts'=>$posts,
'details'=> $details
];

try {
  $responses = $fb->sendBatchRequest($batch_array);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
foreach ($responses as $key => $response) {
  if ($response->isError()) {
    $e = $response->getThrownException();
    echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
    echo '<p>Graph Said: ' . "\n\n";
    var_dump($e->getResponse());
  } else {
    
    if ($key == 'posts') {
        $count_track_id = [];
        $postEdge = $response->getGraphEdge();
        $res = [];
do {
    $res = $postEdge->asArray(); 
      foreach ($res as $key => $value) {
          if(isset($value['parent_id'] )   && strpos($value['parent_id'],'167083346649085')===0 && $value['privacy']['value'] == 'EVERYONE' ){
            $fb_post = $fb->sendRequest('GET','/'.$value['parent_id'].'?fields=id,created_time');
            $fb_post_body = $fb_post->getDecodedBody();
            $user_date = $value['created_time'];
            $post_date = new DateTime($fb_post_body['created_time']);
            $interval = $post_date->diff($user_date);
            $points_tmp = 0;
            if (!isset($count_track_id[$value['parent_id']]) && $interval->y == 0 && $interval->m ==0 ) {
              $days = $interval->d;
              switch ($days) {
                case 0:
                  $points_tmp = 100;
                  break;
                case 1:
                   $points_tmp = 80;
                  break;
                case 2:
                  $points_tmp = 60;
                  break;
                default:
                  $points_tmp =20;
                  break;
              }
              $fb_likes = $fb->sendRequest('GET','/'.$value['id'].'/likes?summary=1');
              $fb_likes_body = $fb_likes->getDecodedBody();
              if (isset($fb_likes_body['summary']['total_count']))
                $post_like = $fb_likes_body['summary']['total_count'];
              else
                $post_like = 0;
              if (isset($value['shares']['count']))
                $frnd_share = $value['shares']['count'];
              else 
                $frnd_share = 0;
              $count_track_id[$value['parent_id']] = [
                'post_id'=>$value['id'],
                'share_point'=>$points_tmp,
                'post_like'=>$post_like,
                'frnd_share'=>$frnd_share
              ];
            
          }
        } 
      }
      
      
    }while ( $postEdge = $fb->next($postEdge));
      $_SESSION['count_track_id'] = $count_track_id;

    }
    if ( $key=='details') {
            $res = $response->getDecodedBody();
            $test = $res;
            $test['picture'] = $res['picture']['data']['url'];
             $obj->data($test);
        }
}
}
?>
