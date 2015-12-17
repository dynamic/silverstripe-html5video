<div class="video-list">
    <ul class="VideoGallery">
		<% loop $VideoList %>
            <li>
                <a href="$Link">
					$Image.CroppedImage(180, 150)
                </a>
                <h4><a href="$Link">$Title</a></h4>
            </li>
		<% end_loop %>
        <div class="clear"></div>
    </ul>
	<div class="clear"></div>
    <% with $VideoList %>
        <% include VideoPagination %>
	<% end_with %>
</div>