<% require css(videos/css/video.css) %>

<div id="SideBar">
	
</div>

<div id="Content">
	<div  class="typography">
	<h2>$Title</h2>
	</div>

	<ul class="VideoGallery">
	<% control Children %>
		<li>
			<a href="$Link">
				<% control Video %>
					$VideoThumbnail.SetRatioSize(200,150)
				<% end_control %>
			</a>		
			<br>
			
			<a href="$Link">$Title</a>
		
		</li>
	<% end_control %>
	</ul>
	
</div>