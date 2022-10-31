<ul class="kt-menu__nav">
  @foreach($module as $no => $row)
  <li class="kt-menu__item {{ (Str::contains(url()->full(), $row->link))?'kt-menu__item--active':'' }} {{ (count($row->child_module)>0)?'kt-menu__item--submenu':'' }}" {{ (count($row->child_module)>0)?'data-ktmenu-submenu-toggle="hover"':'' }} aria-haspopup="true" >
    @if(count($row->child_module)>0)
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
      <span class="kt-menu__link-icon">
        <i class="{{ (int)strlen($row->icon>'5')?$row->icon:'' }}"></i>
      </span>
      <span class="kt-menu__link-text">{{ $row->module_name }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
    </a>
    @else
    <a href="{{ url('') }}/{{ $row->link }}" class="kt-menu__link">
      <span class="kt-menu__link-icon">
        <i class="{{ (int)strlen($row->icon>'5')?$row->icon:'' }}"></i>
      </span>
      <span class="kt-menu__link-text">{{ $row->module_name }}</span>
    </a>
    @endif
    @if(count($row->child_module)>0)
      <div class="kt-menu__submenu"><span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
          @foreach($row->child_module as $d)
          <li class="kt-menu__item {{ ($d->link==Request::segment(1).'/'.Request::segment(2))?'kt-menu__item--active menu-active':'' }}" aria-haspopup="true" >
            <a href="{{ url('') }}/{{ $d->link }}" class="kt-menu__link ">
              <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ $d->module_name }}</span>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    @endif
  </li>
  @endforeach
</ul>
{{-- {{ (Str::contains(url()->full(), $d->link))?'kt-menu__item--active menu-active':'' }} --}}
