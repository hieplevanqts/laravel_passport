var base_admin = "http://shopvn.tv/uploads";
var base = $("#base").attr("content")
var admin = {
    init:function () {
        $('.addRowMenu').on('click',function (e) {
            e.preventDefault();
            var number = $(this).attr('datafld');
            var that = this;
            var htmlRow = AddRowMenu(number);
            $('.menu-list').append(htmlRow);
            var num = parseInt(number) + 1;
            $(that).attr('datafld', num);
        });
    },
    processTreeMenu:function () {
        var arr_menu = {};
        if (typeof variable == 'undefined') {
            var obj = $('ul.sortable');
        }

        $(obj).children('li').each(function (i) {
            var data_obj = $(this).find('.row_item');
            var title = $(data_obj).find('input.title').val();
            var icon = $(data_obj).find('input.icon').val();
            var url = $(data_obj).find('input.url').val();
            arr_menu[i] = {
                'title': title,
                'icon': icon,
                'url': url,
                'children': {}
            }
            var obj_child = $(this).children('ul');
            if (obj_child.length > 0) {
                buildTreeItem(obj_child, arr_menu[i]['children'], i);
            }
        });
        var datajson = JSON.stringify(arr_menu);
        $('#content').html(datajson);
        $.session.set("menu_config", datajson);
    },
    delMenuRow: function (number) {
        if ($('.menu-list').children('li.li-item').length > 1) {
            $('#item-' + number).remove();
        }
    },
    addMenuLink:function (url,item_id) {
        var that =   window.opener.document;
        $(that).find('#url'+item_id).val(url);
        window.close();
    },
    showToastr(type = 'success', title, body) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        if (type == 'success') {
            toastr.success(body, title);
        } else if (type == 'error') {
            toastr.error(body, title);
        } else if (type == 'info') {
            toastr.info(body, title);
        } else if (type == 'warning') {
            toastr.warning(body, title);
        }
    },

}
admin.init();

$(document).ready(function (){

    $(document).on('click','.showDialog',function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        var item_id = $(this).data('id');
        url+='?item_id='+item_id;
        openWindow(url);
    });
    $(document).on('click', '.btntoggle', function (e) {
    e.preventDefault();
    var link = $(this).attr('data-href');
    var status = $(this).attr('datafld');
    var txt = (status == 1) ? "ẩn" : "Kích hoạt";
    var that = this;
    if (confirm("Bạn có chắc chắn muốn " + txt + " bản nghi này không?")) {

        $.ajax({
            method: 'GET',
            url: link,
            data: 'status=' + status,
            dataType: 'json',
            success: function (response) {
                if (status == 1) {
                    var icon = '<i class="font12 fas fa-toggle-off"></i>';
                    $(that).attr('datafld', 0);
                    $(that).removeClass('active');
                } else {
                    $(that).attr('datafld', 1);
                    $(that).addClass('text-info');
                    var icon = '<i class="font12 fas fa-toggle-on"></i>';
                }
                admin.showToastr(response.type, response.title, response.msg);
                $(that).html(icon);
            }
        })
    }
})



    $.fn.filemanager = function(type, options) {
        type = type || 'other';

        this.on('click', function(e) {
            type = $(this).data('type') || type;//sc
            var route_prefix = (options && options.prefix) ? options.prefix : base_admin;
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, '', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.val('').val(file_path).trigger('change');

                // clear previous preview
                target_preview.html('');

                // set or change the preview image src
                items.forEach(function (item) {
                    target_preview.append(
                        $('<img>').attr('src', item.thumb_url)
                    );
                });

                // trigger change event
                target_preview.trigger('change');
            };
            return false;
        });
    }
    $('.lfm').filemanager();
});


function buildTreeItem(obj, arr_menu, parent) {

    $(obj).children('li').each(function (i) {
        var data_obj = $(this).find('.row_item');
        var title = $(data_obj).find('input.title').val();
        var icon = $(data_obj).find('input.icon').val();
        var url = $(data_obj).find('input.url').val();
        arr_menu[i] = {
            'title': title,
            'icon': icon,
            'url': url,
            'children': {}
        }

        if ($(this).children('ul').length > 0) {
            buildTreeItem($(this).children('ul'), arr_menu[i]['children'], i);
        }
    })
    return arr_menu;
}


function AddRowMenu(item_id){
    var html ='<li class="li-item" id="item-'+item_id+'">';
            html+='<div class="row row_item">';
                html+='<div class="col-4">';
                    html+='<span class="fas fa-arrows-alt"></span>';
                    html+='<input type="text" name="title" class="form-control title" placeholder="Tên menu" id="title'+item_id+'" required>';
                html+='</div>';
                html+='<div class="col-2">';
                    html+='<input type="text" name="icon" class="form-control icon" placeholder="class icon" id="icon'+item_id+'">';
                html+='</div>';
                html+='<div class="col-6">';
                    html+='<div class="highlight-addon required">';
                        html+='<div class="input-group">';
                            html+='<input type="text" class="form-control url" name="url" placeholder="Nhập liên kết" id="url'+item_id+'">';
                            html+='<div class="input-group-append">';
                            html+='<button type="button" class="btn btn-info" onClick="admin.dialogBoxMenu(\'1\',\'#frame_model_menu\','+item_id+')"><i class="fa fa-link"></i>&nbsp;Liên kêt </button>';
                        html+='</div>';
                    html+='</div>';
                html+='</div>';
                html+='<button type="button" class="btn btn-danger btn-xs" onClick="admin.delMenuRow('+item_id+')"><span class="fa fa-trash"></span></button>';
            html+='</div>';
        html+='</div>';
    html+='</li>';
    return html;
}

var winRef; //This holds the reference to your page, to see later it is open or not

function openWindow(url, width='920',height='600') {

    const pos = {
        x: (screen.width / 2) - (width / 2),
        y: (screen.height/2) - (height / 2)
    };

    const features = `directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,resizable=no,width=${width} height=${height} left=${pos.x} top=10`;

    if (typeof (winRef) == 'undefined' || winRef.closed) {

        winRef = window.open(url, "Quản lý liên kết",features);
        window.document.title = "Quản lý liên kết";

    }
    else {
        try {
            winRef.document;
        }
        catch (e) {
            winRef = window.open(url, "");
        }

        //IE doesn't allow focus, so I close it and open a new one
        if (navigator.appName == 'Microsoft Internet Explorer') {
            winRef.close();
            winRef = window.open(url, "",'width='+width+',height='+height+'');
        }
        else {
            //give it focus for a better user experience
            winRef.focus();
        }
    }
    var size = [window.width,window.height];  //public variable


}


