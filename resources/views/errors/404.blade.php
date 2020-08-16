
<link href="{{ asset('material') }}/css/404.css" rel="stylesheet" />

<div class="cont_principal">
    <div class="cont_error">
        <h1>404 error</h1>  
        <p>Oops! Page does not exist.</p>
        <p><button onclick="goBack()"><h2>Go back</h2></button></p>
    </div>
        <div class="cont_aura_1"></div>
        <div class="cont_aura_2"></div>
</div>

<script>
    window.onload = function(){
    document.querySelector('.cont_principal').className= "cont_principal cont_error_active";  
    }
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>