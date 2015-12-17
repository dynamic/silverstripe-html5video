<% require css(html5video/css/video.css) %>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<% require javascript(html5video/javascript/html5video.js) %>

<div class="twelve columns alpha main">

	$Breadcrumbs
	<h2 class="page-title">$MenuTitle</h2>
	
	 <article>
    	<h3 class="detail-head">$Title</h3>
        <% if $SubHeadline %><h3 class="detail-subhead">$SubHeadline</h3><% end_if %>
        <div class="typography">
	        $Content
        </div>
		 <div class="video-holder">
        	<% include VideoList %>
         </div>
        
	</article>

</div>
<div class="four columns omega">

	<h2 class="section-title">$MenuTitle</h2>
        
    <% if $SubGroups %>
	<h3>Related Groups</h3>
	<ul>
		<% loop $SubGroups %>
		<li><a href="$Link">$MenuTitle</a></li>
		<% end_loop %>
	</ul>
	<% end_if %>

</div>