
$(document).ready( function () {
    var t = $('#myTable').DataTable({
        "columnDefs": [ {
            "searchable": true,
            "orderable": false,
            "targets": 0,
        } ],
        "order": [[ 0, 'asc' ]],
        "paging": false,
        "searching": true,
        
        "initComplete": function(){
            $("#myTable_filter").detach().appendTo('#new-search-area');
            $("#myTable_filter label").attr("style", "width: 100%");
            $("#myTable_filter input").attr("placeholder", "Search country..");

        },
        "language": { "search": "" }
    });

    t.on( 'order.dt', function () {
        t.column(0, {order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
 