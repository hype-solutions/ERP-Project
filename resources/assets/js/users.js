$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn'


let usersTable = $('#usersTable').DataTable({
    "columnDefs": [{
        "searchable": false,
        "targets": 5,
    }],
    dom: 'Bfrtip',
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
    },
    serverSide: true,
    ajax: {
        url: "/users",
        type: 'GET',
    },
    columns: [
        { data: 'id', name: 'id', 'visible': true},
        { data: 'role', name: 'role' },
        { data: 'name', name: 'name' },
        { data: 'username', name: 'username' },
        { data: 'email', name: 'email' },
        { data: 'username', name: 'username' },

    ],

});
