<script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script>
    $('.editor-textarea').each(function(e){
        CKEDITOR.replace(this,{
            filebrowserBrowseUrl : '{{ url("assets/ckeditor")}}/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr=',
            filebrowserUploadUrl : '{{ url("assets/ckeditor")}}/filemanager/dialog.php?type=2&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr=',
            filebrowserImageBrowseUrl : '{{ url("assets/ckeditor")}}/filemanager/dialog.php?type=1&editor=ckeditor&akey={{ md5('goestoe_ari_2905') }}&fldr='
        });
    });
</script>
