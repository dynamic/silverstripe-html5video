<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
    	<h1>$Title</h1>
	    <% if $MP4Video %>
			<video id="really-cool-video" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264" data-setup='{}' <% if $Image %>poster="$Image.SetWidth(640).AbsoluteURL"<% end_if %>>
				<source src="$MP4Video.AbsoluteURL" type="video/mp4" />
				<% if $WebMVideo %><source src="$WebMVideo.AbsoluteURL" type="video/webm" /><% end_if %>
				<% if $OggVideo %><source src="$OggVideo.AbsoluteURL" type="video/ogg" /><% end_if %>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser
                    that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
			</video>
		<% end_if %>
		$Content
    </article>
    $Form
    $CommentsForm
</div>