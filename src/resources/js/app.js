// console.log('working in frontend');
jQuery(document).ready(function(){
    jQuery("#buscadorCertRyC").on('submit',async function(e){
        e.preventDefault();
        let dni = jQuery('#seachDniValue')[0].value;
        Swal.fire("Consultando certificados...");
        await jQuery.ajax({
            type:"post",
            url: ajax_object.url,
            data:{
                action:"find_certificados_by_dni_ryc",
                dni: dni
            },
            success:function(data){
                data = JSON.parse(data);
                if(data.length<=0){
                    Swal.fire({
                        title: 'No existe certificados para el dni: '+dni+ ' no cuenta con ningun certificado registrado',
                        text: 'Si es alumno por favor comuniquese con nosotros',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                      })
                }
                else{
                    let table = new DataTable("#tbResultsCertificadosRyc",{
                        responsive:true,
                        data:data,
                        columns:[
                            { data: 'nombre'},
                            { data: 'dni'},
                            { data: 'CursoDiplomado'},
                            { 
                                data: null, 
                                render:function(data,type,row,meta){ 
                                    return '<a target="_blank" href="https://'+window.location.hostname+'/certificados/public/'+ data.file+'">Ver certificado</a>';
                                }
                            }

                        ]
                    });
                    Swal.close();
                    table
                    
                    
                }
            },
            error: function(){
                Swal.fire({
                    title: 'Ocurrió un error en la consulta',
                    text: 'Lo sentimos inténtelo en otro momento',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                  })
            }
        });
    });
});