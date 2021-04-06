<style>
/*SnackBar4*/
#snackbar4 {
    visibility: show;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
  }
  
  #snackbar4 {
  animation: fadeOut 8s forwards;
}

@keyframes fadeOut {
  0% {
    opacity:1;
  }
  100% {
    opacity:0;
  }
}

@-moz-keyframes fadeOut {
  0% {
    opacity:1;
  }
  100% {
    opacity:0;
  }
}

@-webkit-keyframes fadeOut {
  0% {
    opacity:1;
  }
  100% {
    opacity:0;
  }
}

@-o-keyframes fadeOut {
  0% {
    opacity:1;
  }
  100% {
    opacity:0;
  }
}

@-ms-keyframes fadeOut {
  0% {
    opacity:1;
  }
  100% {
    opacity:0;
} 
  


  /* SnackBar4 */

</style>
@if(Session::has('authorized'))
<div class="alert alert-danger alert-dismissible">
<h3 class="text-uppercase text-dark text-center"  style="text-align:center"><strong>{{Session::get('authorized')}}</strong></h3> 
<a href="#" class="close mt-3" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-danger alert-dismissible">
<h3 class="text-uppercase text-dark text-center"  style="text-align:center"><strong>{{Session::get('success')}}</strong></h3> 
<a href="#" class="close mt-3" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif
@if(Session::has('sucessSnackBar'))
<div id="snackbar4">
{{Session::get('sucessSnackBar')}}
</div>
@endif
<!-- <script>
function snackbar4()
    {
        var x = document.getElementById("snackbar4");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }

</script> -->