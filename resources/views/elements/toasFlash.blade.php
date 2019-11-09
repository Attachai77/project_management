<script>
    function Flash(key, msg){
        
        key = key.trim();
        if(key == "success"){
          toastr.success(msg)
        }else if(key == "danger"){
          toastr.error(msg)
        }else{
          toastr.info(msg)
          toastr.warning(msg)          
        }
        
    }
</script>

@foreach (['danger', 'warning', 'success', 'info' ] as $key)
    @if(Session::has($key))
    <?php echo "<script>Flash(' ".$key." ',' ".Session::get($key)." ');</script>"; ?>
    @endif
@endforeach


