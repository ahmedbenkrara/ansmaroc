$(document).ready(function(){
    var select = $('.ville');
    $.ajax({
        url:'/json/country.json',
        type:'GET',
        dataType:'JSON',
        success:function(response){
            response.data.forEach(element => {
                if(element.country === 'Maroc'){
                    element.cities.forEach(e=>{
                        select.append('<option value='+e.replace(/\s/g, '')+'>'+e+'</option>')
                    })
                }
            });
        }
    })
})