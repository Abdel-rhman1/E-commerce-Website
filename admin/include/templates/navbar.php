<nav class="navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">
          <?php echo lang('Home_Admin') ?>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li>
              <a href="categories.php">
                  <?php 
                    echo lang('Categories')
                  ?>  </a>
            </li>
            <li><a href="Item.php"><?php echo lang('ITEM')?> </a></li>
            <li><a href="member.php"><?php echo lang('MEMBERS')?> </a></li>
            <li><a href="Comment.php"><?php echo lang('Comment')?> </a></li>
            <li><a href="#"><?php echo lang('statistics')?></a></li>
            <li><a href="#"><?php echo lang('LOGS')?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <?php
                echo $_SESSION['username'];
              ?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="../index.php">Visit Shop </a></li>
            <li><a href="member.php?do=Edit&user_id=<?php 
              echo($_SESSION['id']);?>"><?php echo lang('Edit')?> </a></li>
            <li><a href="#"><?php echo lang('Setting')?> </a></li>
            <li><a href="logout.php"><?php echo lang('Logout')?></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- End NavBar  -->