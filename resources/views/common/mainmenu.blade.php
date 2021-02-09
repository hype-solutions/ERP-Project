<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @canany(['View POS', 'View PQ','View Invoices'])
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/1.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>البيع
                </a>
                <ul class="menu-content">
                    @can('View POS')
                    <li>
                        <a class="menu-item" href="{{ route('pos.landing') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">بيع سريع</span>
                        </a>
                    </li>
                    @endcan
                    @can('View PQ')
                    <li>
                        <a class="menu-item" href="#">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">عروض أسعار</span>
                        </a>
                        <ul class="menu-content">
                            @can('Add PQ')
                            <li>
                                <a class="menu-item" href="{{ route('invoicespricequotations.add') }}">
                                    <i></i>
                                    <span data-i18n="Classic Menu">إنشاء عرض سعر</span>
                                </a>
                            </li>
                            @endcan
                            <li>
                                <a class="menu-item" href="{{ route('invoicespricequotations.list') }}">
                                    <i></i>
                                    <span data-i18n="Classic Menu"> عرض عروض الأسعار</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('View Invoices')
                    <li>
                        <a class="menu-item" href="#">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">فواتير المبيعات</span>
                        </a>
                        <ul class="menu-content">
                            @can('Add Invoices')
                            <li>
                                <a class="menu-item" href="{{ route('invoices.add') }}">
                                    <i></i>
                                    <span data-i18n="Classic Menu">إنشاء فاتورة</span>
                                </a>
                            </li>
                            @endcan
                            <li>
                                <a class="menu-item" href="{{ route('invoices.list') }}">
                                    <i></i>
                                    <span data-i18n="Classic Menu">عرض الفواتير</span>
                                </a>
                            </li>
                            <li>
                                <a class="menu-item" href="">
                                    <i></i>
                                    <span data-i18n="Classic Menu">مواعيد استحقاق الفواتير</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany
            @can('View Projects')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/2.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>المشاريع
                </a>
                <ul class="menu-content">
                    @can('Add Projects')
                    <li>
                        <a class="menu-item" href="{{ route('projects.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">انشاء مشروع</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('projects.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض المشاريع</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Customers')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/3.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>العملاء
                </a>
                <ul class="menu-content">
                    @can('Add Customers')
                    <li>
                        <a class="menu-item" href="{{ route('customers.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">إضافة عميل</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('customers.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض العملاء</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Suppliers')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/4.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>الموردين
                </a>
                <ul class="menu-content">
                    @can('Add Suppliers')
                    <li>
                        <a class="menu-item" href="{{ route('suppliers.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">إضافة مورد</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('suppliers.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض الموردين</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Expenses')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/5.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>المصاريف
                </a>
                <ul class="menu-content">
                    @can('Add Expenses')
                    <li>
                        <a class="menu-item" href="{{ route('outs.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">إضافة مصروفات</span>
                        </a>
                    </li>
                    @endcan
                    @can('View Expenses Cat')
                    <li>
                        <a class="menu-item" href="{{ route('outs.categories') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض بنود الخدمات</span>
                        </a>
                    </li>
                    @endcan
                    @can('View Expenses Ent')
                    <li>
                        <a class="menu-item" href="{{ route('outs.entities') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض الجهات المختصة</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('outs.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">سجل المصاريف</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Income')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/6.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>الدواخل
                </a>
                <ul class="menu-content">
                    @can('Add Income')
                    <li>
                        <a class="menu-item" href="{{ route('ins.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">إضافة دواخل</span>
                        </a>
                    </li>
                    @endcan
                    @can('View Income Cat')
                    <li>
                        <a class="menu-item" href="{{ route('ins.categories') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض بنود الخدمات</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('ins.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">سجل الدواخل</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Branches')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/7.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>الفروع
                </a>
                <ul class="menu-content">
                    @can('Add Branches')
                    <li>
                        <a class="menu-item" href="{{ route('branches.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">إضافة فرع</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('branches.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض الفروع</span>
                        </a>
                    </li>
                    @can('View Safes')
                    <li>
                        <a class="menu-item" href="{{ route('safes.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض الخزن</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('View Products')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/8.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>المخزن
                </a>
                <ul class="menu-content">
                    @can('Add Products')
                    <li>
                        <a class="menu-item" href="{{ route('products.add') }}">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical">إضافة منتج</span>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('products.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">عرض المنتجات</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="#">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">المخزن</span>
                        </a>
                        <ul class="menu-content">
                            @can('Add PO')
                            <li>
                                <a class="menu-item" href="{{ route('purchasesorders.add') }}">
                                    <i class="la la-arrows-h"></i>
                                    <span data-i18n="Horizontal">أمر شراء جديد</span>
                                </a>
                            </li>
                            @endcan
                            @can('View PO')
                            <li>
                                <a class="menu-item" href="{{ route('purchasesorders.list') }}">
                                    <i class="la la-arrows-h"></i>
                                    <span data-i18n="Horizontal">استعراض أوامر الشراء</span>
                                </a>
                            </li>
                            @endcan
                            @can('Transfer Products')
                            <li>
                                <a class="menu-item" href="{{ route('products.select') }}" >
                                    <i class="la la-arrows-h"></i>
                                    <span data-i18n="Horizontal">تحويل كميات بين الفروع</span>
                                </a>
                            </li>
                            @endcan
                            {{-- <li><a class="menu-item" href="{{ route('products.select') }}"  ><i class="la la-arrows-h"></i><span data-i18n="Horizontal">إضافة كمية يدويا</span></a>
                            </li> --}}
                        </ul>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Settings')
            <li class=" nav-item">
                <a href="#">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/9.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>الإعدادات
                </a>
                <ul class="menu-content">
                    @can('View Users')
                    <li>
                        <a class="menu-item" href="#">
                            <i class="la la-arrows-v"></i>
                            <span data-i18n="Vertical"> المستخدمين</span>
                        </a>
                        <ul class="menu-content">
                            @can('Add Users')
                            <li>
                                <a class="menu-item" href="{{ route('users.add') }}">
                                    <i class="la la-arrows-h"></i>
                                    <span data-i18n="Horizontal">إضافة مستخدم</span>
                                </a>
                            </li>
                            @endcan
                            <li>
                                <a class="menu-item" href="{{ route('users.list') }}">
                                    <i class="la la-arrows-h"></i>
                                    <span data-i18n="Horizontal">عرض المستخدمين</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('View Roles')
                    <li>
                        <a class="menu-item" href="{{ route('settings.roles') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">الصلاحيات</span>
                        </a>
                    </li>
                    @endcan
                    @can('View General Settings')
                    <li>
                        <a class="menu-item" href="{{ route('settings.list') }}">
                            <i class="la la-arrows-h"></i>
                            <span data-i18n="Horizontal">الإعدادات العامة</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('View Reports')
            <li class=" nav-item">
                <a href="{{ route('reports.landing') }}">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/10.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>التقارير
                </a>
            </li>
            @endcan
            @role('Super Admin')
            <li class=" nav-item">
                <a href="{{ route('reports.landing') }}">
                    <img src="{{ asset('theme/app-assets/images/custom/menu/superUser.png') }}" style="width : 50%"/>
                    <span class="menu-title" data-i18n="Templates"></span>
                    <br/>ERP
                </a>
            </li>
            @endrole
        </ul>
    </div>
</div>

  <!-- END: Main Menu-->
