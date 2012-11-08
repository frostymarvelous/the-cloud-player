<?php
require 'lib/Slim/Slim.php';
require "lib/classes/user.php";
	
define('DEVELOPMENT', 0);
define('PRODUCTION', 1);	

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => DEVELOPMENT,
));

// Only invoked if mode is "development"
$app->configureMode(DEVELOPMENT, function () use ($app) {
    $app->config(array(
        'debug' => true,
    ));
	define('ENVIRONMENT', DEVELOPMENT);
});

// Only invoked if mode is "production"
$app->configureMode(PRODUCTION, function () use ($app) {
	define('ENVIRONMENT', PRODUCTION);
});

// GET index
$app->get('/', function () {
	$User = new User;
	
	$title = 'The Player';
	$rand_id = rand();
	$google_tracker_id = '';
	
	
    require 'player.php';
});

$app->get('/tracks', function () {
	
	$track = new StdClass;
	$track->title = 'title';
	$track->description = 'description';
	$track->duration = 53;
	$track->bpm = 114;
	$track->genre = 'hip-hop';
	$track->stream_url = 'file.mp3';
	$track->permalink_url = 'download';
	$track->artwork_url = 'artwork';
	//$track->waveform_url = 'waveform';
	$track->user = new StdClass;
	$track->user->username = 'username';
	$track->user->uri = 'artist/username';
	
	$tracks = array($track, $track, $track);
	
	echo json_encode($tracks);
	
});

$app->get('/artist/:username', function ($username) {
	
	$user = new StdClass;
	$user->username = $username;
	$user->city = 'Accra';
	$user->country = 'Ghana';
	$user->description = 'This is an Artiste';
	$user->avatar_url = 'avatar';
	$user->permalink_url = 'permalink';
	
	echo json_encode($user);	
});

$app->get('/playlists', function () {
	
	$hottest = new StdClass;
    $hottest->is_owner = true;
    $hottest->playlist = new StdClass;
    $hottest->playlist->id = 'hottest';
    $hottest->playlist->name = 'Hot Tracks';
    $hottest->playlist->smart = true;
    $hottest->playlist->version = 0;
    $hottest->playlist->smart_filter = new StdClass;
    $hottest->playlist->smart_filter->order = 'hotness';

	$indie = new StdClass;
    $indie->is_owner = true;
    $indie->playlist = new StdClass;
    $indie->playlist->id = 'indie';
    $indie->playlist->name = 'Indie';
    $indie->playlist->smart = true;
    $indie->playlist->version = 0;
    $indie->playlist->smart_filter = new StdClass;
    $indie->playlist->smart_filter->order = 'hotness';
    $indie->playlist->smart_filter->genres = 'indie';
	  
	echo json_encode(array($hottest, $indie));	
});

//run the app
$app->run();
