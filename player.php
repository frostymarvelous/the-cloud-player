<!--
  Copyright (c) 2008 Henrik Berggren & Eric Wahlforss

  Permission is hereby granted, free of charge, to any person obtaining
  a copy of this software and associated documentation files (the
  "Software"), to deal in the Software without restriction, including
  without limitation the rights to use, copy, modify, merge, publish,
  distribute, sublicense, and/or sell copies of the Software, and to
  permit persons to whom the Software is furnished to do so, subject to
  the following conditions:

  The above copyright notice and this permission notice shall be
  included in all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  	<title><?php echo $title ?></title>
  	<meta name="generator" content="TextMate http://macromates.com/"/>
  	<meta name="author" content="Eric Wahlforss"/>
    <link href="stylesheets/player.css" media="screen" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/firebugx.js"></script>
    <script src="scripts/jquery-1.3.1.min.js" type="text/javascript"></script>
    <script src="scripts/soundmanager2.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/md5.js"></script>
    <script type="text/javascript" src="scripts/ui.core.js?v=<?php echo $rand_id ?>"></script>
    <script type="text/javascript" src="scripts/ui.datepicker.js?v=<?php echo $rand_id ?>"></script>
    <script type="text/javascript" src="scripts/ui.draggable.js?v=<?php echo $rand_id ?>"></script>
    <script type="text/javascript" src="scripts/ui.droppable.js?v=<?php echo $rand_id ?>"></script>
    <script type="text/javascript" src="scripts/ui.slider.js?v=<?php echo $rand_id ?>"></script>
    <script type="text/javascript" src="scripts/ui.sortable.js?v=<?php echo $rand_id ?>"></script>
    <script type="text/javascript" src="scripts/jquery.history_remote.js"></script>
    <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
    <script src="scripts/utils.js<?php echo (ENVIRONMENT == DEVELOPMENT) ? '?v=' . $rand_id : '' ?>" type="text/javascript"></script>
    <script src="scripts/player.js<?php echo (ENVIRONMENT == DEVELOPMENT) ? '?v=' . $rand_id : '' ?>" type="text/javascript"></script>
    <script src="scripts/playlist.js<?php echo (ENVIRONMENT == DEVELOPMENT) ? '?v=' . $rand_id : '' ?>" type="text/javascript"></script>
    <?php if (ENVIRONMENT == PRODUCTION): ?>
	<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    var pageTracker = _gat._getTracker("<?php echo $google_tracker_id ?>");
    pageTracker._trackPageview();
    </script>
    <?php endif; ?>
    
    <link href="images/favicon.ico" rel="shortcut icon" />
  </head>
  <body unselectable="on" class="{% if user %}logged-in{% endif %}">
    <div id="flash"><div></div></div>
    <div id="header">
      <div id="login">
        <a href="" id="about">About</a> | 
        <?php if ($User->is_logged_in()): ?>
          Signed in as <a href="#nick" class="nickname"><?php echo $User->nickname ?></a> | <a href="<?php echo $User->logout_url ?>">Sign out</a>
        <?php else: ?>
          <a href="<?php echo $User->login_url ?>">Sign in</a>        
        <?php endif; ?>
      </div>
      <img id="logo" src="images/logo.png" />
      <input accesskey="f" maxlength="50" type="search" name="q" id="q" value="Search Artists &amp; Tracks" />
    </div>

    <div id="main-container">
      <div id="artist-info">
        <div>
          <a href="#close" class="close">x</a>
          <h3>This is the artist</h3>
          <p>This is the desc</p>
          <p class="check-on-sc"><a href="#sc">Go to the artist on SoundCloud »</a></p>
        </div>
        <img src="http://a1.soundcloud.com/avatars/0001/1308/i039964_big.jpg">
      </div>
      
      <div id="create-smart-playlist">
        <h4>Create a smart playlist</h4>
        <form id="pl-create-form">
          <div class="col-1">
            <label for="pl-genre">Genre</label>
            <input type="text" id="pl-genre">

            <label for="pl-favorite">User favorite</label>
            <input type="text" id="pl-favorite" value="Username">

            <input type="hidden" id="pl-bpm-range-start">
            <input type="hidden" id="pl-bpm-range-stop">
            <label id="bpm-range-label">BPM Range</label>
            <div class="bpm-range">
              <label id="bpm-range-start">50</label>
               <div class="ui-slider-1" id="pl-bpm-range-slider">
                 <div class="ui-slider-handle" id="bpm-handle-start"></div>
                 <div class="ui-slider-handle" id="bpm-handle-stop"></div>
              </div>
              <label id="bpm-range-stop">200</label>
            </div>
            
          </div>
          <div class="col-2">
            <label for="pl-search-term">Search term</label>
            <input type="text" id="pl-search-term">

            <label for="pl-artist">Artist</label>
            <input type="text" id="pl-artist">

            <label for="pl-order">Order by</label>
            <select id="pl-order">
              <option value="hotness" selected="selected">Hotness</option>
              <option value="created_at">Latest</option>
            </select>
          </div>

          <div class="buttons">
            <input type="submit" value="Create" id="pl-create">
            <a href="#cancel" id="pl-cancel">Cancel</a>
          </div>
        </form>
      </div>
      
      <div id="lists">

        	<table id="track-drag-holder">
          </table>

      </div>
    </div>
    <div id="sidebar">
      <ul id="playlists">
      </ul>
      <div id="create-playlists">
        <a id="add-playlist" href="<?php echo $User->login_url ?>">Playlist</a>
        <a id="add-smart-playlist" href="<?php echo $User->login_url ?>" class="smart-playlist">Smart Playlist</a>
      </div>
      <div id="artwork">
        <img src="http://a1.soundcloud.com/avatars/0001/1308/i039964_big.jpg">
      </div>
    </div>
    <div id="footer">
    	<input type="image" id="prev" value="&nbsp;" src="images/empty.png" />
    	<input type="image" id="play" value="&nbsp;" src="images/empty.png" />
    	<input type="image" id="next" value="&nbsp;" src="images/empty.png" />
    	<input type="image" id="rand" title="Shuffle Playlist" value="&nbsp;" src="images/empty.png" />
    	<input type="image" id="loop" title="Repeat Playlist" value="&nbsp;" src="images/empty.png" />
      <div id="speaker-mute"></div>
      <div id="volume" class="ui-slider-1">
        <div class="ui-slider-handle"></div>	
      </div>
      <div id="speaker"></div>
      <div id="player-display">
        <img src="images/logo-mini.png" class="logo">
        <div id="artist">
        
        </div>
        <div id="position"></div>
        <div id="progress">
          <img class="waveform" src="images/empty.png">
          <div class="inner">
            <div class="playhead"></div>
          </div>
          <div class="loading"></div>
        </div>
        <div id="duration"></div>
      </div>

    </div>
  
  
    <div id="about-box">
      <a href="#close" class="close">X</a>
      <h1>The Cloud Player</h1>
      <img src="images/about-thumb.png" width="294" height="238" id="about-thumb" alt="Thumbnail">
      <p>The Cloud Player is a <strong>web-based music player</strong> that let’s you...</p>
      <ul id="feature-list">
        <li id="feature-find"><span></span><strong>Find and play</strong> all tracks from SoundCloud</li>
        <li id="feature-save"><span></span><strong>Save playlists</strong> to your Google Account</li>
        <li id="feature-smart"><span></span>Make <strong>smart playlists</strong> based on genre, BPM, etc</li>
        <li id="feature-share"><span></span><strong>Share</strong> your ready-made playlists with your friends</li>
        <li id="feature-collaborate"><span></span><strong>Collaborate</strong> in making the best playlists ever</li>
      </ul>
      <div id="built-by">
        <p>
          <img src="images/erichenrik.png" width="90" height="51" alt="Henrik &amp; Eric">
          Built by <a href="http://hinkeb.com">Henrik Berggren</a> &amp; <a href="http://eric.wahlforss.com">Eric Wahlforss</a> using 
          <a href="http://appengine.google.com">Google App Engine</a>, <a href="http://python.org">Python</a>, <a href="http://jquery.com">jQuery</a>, 
          <a href="http://www.schillmania.com/projects/soundmanager2/">SoundManager 2</a>, <a href="http://www.everaldo.com/crystal/">Crystal</a> and the <a href="http://soundcloud.com/api">SoundCloud API</a>. Also thanks to <a href="http://bassistance.de/">Jörn</a> for the back-button support. Do you want to contribute? Go ahead and <a href="http://github.com/hinke/the-cloud-player/tree/master">fork from GitHub</a>!
        </p>
      </div>

    </div>
  
  
    <!-- TEMPLATES -->
    <div id="templates">

      <div id="playlist">
      	<table class="list-header">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>Title</th>
              <th>Artist</th>
              <th>Time</th>
              <th>Description</th>                                    
              <th>BPM</th>
              <th>Genre</th>
            </tr>
          </thead>
        </table>
      	<div>
        	<table>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>

      <div id="playlist-row">
        <table>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>

    </div>
    
    <div id="share-playlist">
      <div class="share-playlist">
        <a href="#close" class="close">X</a>
        <h1>Share This Playlist</h1>
        <p>Send this link to anyone who you want to share this playlist with:</p>
        <input type="text" value="foobar">
      </div>
    </div>
    <!-- END TEMPLATES -->

  </body>
</html>