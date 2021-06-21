$(document).ready(function() {
    var table1 = $('#datatable-1').DataTable( {
        lengthChange: false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ,'print', 'colvis'],
        responsive:true,
    } );

    table1.buttons().container()
        .appendTo( '#datatable-1_wrapper .col-md-6:eq(0)' );

    var table2 = $('#datatable-2').DataTable( {
        lengthChange: false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ,'print', 'colvis'],
        responsive:true,
    } );

    table2.buttons().container()
        .appendTo( '#datatable-2_wrapper .col-md-6:eq(0)' );


    var table4 = $('#datatable-4').DataTable( {
        lengthChange: false,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ,'print', 'colvis'],
        responsive:true,
    } );

    table4.buttons().container()
    .appendTo( '#datatable-2_wrapper .col-md-6:eq(0)' );

    var table3 = $('#datatable-3').DataTable( {
        lengthChange: false,
        responsive:true,
    } );

} );

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-single').select2();
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
