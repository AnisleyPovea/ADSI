$(document).on("click", ".btnEliminarPersona", function(){
    let persona_id = $(this).attr('value');
    Swal.fire({
        title: '¿Estás seguro de eliminar este registro?',
        text: '¡Recuerde que los cambios son irreversibles!',
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        console.log(persona_id);
        console.log(dominio);
        if (result.isConfirmed) {
            window.location = `../views/components/persona/delete.php?id=${persona_id}`;
        } else if (result.isDismissed) {
            
         }
    });
});

