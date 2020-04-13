<?php
    if(! isset($page_name)){
    $page_name = '';
    }
?>
      <nav class="navbar navbar-expand-sm navbar-light bg-light">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item <?= $page_name=='address-list' ? 'active' : '' ?>">
                      <a class="nav-link" href="address-list.php">資料列表</a>
                  </li>
                  <li class="nav-item <?= $page_name=='data-insert' ? 'active' : '' ?>">
                      <a class="nav-link " href="insert-list.php">新增資料</a>
                  </li>
              </ul>
              <ul class="navbar-nav">
              <?php // print_r($_SESSION['loginUser'])  ?>
              <?php if(isset($_SESSION['loginUser'])):  ?>
                <li class="nav-item">
                        <a class="nav-link"><?= $_SESSION['loginUser']['nickname'] ?></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="">修改會員資料</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="">登出</a>
                    </li>
              <?php else:  ?>
                
                    <li class="nav-item <?= $page_name=='login' ? 'active' : '' ?>">
                        <a class="nav-link" href="login.php">登入</a>
                    </li>
                    <li class="nav-item <?= $page_name=='data-insert' ? 'active' : '' ?>">
                        <a class="nav-link" href="register.php">註冊</a>
                    </li>
             <?php endif;  ?>
            </ul>
          </div>
      </nav>
        <style>
            #collapsibleNavId .nav-item.active {
            background-color: #7abaff;
            }
        </style>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
