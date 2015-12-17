<div class="video-list">
    <ul class="VideoGallery">
		<% loop $VideoList %>
            <li>
                <a href="$Link">
					$Poster.CroppedImage(180, 150)
                </a>

                <h4><a href="$Link">$Title</a></h4>

            </li>
		<% end_loop %>
        <div class="clear"></div>
    </ul>
	<div class="clear"></div>
	<% if $VideoList.MoreThanOnePage %>
        <div class="pagination">
			<% if $VideoList.NotFirstPage %>
                <ul id="previous col-xs-6">
                    <li><a href="$VideoList.PrevLink"><i class="fa fa-chevron-left"></i></a></li>
                </ul>
			<% end_if %>
            <ul class="hidden-xs">
				<% loop $VideoList.PaginationSummary %>
					<% if $Link %>
                        <li <% if $CurrentBool %>class="active"<% end_if %>>
                            <a href="$Link">$PageNum</a>
                        </li>
					<% else %>
                        <li>...</li>
					<% end_if %>
				<% end_loop %>
            </ul>
			<% if $VideoList.NotLastPage %>
                <ul id="next col-xs-6">
                    <li><a href="$VideoList.NextLink"><i class="fa fa-chevron-right"></i></a></li>
                </ul>
			<% end_if %>
        </div>
	<% end_if %>
</div>