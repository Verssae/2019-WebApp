<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?=$total_song = 6578;?> total songs,
			which is over <?= (int)($total_song / 10 )?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
		
			<ol><?php
                $news_pages = 5;
                if (isset($_GET["newspages"])) {
                    $news_pages = $_GET["newspages"];
                }
                
                $year = 2019;
                $month = 11;
                for($i=0; $i < $news_pages; $i++) {
                    $temp = $month;
                    if ($month < 10) {
                        $temp = "0$month";
                    }
                    ?>
                    <li><a href="https://www.billboard.com/archive/article/<?=$year . $temp?>"><?="$year-$temp"?></a></li>
                <?php $month--;
                    if ($month === 0) {
                        $year -= 1;
                        $month = 12;
                    }
                } ?>
			    
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
            <?php
            $lines = file("./favorite.txt");
            $artists = array(); ?>
            <ol>
            
            <?php foreach($lines as $line) { 
                $temp = explode(' ', $line);
                $url = implode('_', $temp);
                ?>
                <li><a href="http://en.wikipedia.org/wiki/<?=$url?>"><?=$line?></a></li>      
            <?php } ?>
                </ol>
			
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
                <?php
                $musics = glob('lab5/musicPHP/songs/*.mp3');
                $arr = array();
                foreach($musics as $music) {
                    $arr[$music] = filesize($music);
                }
                arsort($arr);
                
                foreach($arr as $key => $value) {
                    ?>
                <li class="mp3item">
					<a href="<?= $key ?>"><?= basename($key) ?> (<?= (int)($value/1024) ?>KB)</a>
				</li>
                <?php } ?>
				

				<!-- Exercise 8: Playlists (Files) -->
                <?php
                $playlists = glob('lab5/musicPHP/songs/*.m3u');
                arsort($playlists);
                foreach($playlists as $playlist) { ?>
                    <li class="playlistitem"><?= basename($playlist)?>:
					<ul>
                        <?php 
                        $mp3s = file($playlist);
                        $songs = array();
                        foreach($mp3s as $song) {
                            
                            if (strpos($song, '#') === false) { 
                                $song = trim($song);
                                $songs[] = $song;
                            }
                        }
                        shuffle($songs);
//                        print_r($songs);
                        foreach($songs as $value) { ?>
                            <li><?= $value?></li>

                    <?php  } ?>
					</ul>
                </li>
               <?php }?>
				
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
