<% require css(videos/css/video.css) %>

<div id="SideBar">
	
</div>

<div id="Content">
	<div class="typography">
	<h2>$Title</h2>
	</div>

	<div class="VideoContainer">
		<% control Video %>
		$Player(600,338)
		<% end_control %>
	</div>
	
	$Content
</div>