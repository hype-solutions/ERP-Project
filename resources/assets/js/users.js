$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn';

// console.log( dt.version );
let usersTable = $('#usersTable').DataTable({
    "columnDefs": [{
        "targets": 0,
        "data": 'id',

    }, {
        "targets": 1,
        "data": 'role',
        render: function (data, type, row) {
            if (data == 'مدير') {
                return '<button class="btn btn-block btn-outline-warning btn-sm">' + data + '</button>';
            } else if (data == 'محاسب') {
                return '<button class="btn btn-block btn-outline-primary btn-sm">' + data + '</button>';
            } else if (data == 'مسؤول مخازن') {
                return '<button class="btn btn-block btn-outline-success btn-sm">' + data + '</button>';
            } else if (data == 'مدير فروع') {
                return '<button class="btn btn-block btn-outline-dark btn-sm">' + data + '</button>';
            } else if (data == 'مسؤول مبيعات') {
                return '<button class="btn btn-block btn-outline-danger btn-sm">' + data + '</button>';
            } else {
                return '<button class="btn btn-block btn-outline-info btn-sm">' + data + '</button>';
            }
        }
    }, {
        "targets": 2,
        "data": 'name',
        render: function (data, type, row) {
            return '<li class="la la-user"></li>' + data;

        }
    }, {
        "targets": 3,
        "data": 'username',
        render: function (data, type, row) {
            if (data) {
                return '<span style="font-size: 1.5rem;"><li class="la la-at"></li>' + data + '</span>';
            } else {
                return '<span class="danger">غير مسجل</span>';
            }

        }
    }, {
        "targets": 4,
        render: function (data, type, row) {
            var temp;
            if (row.mobile) {
                temp = '<li class="la la-mobile"></li>' + row.mobile;
            } else {
                temp = '<li class="la la-mobile"></li> <span class="danger">غير مسجل</span>';
            }
            if (row.email) {
                temp += '<br><li class="la la-envelope"></li>' + row.email;
            } else {
                temp += '<br><li class="la la-envelope"></li> <span class="danger">غير مسجل</span>';
            }

            return temp;
        }
    }, {
        "targets": 5,
        "searchable": false,
        render: function (data, type, row) {
            var theToken = $('meta[name="csrf-token"]').attr('content');
            var result = `<div class="form-group">
            <div class="btn-group" role="group"
                aria-label="Button group with nested dropdown">
                <a href="/users/view/` + row.id + `"
                    class="btn btn-outline-info  btn-sm"><i
                        class="la la-folder-open"></i>
                    استعراض</a>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop2" type="button"
                        class="btn btn-outline-info dropdown-toggle  btn-sm"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        التحكم
                    </button>
                    <div class="dropdown-menu" style="width: fit-content"
                        aria-labelledby="btnGroupDrop2"
                        x-placement="bottom-start"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                        <a class="dropdown-item"
                            href="/users/edit/` + row.id + `"><i
                                class="la la-pencil-square-o"></i> تعديل</a>
                        <a class="dropdown-item"
                            href="/users/permissions/` + row.id + `"><i
                                class="la la-balance-scale"></i> تعديل
                            الصلاحيات</a>
                        <form
                            action="/users/sendResetPassword"
                            method="post">
                            <input type="hidden" name="_token" value="` + theToken + `">
                            <input type="hidden"
                                value="` + row.email + `" name="email">
                            <button class="dropdown-item" type="submit"><i
                                    class="la la-lock"></i> أرسل كلمة
                                مرور جديدة</button>
                        </form>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                            data-toggle="modal"
                            data-target="#edit_profilePicture"  data-id="` + row.id + `"><i
                                class="la la-pencil-square-o"></i> تغيير
                            الصورة</a>
                        <a class="dropdown-item" href="#"
                            data-toggle="modal"
                            data-target="#edit_signature"  data-id="` + row.id + `"><i
                                class="la la-pencil-square-o"></i> تغيير
                            التوقيع</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i
                                class="la la-exchange"></i> سجل
                            الحركات</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item btn-danger"
                            onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم نهائيا و جميع تفاصيله من البرنامج')"
                            href="/users/delete/` + row.id + `"><i
                                class="la la-trash"></i>حذف</a>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <button type="button"
                        class="btn btn-outline-info dropdown-toggle  btn-sm"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> التواصل مع
                        المستخدم</button>
                    <div class="dropdown-menu" x-placement="bottom-start"
                        style="width:fit-content;position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">`;
            if (row.mobile) {
                result += `<a class="dropdown-item"
                        href="tel:` + row.mobile + `">اتصال
                        بالموبايل
                    </a>`;
            } else {
                result += `<button class="dropdown-item" disabled>اتصال
                        بالموبايل
                        <small style="color: red">غير
                            مسجل</small></button>`;
            }
            result += `<button class="dropdown-item" disabled>ارسال SMS
                         <small style="color: red">غير
                             متاحة</small></button>`;

            if (row.email) {
                result += `<a class="dropdown-item"
                            href="mailto:` + row.email + `"> ارسال
                            ايميل</a>`;
            } else {
                result += `<button class="dropdown-item" disabled> ارسال
                            ايميل<small style="color: red">غير
                                مسجل</small></button>`;
            }
            result += `
                    </div>
                </div>
            </div>
        </div>`;

            return result;
        }
    }],

    dom: 'Bfrtip',
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
    },
    serverSide: true,
    processing: true,
    searching: true,
    ajax: {
        url: "/users",
        type: 'GET',
    },

    buttons: [{
            text: 'إضافة مستخدم جديد',
            className: 'btn-outline-success btn-lg',
            action: function (e, dt, button, config) {
                window.location.href = "../admin/customers/create";
            }
        }, {
            extend: 'excelHtml5',
            text: 'حفظ كملف EXCEL',
            messageTop: 'قائمة المستخدمين',
            exportOptions: {
                columns: [4, 3, 2, 1, 0]
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'حفظ كملف PDF',
            // alignment: "right",
            messageTop: 'قائمة المستخدمين',
            exportOptions: {
                columns: [4, 3, 2, 1, 0],
                // orthogonal: "PDF",
                // alignment: "right",

            },


        },
        {
            extend: 'print',
            text: 'طباعة',
            messageTop: 'قائمة المستخدمين',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        }
    ],
    rowId: 'id',

});


// new $.fn.dataTable.Buttons( usersTable, {
//     buttons: [
//         'copy', 'excel', 'pdf'
//     ]
// } );


$("#edit_profilePicture").on('shown.bs.modal', function (e) {
    const button = $(e.relatedTarget);
    const userId = button.data('id');

    var url = '{{ route("users.profilepic", ":id") }}';
    url = url.replace(':id', userId);
    $('#edit_profilePicture_form').attr('action', url);
});

$("#edit_profilePicture").on('hidden.bs.modal', function (e) {
    usersTable.rows().deselect();
});


$('#tableSearch').on('click', function () {

    var typeVal = $('#users-list-role').val();

    if (typeVal == 'all') {
        usersTable.column(1).search("", true, false).draw();
    } else {
        usersTable.column(1).search("(^" + typeVal + "$)", true, false).draw();
    }
});
