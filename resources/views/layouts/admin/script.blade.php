<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)

</script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
{{-- <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/nepali.datepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script src="{{mix('js/app.js')}}"></script>
<script>
    $(function() {
        
        var mainInput = document.getElementsByClassName("nepaliDatePicker");
        mainInput.nepaliDatePicker({
            language: "english",
            onChange: function() {
                let nepalidate = $(".nepaliDatePicker").val();
                let dateObj = NepaliFunctions.ParseDate(nepalidate);
                let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                let year = engDate.year;
                let month = NepaliFunctions.Get2DigitNo(engDate.month);
                let day = NepaliFunctions.Get2DigitNo(engDate.day);
                let engValue = year + '-' + month + '-' + day;
                $(".datetime").val(engValue);
            },
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
        
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    

    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#imgPreview").attr('src', e.target.result).width(100).height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img").change(function() {
            readURL(this);
        })
    });

    function deleteData(id, url, el) {
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
                "id": id,
                "data": {
                    _token: "{{ csrf_token() }}"
                }

            },
            success: function(data) {
                console.log(data);
                el.closest('tr').remove();
                $("#" + data.tableId).DataTable();
                toastr.error(data.msg);
            },
        });

    }

    function onlynumbers(event) {
        
        let key = window.event ? event.keyCode : event.which;
        if (event.keyCode == 8 || event.keyCode == 46 ||
            event.keyCode == 37 || event.keyCode == 39) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else return true;
    }
//     $('.qty').bind('keyup paste', function(){
//         this.value = this.value.replace(/[^0-9]/g, '');
//   });
    function numberonly(thes)
    {
        console.log(thes.val());
        if (/\D/g.test(thes.val()))
        {
        // Filter non-digits from input value.
        thes.value=thes.value.replace(/\D/g, '');
        }                       
       

    }

    $('input.qty').on('paste',function(event){
        if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
        }
    })

    function onpasteString(event)
    {
        if (event.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
        }
    }



    function alertMessage()
    {
        
        $.alert({
            title: 'Alert!',
            icon: 'fa fa-warning',
            content: 'The purchase has already been received, you cannot edit this purchase. Please make a new purchase.',
            escapeKey: true,
            backgroundDismiss: true,
        });
    }
    function alertPayMessage()
    {
        $.alert({
            title: 'Alert!',
            icon: 'fa fa-warning',
            content: 'The Payment is already cleared.',
            escapeKey: true,
            backgroundDismiss: true,
        });
    }

</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-container",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
@yield('scripts')
