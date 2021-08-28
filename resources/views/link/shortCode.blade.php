<!DOCTYPE html>
<html>
    <head>
        <title>Создание коротких ссылок</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="{{asset("js/main.js")}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body> 
        <div  align="center">
            <h1 align="center">Короткие ссылки</h1>
              <div align="center" style="border: 3px solid #000;display: inline-block; margine:20px;padding:10px;">
                <form id="formSortCode">
                    <!--@csrf-->
                    <!--{{ csrf_field() }}-->
                    <div>
                        <input type="text" name="longUrl" id="longUrl" title="Введите длинную ссылку" placeholder="Введите длинную ссылку" size="30px">
                    </div>
                    <br>
                    <div>
                        <button name="btnShortCode" id="btnShortCode" type="submit">Создать короткую ссылку</button>
                    </div>
                      
                      
                </form>
              </div>
                <br>
              <div id="result" name="result" align="center">
                    
                    
              </div>
            
        </div>
    </body>
</html>