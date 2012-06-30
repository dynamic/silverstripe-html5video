<% require css(videos/css/video.css) %>

<div id="SideBar">
	<% if relatedVideos %>
		<h3>Related Videos</h3>
		<ul class="relatedVideos">
			<% control relatedVideos %>
				<li>
					<a href="$Link">
						<% control Video %>
							$VideoThumbnail.CroppedImage(50,50)
						<% end_control %>
					</a>
					<a href="$Link">$MenuTitle</a>
				</li>
			<% end_control %>
		</ul>
	<% end_if %>
</div>

<div id="Content">
	<div class="typography">
	<h2>$Title</h2>
	</div>

	<div class="VideoContainer">
		<video controls="controls" poster="$Poster.AbsoluteURL" width="640" height="360">
			<source src="$MP4Video.AbsoluteURL" type="video/mp4" />
			<source src="$WebMVideo.AbsoluteURL" type="video/webm" />
			<source src="$OggVideo.AbsoluteURL" type="video/ogg" />
			<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" width="640" height="360">
				<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
				<param name="allowFullScreen" value="true" />
				<param name="wmode" value="transparent" />
				<param name="flashVars" value="config={'playlist':['$Poster.AbsoluteURL',{'url':'$MP4Video.AbsoluteURL','autoPlay':false}]}" />
				<img alt="Dynamic Reel" src="$Poster.AbsoluteURL" width="640" height="360" title="No video playback capabilities, please download the video below" />
			</object>
		</video>
		<!--<p>
			<strong>Download video:</strong> <a href="$MP4Video.URL">MP4 format</a> | <a href="$OggVideo.URL">Ogg format</a> | <a href="$WebMVideo.URL">WebM format</a>
		</p>-->
		
	</div>
	
	$Content
</div>