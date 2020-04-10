<script>
    layui.use(['layer'], function () {
        var layer = layui.layer;
        
	       @if(isset($errors))
	            layer.msg("{{ $errors['message']}}",{icon: 5});
	       @endif 
      
    });
</script>
