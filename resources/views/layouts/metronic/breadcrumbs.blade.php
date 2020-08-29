
<ul class="m-subheader__breadcrumbs m-nav m-nav--inline"> 
	@foreach ($links as $link)
		@if (!$loop->first)
	        <li class="m-nav__separator">
		        <i class="la la-angle-right"></i>
		    </li>
	    @endif

	    <li class="m-nav__item">
	        <a href="{{url($link['url'])}}" class="m-nav__link">
	            <span class="m-nav__link-text text-capitalize">
	                {{$link['label']}}
	            </span>
	        </a>
	    </li>
    @endforeach 
</ul>