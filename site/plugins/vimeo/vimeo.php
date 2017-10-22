<?php
  
require_once(__DIR__ . DS . 'vimeoConstructor.php');


define('VIMEO_APP_ID', '36837');
define('VIMEO_SECRET', '0f67fa94238a1590a9c69c103ea217097553e173');
define('VIMEO_TOKEN', 'e290b914fb37ec29c027aed686f8d7a8');
define('DEFAULT_DATE_FORMAT', 'F j, Y');

/*
define('VIMEO_APP_ID', '109621');
define('VIMEO_SECRET', 'UCw9I5rN2DNzTpH+LBnoe2aOzJTLXCoaaP6wNITgksu8Vy4qAwCQaPGrPlOcXocRE5ZvbIJliLUZX9sLogO7H/L9+Piufru9mY/PasWHnZI2acE5GnGXy3nljqXRq/y4');
define('VIMEO_TOKEN', 'a24637c07384218e2fd0a3766644c1eb');
define('DEFAULT_DATE_FORMAT', 'F j, Y');
*/

global $VIMEO;
$VIMEO = new Vimeo(VIMEO_APP_ID, VIMEO_SECRET, VIMEO_TOKEN);

function vimeo_data($vimeo_id)
{
  global $VIMEO;
  $query_key = 'vimeo_request_' . md5($vimeo_id);
  
  //$result = wp_cache_get($query_key, 'vimeo');
  //if ($result !== false) return $result;
  
  $request = $VIMEO->request("/videos/" . $vimeo_id);
  $result = $request['body'];
  
  //wp_cache_set($query_key, $result, 'vimeo');
  
  return $result;
}

function video_player($options, $id)
{ 
  $full_bleed = $options['full_bleed'];
  $sounds = $options['sound'];
  $data = $options['data'];
  
  if (!isset($data['pictures'])) {
    return;
  }
  
  $poster = $data['pictures'][0]['link'];
  $ratio = $data['width'] / $data['height'];
  $sources = $data['files'];
  
  
  
  ?>
  <div data-module-init="video" id="video-player-<?= $id ?>" class="video-player <?= $full_bleed ? "full-bleed" : "no-full-bleed" ?>"
      data-play-sound="<?= $sounds ? "true" : "false" ?>">
    <div class="video-positioner"
        data-fit-browser="<?= $full_bleed ? "true" : "false" ?>"
        data-full-bleed="<?= $full_bleed ? "true" : "false" ?>"
        data-poster="<?= $poster ?>"
        data-ratio="<?= $ratio ?>"
        style="background:url(<?= $poster ?>) no-repeat center center cover">
      <video class="video-js" poster="<?= $poster ?>" autoplay muted preload loop>
        <?php foreach ($sources as $source): ?>
          <?php if ($source['quality'] !== 'hls'): ?>
            <source data-src="<?= $source['link'] ?>" type='video/mp4'>
          <?php endif ?>
        <?php endforeach ?>
      </video>
      <img class="for-mobile for-flash-video video-poster" data-src="<?= $poster ?>">
      <div class="for-mobile play-button"></div>
    </div>
  </div>
  
<?php } ?>


