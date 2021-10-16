$('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    auto: true,
    loop:true,
    slideMargin: 0,
    thumbItem: 9
});

$('.btn-delete').click(function (e) { 
    e.preventDefault();
    if(confirm('Bạn có chắc muốn xóa hay không?')){
        window.location.href = $(this).attr('href');
    }
    
});

$(".image-upload").change(function () {
    var currentImageUpload = $(this);
    // console.log(currentImageUpload);
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            currentImageUpload.parent().find('.preview').remove();
            currentImageUpload.parent().find('.img-old').remove();
            currentImageUpload.parent().append('<img src="'+e.target.result+'" class="preview"/>');
        };
        reader.readAsDataURL(this.files[0]);
    }
});

var resetLabel = function(){
    $('.label-image').each(function (i) {
        $(this).html('Hình ảnh ' + (i+1));
        // console.log(i);
    });
}

resetLabel();

$('.btn-add-image').click(function (e) { 
    e.preventDefault();
    var index = $('.label-image').length + 1;
    // alert(123);
    $element = `
    <div class="item form-group input">
    <label class="col-form-label col-md-3 col-sm-3 label-align label-image" for="first-name">Hình ảnh `+index+` 
    </label>
        <div class="col-md-6 col-sm-6 input-wrapper">
            <input type="file" name="images[]" class="form-control col-md-6 image-upload">
            <input type="text" name="alt[]" placeholder="alt_image" value="" class="form-control col-md-3 ml-1">
            <input type="number" name="ordering[]" placeholder="ordering" value="" class="form-control col-md-2 ml-1">
            <button type="button" class="btn btn-danger btn-sm btn-remove-image rounded-circle"><i class="fa fa-times"></i></button>
        </div>
    </div>
    `;

    $('.item.form-group.input').last().after($element);

    $(".image-upload").change(function () {
        var currentImageUpload = $(this);
        // console.log(currentImageUpload);
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                currentImageUpload.parent().find('.preview').remove();
                currentImageUpload.parent().find('.img-old').remove();
                currentImageUpload.parent().append('<img src="'+e.target.result+'" class="preview"/>');
                currentImageUpload.parent().find('.btn-remove-image').addClass('switch-btn');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('.btn-remove-image').click(function (e) { 
        e.preventDefault();
        var t = $(this).closest('.item.form-group.input').remove();
        $.when(t.remove()).then(resetLabel());
    });
    
});

$('.btn-remove-image').click(function (e) { 
    e.preventDefault();
    var t = $(this).closest('.item.form-group.input').remove();

    var index = $(this).data("index");
    // console.log(index);

    $('form').append('<input type="hidden" name="image_delete[]" value="'+index+'">')

    $.when(t.remove()).then(resetLabel());
});
