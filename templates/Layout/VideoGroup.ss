<% require css(videos/css/video.css) %>

<div class="twelve columns alpha">

	$Breadcrumbs
	<h2 class="page-title">$MenuTitle</h2>
	
	 <article>
    	<h2 class="detail-head">$Title</h3>
        <% if SubHeadline %><h3 class="detail-subhead">$SubHeadline</h3><% end_if %>
        <div class="typography">
	        $Content
        </div>
        
        <ul class="VideoGallery">
		<% control VideoList %>
			<li>
				<a href="$Link">
					$Poster.CroppedImage(180, 150)
				</a>		
				
				<h4><a href="$Link">$Title</a></h4>
			
			</li>
		<% end_control %>
			<div class="clear"></div>
		</ul>
        
	</article>

</div>
<div class="four columns omega">

	<h2 class="section-title">$MenuTitle</h2>
        
    <% if SubGroups %>
	<h3>Related Groups</h3>
	<ul>
		<% control SubGroups %>
		<li><a href="$Link">$MenuTitle</a></li>
		<% end_control %>
	</ul>
	<% end_if %>

</div>