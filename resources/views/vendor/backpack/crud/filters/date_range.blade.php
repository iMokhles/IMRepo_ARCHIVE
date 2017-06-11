{{-- Date Range Backpack CRUD filter --}}

<li filter-name="{{ $filter->name }}"
	filter-type="{{ $filter->type }}"
	class="dropdown {{ Request::get($filter->name)?'active':'' }}">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $filter->label }} <span class="caret"></span></a>
	<div class="dropdown-menu">
		<div class="form-group backpack-filter m-b-0">
			<div class="input-group date">
		        <div class="input-group-addon">
		          <i class="fa fa-calendar"></i>
		        </div>
		        <input class="form-control pull-right"
		        		id="daterangepicker-{{ str_slug($filter->name) }}"
		        		type="text"
		        		@if ($filter->currentValue)
							@php
								$dates = (array)json_decode($filter->currentValue);
								$start_date = $dates['from'];
								$end_date = $dates['to'];
					        	$date_range = implode(' ~ ', $dates);
					        	$date_range = str_replace('-', '/', $date_range);
					        	$date_range = str_replace('~', '-', $date_range);

					        @endphp
					        placeholder="{{ $date_range }}"
						@endif
		        		>
		        <div class="input-group-addon">
		          <a class="daterangepicker-{{ str_slug($filter->name) }}-clear-button" href=""><i class="fa fa-times"></i></a>
		        </div>
		    </div>
		</div>
	</div>
</li>

{{-- ########################################### --}}
{{-- Extra CSS and JS for this particular filter --}}

{{-- FILTERS EXTRA CSS  --}}
{{-- push things in the after_styles section --}}

@push('crud_list_styles')
    <!-- include select2 css-->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	<style>
		.input-group.date {
			width: 320px;
			max-width: 100%; }
	</style>
@endpush


{{-- FILTERS EXTRA JS --}}
{{-- push things in the after_scripts section --}}

@push('crud_list_scripts')
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
  <script>
		jQuery(document).ready(function($) {
			var dateRangeInput = $('#daterangepicker-{{ str_slug($filter->name) }}').daterangepicker({
				timePicker: false,
		        ranges: {
		            'Today': [moment().startOf('day'), moment().endOf('day')],
		            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		            'This Month': [moment().startOf('month'), moment().endOf('month')],
		            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		        },
				@if ($filter->currentValue)
		        startDate: moment("{{ $start_date }}"),
		        endDate: moment("{{ $end_date }}"),
				@endif
				alwaysShowCalendars: true,
				autoUpdateInput: true
			},
			function (start, end) {
				alert(start);
				var dates = {
					'from': start.format('YYYY-MM-DD'),
					'to': end.format('YYYY-MM-DD')
				};
				var value = JSON.stringify(dates);
				var parameter = '{{ $filter->name }}';

				@if (!$crud->ajaxTable())
					// behaviour for normal table
					var current_url = normalizeAmpersand('{{ Request::fullUrl() }}');
					var new_url = addOrUpdateUriParameter(current_url, parameter, value);

					// refresh the page to the new_url
					new_url = normalizeAmpersand(new_url.toString());
			    	window.location.href = new_url;
			    @else
			    	// behaviour for ajax table
					var ajax_table = $('#crudTable').DataTable();
					var current_url = ajax_table.ajax.url();
					var new_url = addOrUpdateUriParameter(current_url, parameter, value);

					// replace the datatables ajax url with new_url and reload it
					new_url = normalizeAmpersand(new_url.toString());
					ajax_table.ajax.url(new_url).load();

					// mark this filter as active in the navbar-filters
					if (URI(new_url).hasQuery('{{ $filter->name }}', true)) {
						$('li[filter-name={{ $filter->name }}]').removeClass('active').addClass('active');
					}
					else
					{
						$('li[filter-name={{ $filter->name }}]').trigger('filter:clear');
					}
			    @endif
			});

			$('li[filter-name={{ $filter->name }}]').on('hide.bs.dropdown', function () {
				if($('.daterangepicker').is(':visible'))
			    return false;
			});

			$('li[filter-name={{ $filter->name }}]').on('filter:clear', function(e) {
				// console.log('daterangepicker filter cleared');
				$('li[filter-name={{ $filter->name }}]').removeClass('active');
				$('#daterangepicker-{{ str_slug($filter->name) }}').val('');
			});

			// datepicker clear button
			$(".daterangepicker-{{ str_slug($filter->name) }}-clear-button").click(function(e) {
				e.preventDefault();

				$('li[filter-name={{ $filter->name }}]').trigger('filter:clear');
				// $('#daterangepicker-{{ str_slug($filter->name) }}').trigger('changeDate');
			})
		});
  </script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}