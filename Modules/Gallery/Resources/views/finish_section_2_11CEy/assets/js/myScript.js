$('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    auto: true,
    loop: true,
    slideMargin: 0,
    thumbItem: 9,
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
            // currentImageUpload.parent().find('.img-old').remove();           // case iamge old
            currentImageUpload.parent().find('.preview').remove();  // case preview
            currentImageUpload.parent().append('<img src="'+e.target.result+'" class="preview"/>');
        };
        reader.readAsDataURL(this.files[0]);
    }
});
