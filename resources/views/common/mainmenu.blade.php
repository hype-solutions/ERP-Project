<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/1.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>البيع</a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{route('pos.landing')}}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">بيع سريع</span></a>

              </li>

            <li><a class="menu-item" href="#"><i class="la la-arrows-v"></i><span data-i18n="Vertical">عروض أسعار</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{route('invoicespricequotations.add')}}"><i></i><span data-i18n="Classic Menu">إنشاء عرض سعر</span></a>
                </li>
                <li><a class="menu-item" href="{{route('invoicespricequotations.list')}}"><i></i><span data-i18n="Classic Menu"> عرض عروض الأسعار</span></a>
                </li>
              </ul>
            </li>
            @can('View Invoices')
            <li><a class="menu-item" href="#"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">فواتير المبيعات</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{route('invoices.add')}}"><i></i><span data-i18n="Classic Menu">إنشاء فاتورة</span></a>
                </li>
                <li><a class="menu-item" href="{{route('invoices.list')}}"><i></i><span data-i18n="Classic Menu">عرض الفواتير</span></a>
                </li>
                <li><a class="menu-item" href=""><i></i><span data-i18n="Classic Menu">مواعيد استحقاق الفواتير</span></a>
                </li>
              </ul>
            </li>
            @endcan
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/2.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>المشاريع</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{route('projects.add')}}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">انشاء مشروع</span></a>
              </li>
              <li><a class="menu-item" href="{{route('projects.list')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض المشاريع</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/3.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>العملاء</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('customers.add') }}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">إضافة عميل</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('customers.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض العملاء</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/4.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>الموردين</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('suppliers.add') }}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">إضافة مورد</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('suppliers.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض الموردين</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/5.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>المصاريف</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('outs.add') }}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">إضافة مصروفات</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('outs.categories') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض بنود الخدمات</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('outs.entities') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض الجهات المختصة</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('outs.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">سجل المصاريف</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/6.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>الدواخل</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('ins.add') }}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">إضافة دواخل</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('ins.categories') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض بنود الخدمات</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('ins.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">سجل الدواخل</span></a>
              </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/7.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>الفروع</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('branches.add') }}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">إضافة فرع</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('branches.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض الفروع</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('safes.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض الخزن</span></a>
              </li>

            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/8.png')}}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>المخزن</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('products.add') }}"><i class="la la-arrows-v"></i><span data-i18n="Vertical">إضافة منتج</span></a>
              </li>
              <li><a class="menu-item" href="{{ route('products.list') }}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض المنتجات</span></a>
              </li>

              <li><a class="menu-item" href="#"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">المخزن</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('purchasesorders.add')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">أمر شراء جديد</span></a>
                    </li>
                    <li><a class="menu-item" href="{{route('purchasesorders.list')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">استعراض أوامر الشراء</span></a>
                    </li>
                    <li><a class="menu-item" href="{{route('products.select')}}" ><i class="la la-arrows-h"></i><span data-i18n="Horizontal">تحويل كميات بين الفروع</span></a>
                    </li>
                    {{-- <li><a class="menu-item" href="{{route('products.select')}}"  ><i class="la la-arrows-h"></i><span data-i18n="Horizontal">إضافة كمية يدويا</span></a>
                    </li> --}}


                </ul>
            </li>
            </ul>
          </li>
          <li class=" nav-item"><a href="#"><img src="{{ asset('theme/app-assets/images/custom/menu/9.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>الإعدادات</a>
            <ul class="menu-content">
              <li><a class="menu-item" href="#"><i class="la la-arrows-v"></i><span data-i18n="Vertical"> المستخدمين</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('users.add')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">إضافة مستخدم</span></a>
                    </li>
                    <li><a class="menu-item" href="{{route('users.list')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">عرض المستخدمين</span></a>
                    </li>
                </ul>
              </li>
              <li><a class="menu-item" href="{{route('settings.roles')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">الصلاحيات</span></a>
              </li>
              <li><a class="menu-item" href="{{route('settings.list')}}"><i class="la la-arrows-h"></i><span data-i18n="Horizontal">الإعدادات العامة</span></a>
              </li>

            </ul>
          </li>
        </li>
        <li class=" nav-item"><a href="{{route('reports.landing')}}"><img src="{{ asset('theme/app-assets/images/custom/menu/10.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>التقارير</a>
        </li>

        @role('Super Admin')
    </li>
    <li class=" nav-item"><a href="{{route('reports.landing')}}"><img src="{{ asset('theme/app-assets/images/custom/menu/superUser.png') }}" style="width: 50%"/><span class="menu-title" data-i18n="Templates"></span><br/>ERP</a>
    </li>
    @endrole
      </ul>
    </div>
  </div>

  <!-- END: Main Menu-->
