const _basrUrl=$('#base-url').val().trim();

var KTDatatablesBasicScrollable = {
    init: function() {
        $("#kt_table_1").DataTable({
            scrollY: "50vh",
            scrollX: !0,
            scrollCollapse: !0,
        })
    }
};

$(function(){
    $('.simple-datatable').DataTable({
        // scrollY: '60vh',
        // scrollX: !0,
        // scrollCollapse: !0,
        responsive: true
    })

    KTDatatablesBasicScrollable.init();

    //Number Format
    $('.numberformat').inputmask({
        alias : "currency",
        digits : 0,
        prefix : ''
    });
    
    //Number Format
    $('.percentformat').inputmask({
        alias : "currency",
        digits : 2,
        prefix : ''
    });      

    $('.form-submit-ajax').submit(function(e){
        e.preventDefault();
    })

    $('.btn-submit-ajax').click(function(){
        overlay('loading');
        var action = $(this).closest('form').attr('action');
        var method = $(this).closest('form').attr('method');
        var formData = $('.form-submit-ajax').serializeArray();
        var href=$(this).attr('data-href');
        $.ajax({
            type: method,
            url: action,
            data: formData,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('#loading').hide();
                if(res.status=='1') {
                    setSuccess(res.msg)
                    if( $('.form-update').length > 0 ) return;
                    window.location.assign(href)
                } else {
                    setError(res.error)
                }
            },
            error: function() {
                $('#loading').hide();
                setError('Maaf, terjadi kesalahan pada server !')
            }
        });
    })

    $('.btn-upload-ajax').click(function(){
        overlay('loading');
        var action = $(this).closest('form').attr('action');
        var method = $(this).closest('form').attr('method');
        var rawData = $('.form-submit-ajax').serializeArray();
        var fileSP = $('#surat_permohonan').prop('files')[0];
        var fileKTP = $('#ktp').prop('files')[0];   
        var fileNPWP = $('#npwp').prop('files')[0];   
        if(fileSP==null) fileSP='';   
        if(fileKTP==null) fileKTP='';   
        if(fileNPWP==null) fileNPWP='';   
        var formData = new FormData();                
        $(rawData).each(function(i, field){
            formData.append(field.name, field.value);
        });            
        formData.append('surat_permohonan', fileSP);
        formData.append('ktp', fileKTP);
        formData.append('npwp', fileNPWP);
    
        var href=$(this).attr('data-href');
        $.ajax({
            type: method,
            url: action,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,    
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('#loading').hide();
                if(res.status=='1') {
                    setSuccess(res.msg)
                    if( $('.form-update').length > 0 ) return;
                    window.location.assign(href)
                } else {
                    setError(res.error)
                }
            },
            error: function() {
                $('#loading').hide();
                setError('Maaf, terjadi kesalahan pada server !')
            }
        });
    })

    // Form Input Field Uraian Pengujian
    $('#form-update-field').validate({
        invalidHandler: function(event, validator) {     
        },
        submitHandler: function (form) {
            submitFieldUraian();
        }
    })

    $('.btn-delete-uraian').click(function(){
        var id = $(this).attr('data-id');
        if(confirm('Are you sure ?')) {
            deleteFieldUraian(id);
        }
    })

    $('.btn-update-uraian').click(function(){
        var id = $(this).attr('data-id');
        loadFieldUraian(id);
    })

    $('.btn-new-field').click(function(){
        $('#id_field').val('')
        $('#t_judul_field').val('')
        $('#t_total_field').val('')
        $('#t_urutan').val('')
    })

    $(document).on('click','.delete-link',function(){
        if(confirm('Are you sure ?')) {
            overlay('loading');
            var link = $(this).attr('data-link');
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'post',
                url: _basrUrl+'/'+link+'/'+id,
                data: {'_method':'delete'},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $('#loading').hide();
                    if(res.status=='1') {
                        setSuccess(res.msg)
                        window.location.reload()
                    } else {
                        setError(res.error)
                    }
                },
                error: function() {
                    $('#loading').hide();
                    setError('Maaf, terjadi kesalahan pada server !')
                }
            });
        }
    })

    //Form Validation
    $( ".submit-form" ).validate({
        //display error alert on form submit  
        invalidHandler: function(event, validator) {     
            var alert = $('#kt_form_1_msg');
            alert.removeClass('kt--hide').show();
            KTUtil.scrollTop();
        },
        submitHandler: function (form) {
            form[0].submit(); // submit the form
        }
    })

    $('.menu-active').parent().parent().parent().addClass('kt-menu__item--open')

    setEstimasi();
    
    //Estimas Harga
    $('.uraian').change(function(){
        setEstimasi();
    })

    $('#jml-barang').change(function(){
        setEstimasi();
    })

    $('#jml-barang').bind('keyup mouseup change scroll', function () {
        setEstimasi();
    })

    var keterangan = $('#cb-tipe-uraian option:selected').attr('data-keterangan');
    $('.keterangan-tipe').html(keterangan);

    $('#cb-tipe-uraian').change(function(){
        var keterangan = $('#cb-tipe-uraian option:selected').attr('data-keterangan');
        $('.keterangan-tipe').html(keterangan);
    })

    $('.btn-create-pengujian').click(function(){
        var tipe = $('#cb-tipe-uraian').val();
        window.location.assign(_basrUrl+"/admin/permintaan-pengujian/create?tipe="+tipe)
    })

    $('#cb_status').change(function(){
        var data = $('#cb_status').val();
        if(data=='') {
            $('.ket-status').css('display','none')
            $('.input-sample').css('display','none')
        } else if(data=='5') {
            $('.ket-status').css('display','none')
            $('.input-sample').css('display','block')
        } else if(data=='3' || data=='4' || data=='7')  {
            $('.ket-status').css('display','block');
            $('.input-sample').css('display','none');
        }
    })

    $(".number-only").keypress(function( event ) {
        var theEvent = event || window.event;
        var key = theEvent.keyCode || theEvent.which; 
        if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 38 || key == 39 || key == 40 || key == 46)) {
            console.log(key)
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    })

    $('.vertical-menu').click(function(){
        $(this).parent().parent().find('input').each (function(a, b) {
            ($(b).attr('checked'))? $(b).removeAttr('checked'):$(b).attr('checked','checked')
        });                                    
    })

    $('.horizontal-menu').click(function(){
        let row = $(this).data('row');
        $(".table-role tbody tr td:nth-child("+row+")").find('input').each(function(a,b){
            ($(b).attr('checked'))? $(b).removeAttr('checked'):$(b).attr('checked','checked')
        })
    })
})

function loadFieldUraian(id) {
    overlay('loading');
    $.ajax({
        type: 'GET',
        url: _basrUrl+'/admin/show-field-uraian/'+id,
        dataType: "json",
        success: function (res) {
            $('#loading').hide();
            if(res.status=='1') {
                $('#id_field').val(id)
                $('#cb_tipe_field').val(res.row.tipe)
                $('#t_judul_field').val(res.row.judul)
                $('#t_total_field').val(res.row.total)
                $('#t_urutan').val(res.row.order)
                $('#cb_status').val(res.row.status)
                $('#modal-field-uraian').modal('toggle');
            } else {
                setError(res.error)
            }
        },
        error: function() {
            $('#loading').hide();
            setError('Maaf, terjadi kesalahan pada server !')
        }
    });
}

function deleteFieldUraian(id) {
    overlay('loading');
    $.ajax({
        type: 'POST',
        url: _basrUrl+'/admin/delete-field-uraian',
        data: {uraian_id: id},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $('#loading').hide();
            if(res.status=='1') {
                setSuccess(res.msg)
                window.location.reload()
            } else {
                setError(res.error)
            }
        },
        error: function() {
            $('#loading').hide();
            setError('Maaf, terjadi kesalahan pada server !')
        }
    });
}

function submitFieldUraian() {
    overlay('loading');
    var action = $('#form-update-field').attr('action');
    var formData = $('#form-update-field').serializeArray();
    $.ajax({
        type: 'POST',
        url: action,
        data: formData,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $('#loading').hide();
            if(res.status=='1') {
                setSuccess(res.msg)
                $('#modal-field-uraian').modal('toggle');
                window.location.reload()
            } else {
                setError(res.error)
            }
        },
        error: function() {
            $('#loading').hide();
            setError('Maaf, terjadi kesalahan pada server !')
        }
    });
}

function setEstimasi() {
    var total = 0
    var jmlItem = ($('#jml-barang').val()=='')?0:parseInt($('#jml-barang').val());
    $('.uraian').each(function(index){
        if(this.checked){
            var price = parseInt($(this).attr('data-price')) * jmlItem
            total = total + price
            $('#estimasi-harga').html('Rp. '+formatNumber(total))
        }
    })
    $('#estimasi-harga').html('Rp. '+formatNumber(total))
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function setError(error) {
    Swal.fire(
        "",
        error,
        "error"
    );
}

function setSuccess(success) {
    Swal.fire(
        "",
        success,
        "success"
    );
}

function overlay(elm) {
    var maskHeight = $(document).height();
    var maskWidth = $(document).width();
    $('#'+elm)
    .css({'width':maskWidth,'height':maskHeight,'position':'fixed','z-index':'9000','background-color':'#FFF','top':'0px','left':'0px'})
    .empty()
    .append('<center><img src="'+_basrUrl+'/public/template/img/ajax-loader.gif" id="imgloader"></center>');
    $('#imgloader').css({'top':(($(window).height())/2),'left':((maskWidth/2)-($('#imgloader').width() / 2)),'position':'absolute'});    
    $('#'+elm).fadeIn(1000);   
    $('#'+elm).fadeTo('slow',0.6); 
}