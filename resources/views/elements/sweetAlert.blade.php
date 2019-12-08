<script>
function sweetAlertError(title, text, confirmButtonText){
    Swal.fire({
        title: title? title : 'เกิดข้อผิดพลาด!',
        text: text? text : 'Do you want to continue',
        icon: 'error',
        confirmButtonText: confirmButtonText? confirmButtonText : 'Cool'
    })
}

function sweetAlertSuccess(title, text, confirmButtonText){
    Swal.fire({
        title: title? title : 'สำเร็จ!',
        text: text? text : 'Do you want to continue',
        icon: 'success',
        confirmButtonText: confirmButtonText? confirmButtonText : 'Cool'
    })
}


$(".confirmLink").on('click',function(){
    var link = $(this).attr('href');
    var title = $(this).data('title-msg') == undefined ? "กรุณายืนยัน!" : $(this).data('title-msg') ;
    var msg = $(this).data('msg') == undefined ? "confirm msg?" : $(this).data('msg') ;

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: title,
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่! ยืนยัน',
            cancelButtonText: 'ไม่! ยกเลิก',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                window.location.replace(link);
            } 
    })

    return false

});
</script>


<style>
.swal2-confirm.btn.btn-success{
    margin-left:20px;
}
</style>