<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員註冊</title>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/login.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .container{
              width: 100vh;
    }
    h1{
          line-height: 0.5rem;
}
   .txtb{
          margin: 1.3rem 8rem;
}
   .txtb input{
         margin-top: 0.3vh;
        height: 20px;
}
  .logbtn{
       margin-top: 5vh;
}
.inputBox{
            position: relative;
        }
    #toggle {
      position: absolute;
      transform: translateY(20%);
      width: 1.2rem;
      height: 1.2rem;
      background-size: cover;
      margin-left: 0.2rem;
    }

    #toggle.hide {
      background-size: cover;
    }

  </style>
</head>
<body>

  
<nav>
    <?php include "./layout/header.php";?>
  </nav>
  

<div class="container">
  
  <form action="./add_member.php" method="post">
    <h1>新會員註冊</h1>

    <div class="txtb">
      <input type="text" name="acc" id="" required="required">
      <span data-placeholder="帳號"></span>
    </div>
    <div class="txtb inputBox">
        <input type="password" name="pw" id="password" required="required">
        <span data-placeholder="密碼"></span>
     

      <span id="toggle" onclick="showHide();"></span>
    </div>

    <div class="txtb">
      <input type="text" name="name" id="" required="required">
      <span data-placeholder="名字"></span>
    </div>

    <div class="txtb">
      <input type="date" name="birthday" id="" required="required">
      <span data-placeholder="生日"></span>
    </div>

    <div class="txtb">
      <input type="text" name="addr" id="" required="required">
      <span data-placeholder="住址"></span>
    </div>

    <div class="txtb">
      <input type="email" name="email" id="" required="required">
      <span data-placeholder="e-mail"></span>
    </div>

    <div class="txtb">
      <input type="passnote" name="passnote" id="" required="required">
      <span data-placeholder="密碼提示"></span>
    </div>

    <div>
      <input type="submit" class="logbtn" value="送出">
    </div>

  </form>
</div>


<?php include "./layout/footer.php";?>

<script type="text/javascript">
    $(".txtb input").on("focus",function(){
      $(this).addClass("focus");
    });

    $(".txtb input").on("blur",function(){
      if($(this).val() == "")
      $(this).removeClass("focus");
    });
  </script>

<script>
    
    const password = document.getElementById('password')
    
    const toggle = document.getElementById('toggle')

    
    function showHide() {
      
      if (password.type === 'password') {
        
        password.setAttribute('type', 'text')
        toggle.classList.add('hide')
      } else {
        
        password.setAttribute('type', 'password')
        toggle.classList.remove('hide')
      }
    }
  </script>
  
</body>
</html>