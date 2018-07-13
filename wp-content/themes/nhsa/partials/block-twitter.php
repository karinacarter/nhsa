<?php /*TODO: Make this an actual Twitter Feed */
    $screen_name = 'NatlAssembly';

 ?>
<div class="block-twitter">
<div class="">
   <img alt="Twitter Logo" class="twitter-logo" src ="/wp-content/themes/nhsa/images/social-icons/twitter-logo.png">@<?=$screen_name; ?>
</div>
    <div class="slides">

    <?php

$count = 20; // How many tweets to output
$retweets = 0; // 0 to exclude, 1 to include

// Populate these with the keys/tokens you just obtained
$oauthAccessToken = '58818632-jiaANxJ7yH1cDSltK4vH9R6XwLzLPYzo7tz5CDQ46';
$oauthAccessTokenSecret = 'emK7FCsivBSK1P8nYw34kevfKYz2OpnezcTQ3OcYbbzDb';
$oauthConsumerKey = 'wIGv9Tp4mlQ485vtwC8XMWIBQ';
$oauthConsumerSecret = '21ZdIu041ZAA6BCC0O5FrLbGDDxqhJgJqGavMZOqEiL3kkFJIW';

// First we populate an array with the parameters needed by the API
$oauth = array(
    'count' => $count,
    'include_rts' => $retweets,
    'oauth_consumer_key' => $oauthConsumerKey,
    'oauth_nonce' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => time(),
    'oauth_token' => $oauthAccessToken,
    'oauth_version' => '1.0'
);

$arr = array();
foreach($oauth as $key => $val)
    $arr[] = $key.'='.rawurlencode($val);

// Then we create an encypted hash of these values to prove to the API that they weren't tampered with during transfer
$oauth['oauth_signature'] = base64_encode(hash_hmac('sha1', 'GET&'.rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json').'&'.rawurlencode(implode('&', $arr)), rawurlencode($oauthConsumerSecret).'&'.rawurlencode($oauthAccessTokenSecret), true));

$arr = array();
foreach($oauth as $key => $val)
    $arr[] = $key.'="'.rawurlencode($val).'"';

// Next we use Curl to access the API, passing our parameters and the security hash within the call
$tweets = curl_init();
curl_setopt_array($tweets, array(
    CURLOPT_HTTPHEADER => array('Authorization: OAuth '.implode(', ', $arr), 'Expect:'),
    CURLOPT_HEADER => false,
    CURLOPT_URL => 'https://api.twitter.com/1.1/statuses/user_timeline.json?count='.$count.'&include_rts='.$retweets,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
));
$json = curl_exec($tweets);
curl_close($tweets);

// $json now contains the response from the Twitter API, which should include however many tweets we asked for.

// Loop through them for output
?>

<?php
if(isset($json)){
foreach(json_decode($json) as $status) {
    // Convert links back into actual links, otherwise they're just output as text
    $enhancedStatus = htmlentities($status->text, ENT_QUOTES, 'UTF-8');
    $enhancedStatus = preg_replace('/http:\/\/t.co\/([a-zA-Z0-9]+)/i', '<a href="http://t.co/$1" target="_blank">http://$1</a>', $enhancedStatus);
    $enhancedStatus = preg_replace('/https:\/\/t.co\/([a-zA-Z0-9]+)/i', '<a href="https://t.co/$1" target="_blank">http://$1</a>', $enhancedStatus);

    ?>
    <div class="slide"><?=$enhancedStatus; ?></div>
    <?php
}

?>
    </div>
        <div class="follow"><a href="https://twitter.com/NatlAssembly" target="_blank" class="btn">Follow Us</a></div>



    </div>

<?php } ?>