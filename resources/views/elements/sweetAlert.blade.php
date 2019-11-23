<script>
function sweetAlertError(title, text, confirmButtonText){
    Swal.fire({
        title: title? title : 'Error!',
        text: text? text : 'Do you want to continue',
        icon: 'error',
        confirmButtonText: confirmButtonText? confirmButtonText : 'Cool'
    })
}


$(".confirmLink").on('click',function(){
    var link = $(this).attr('href');
    var title = $(this).data('title-msg');
    var msg = $(this).data('msg');
});
</script>