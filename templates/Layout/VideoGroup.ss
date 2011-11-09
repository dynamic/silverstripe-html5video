<% require css(videos/css/video.css) %>

<div id="SideBar">
	<% if SubGroups %>
	<h3>Related Groups</h3>
	<ul>
		<% control SubGroups %>
		<li><a href="$Link">$MenuTitle</a></li>
		<% end_control %>
	</ul>
	<% end_if %>
</div>

<div id="Content">
	<div  class="typography">
	<h2>$Title</h2>
	</div>

	<ul class="VideoGallery">
	<% control GroupVideos %>
		<li>
			<a href="$Link">
				<% control Video %>
					$VideoThumbnail.CroppedImage(180,100)
				<% end_control %>
			</a>		
			<br>
			
			<a href="$Link">$Title</a>
		
		</li>
	<% end_control %>
		<div class="clear"></div>
	</ul>
	
</div>