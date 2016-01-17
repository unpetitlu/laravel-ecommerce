<?php

namespace App\Http\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{

  private $consumer_key;

  private $consumer_secret;

  private $access_token;

  private $access_token_secret;

  private $cache;

  public function __construct()
  {
    $this->consumer_key = $_ENV['CONSUMER_KEY'];
    $this->consumer_secret = $_ENV['CONSUMER_SECRET'];
    $this->access_token = $_ENV['ACCESS_TOKEN'];
    $this->access_token_secret = $_ENV['ACCESS_TOKEN_SECRET'];
    $this->cache = storage_path().'/twitter/tweets.tmp';
  }

  public static function autolink($tweet)
  {
    $autolink = \Twitter_Autolink::create();

    return $autolink->autolink($tweet);
  }

  public function getTweets()
  {

    // 1 minute
    if (!file_exists($this->cache) || time() - filemtime($this->cache) > 60)
    {
      $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);

      $tweets = $connection->get("statuses/user_timeline", [
        'screen_name' => 'unpetitlu',
        'exclude_replies' => true,
        'count' => 10
      ]);

      file_put_contents($this->cache, serialize($tweets));

    }
    else
    {
      $tweets = unserialize(file_get_contents($this->cache));
    }

    return $tweets;
    
  }
}
