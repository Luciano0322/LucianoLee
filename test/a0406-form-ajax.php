<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="" name="form1" onsubmit="return mySubmit()">
        <input type="number" id="a" name="a"> + <input type="number" id="b" name="b"> <button>=</button>
        <input type="text" id="c" disabled="disabled">
    </form>

    <script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    <script>
        function mySubmit(){
            $.post('a0406-form-ajax-api.php',$(document.form1).serialize(),(data)=>{
                console.log(data);
                $('#c').val(data.c);
            },'json')
        
          return false;  
        }
        //上面要加name
        /*
        function mySubmit(){
            $.post('a0406-form-ajax-api.php',{
                a:document.querySelector('#a').value,
                b:$('#b').val()
                },(data)=>{
                console.log(data);
                $('#c').val(data.c);
            },'json')
        
          return false;  
        }
        */
    </script>
</body>
</html>