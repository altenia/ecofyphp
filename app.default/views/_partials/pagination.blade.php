
<div class="col-md-12 text-center">
	Total: @{{ recordTable.total_match }}
</div>
<!-- Pagination BEGIN -->
<div class="col-md-12 text-center">
	<ul class="pagination pagination-sm pagination-centered">
	    <li ng-class="{disabled: recordTable.filter_params._page == 0}">
	        <a href="" ng-click="recordTable.previousPage()">« Prev</a>
	    </li>
	    <li ng-repeat="n in recordTable.getPageItems()"
	        ng-class="{active: n == recordTable.filter_params._page}"
	    ng-click="goPage()">
	        <a href="#?_page=@{{n}}@{{recordTable.filterQueryString()}}" ng-click="recordTable.goPage(n)" ng-bind="n + 1">1</a>
	    </li>
	    <li ng-class="{disabled: recordTable.filter_params._page == recordTable.total_pages - 1}">
	        <a href ng-click="recordTable.nextPage()">Next »</a>
	    </li>
	</ul>
</div>
<!-- Pagination END -->