$Breadcrumbs

<h2 class="page-title">$MenuTitle</h2>


<ul class="columns columns-2 responsive-50 main-columns">
    <li class="column-row main-content">
	    <article>
	    	<h2 class="detail-head">$Title</h2>
	    	<% if $SubHeadline %><h3 class="detail-subhead">$SubHeadline</h3><% end_if %>
		    <% if $MP4Video %>
    			<div class="VideoContainer">
    				<video controls="controls" <% if $Poster %>poster="$Poster.SetWidth(640).AbsoluteURL"<% end_if %>>
    					<source src="$MP4Video.AbsoluteURL" type="video/mp4" />
    					<source src="$WebMVideo.AbsoluteURL" type="video/webm" />
    					<source src="$OggVideo.AbsoluteURL" type="video/ogg" />
    					<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" width="640" height="360">
    						<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
    						<param name="allowFullScreen" value="true" />
    						<param name="wmode" value="transparent" />
    						<param name="flashVars" value="config={'playlist':['$Poster.SetWidth(640).AbsoluteURL',{'url':'$MP4Video.AbsoluteURL','autoPlay':false}]}" />
    						<% if Poster %>
    							<img alt="Dynamic Reel" src="$Poster.SetWidth(640).AbsoluteURL" width="640" height="360" title="No video playback capabilities, please download the video below" />
    						<% end_if %>
    					</object>
    				</video>
    				<!--<p>
    					<strong>Download video:</strong> <a href="$MP4Video.URL">MP4 format</a> | <a href="$OggVideo.URL">Ogg format</a> | <a href="$WebMVideo.URL">WebM format</a>
    				</p>-->

    			</div>
			<% end_if %>

			$Content

	    </article>
	</li>
    <li class="aside-content">
        <h2 class="section-title">$MenuTitle</h2>

        <% if $RelatedVideos %>
	        <div class="aside-content-box list">
			    <h3>Related Videos</h3>
			    <ul class="relatedVideos">
				<% loop $RelatedVideos %>
					<li>
						<a href="$Link">
								$Poster.CroppedImage(50,50)
						</a>
						<a href="$Link">$MenuTitle</a>
					</li>
				<% end_loop %>
				</ul>
			</div>
		<% end_if %>

    </li>
</ul>