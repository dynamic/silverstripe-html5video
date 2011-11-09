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
		<% control Video %>
		$Player(600,337)
		<% end_control %>
	</div>
	
	$Content
</div>