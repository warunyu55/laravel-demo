
function sweets(success){
    Swal.fire({
    icon: 'success',
    title: success,    
    })
}

function sweetsfail(fail){
    Swal.fire({
    icon: 'error',
    title: fail,    
    })
}

function sweetslocation(success,location){
    Swal.fire({
    icon: 'success',
    title: success,    
    }).then(function(){
        window.location.href = location
    })
}

