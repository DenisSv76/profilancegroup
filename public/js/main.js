$(document ).ready(function() {
    $("#formSortCode").on('submit',function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        
	var $longUrl = $(document).find('#longUrl').val().trim();
        
        $.ajax({
                type: "POST",
                dataType: "json",
                url: "/generate_short_code",
                //data:$('#formSortCode').serialize(),
                data:{
                    longUrl:$longUrl
                },
                success: function(data) {
                    var $result_div=$(document).find('#result').empty();
                    if (data.status=='succes') {
                        $result_div.append("<div style='background-color:green;text-align:center;align:center; width:30%;margin:0 auto;height:50px;'>"+data.message+" - <a href="+data.short_url+">"+data.short_url+"</a></div>");
                        
                    } else {
                        $result_div.append("<div style='background-color:red;text-align:center;align:center; width:30%;margin:0 auto;height:50px;'>"+data.message+"</div>");
                    } 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    var $result_div=$(document).find('#result').empty();
                    if(XMLHttpRequest.status==422) {
                        $result_div.append("<div style='background-color:red;text-align:center;align:center; width:30%;margin:0 auto;height:50px;'>Введена неправильная ссылка</div>");       
                    } else {
                        $result_div.append("<div style='background-color:red;text-align:center;align:center; width:30%;margin:0 auto;height:50px;'>Ошибка сервера. Код ошибки: "+XMLHttpRequest.status+"</div>");
                    }
                }
        });
    });    
        
});

