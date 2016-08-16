jQuery(document).ready(function(){
    $ = jQuery;
    jQuery('a.delete-ca').click(function(event){
        event.preventDefault();

        if (confirm('キャリアアドバイザー「'+$(this).data('name')+'」を削除してもよろしいですか？')) {
            var error = false;

            var career_adviser_id = $(this).attr('data-id');

            // console.log(user_id);

            var tr = jQuery(this).parents('tr');

            var form = jQuery(this).parents('form');

            var formData = $(form).serialize();

            data = formData + '&career_adviser_id=' + career_adviser_id;

            deleteCa(data);

            location.reload();
            return false;
        }
    });

    function deleteCa(data) {
        var deleteUrl = '/client/profile/delete_career_adviser';
        $.post(deleteUrl, data, function(result) {
            console.log(result);
        });
    }
});