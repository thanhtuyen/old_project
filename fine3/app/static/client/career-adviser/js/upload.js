/*$(".file_upload").on("click",function(){
    $('#upload').click();
})

if(! $('div.image-box img').attr('src')){
    $('a.delete-image').hide();
}

/*$('a.delete-image').click(function(){
    var result = confirm("キャリアアドバイザー画像を削除しますか？");
    if (result) {
        $('#image_id').val('');
        $('#image').val('');
        $('div.image-box').empty();
        $('a.delete-image').hide();
        $('div.image-box').html('<div class="drag-drop"> 写真をこちらにドラッグ&ドロップするか、「写真を追加」ボタンを押して登録してください。</div>');
    }

    return false;
});*/

/*var settings = $(".media-drop").html5Uploader({

    postUrl: '/client/profile/upload',
    imageUrl: '/client/profile/upload',

    /**
     * File dropped / selected.
     *
    onDropped: function (success) {
        if (!success) {
             $('.media-drop .message .error').text('アップロードできる画像は、JPEG・PNG・GIF形式のみです。');
        } else {
             //$('#file_upload_form').addClass("display_none");
        }
    },

    /**
     * Image cropped and scaled.
     *
    onProcessed: function (canvas) {

        if (canvas) {

            // Remove possible previously loaded image.
            var url = canvas.toDataURL();
            var newImg = document.createElement("img");
            newImg.src = url;
            $('input#image').val(url);

            // Show new image.
            $('div.image-box').empty().append(newImg);

            $('a.delete-image').show();


            // Reset dropbox for reuse.
            $('.media-drop .message .error').empty();

        } else {
            $('.media-drop .message .error').html('画像をアップロードできませんでした。');
        }
    },

    /**
     * Image uploaded.
     *
     * @param success boolean True indicates success
     * @param responseText String Raw server response
     *
    onUploaded: function (success, responseText) {
        console.log(responseText);
        if (success) {
            // $('.media-drop .message .success').html('画像をアップロードしました。');
        } else {
             $('.media-drop .message .error').html('画像をアップロードできませんでした。');
        }
    },

    /**
     * Progress during upload.
     *
     * @param progress Number Progress percentage
     *
    onUploadProgress: function (progress) {
        window.console && console.log('Upload progress: ' + progress);
    }
});*/
