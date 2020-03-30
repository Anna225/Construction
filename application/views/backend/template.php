<!DOCTYPE html>
<html lang="en">
<head>
        <?php
		$this->load->view('backend/common/header');
	?>
    

</head>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    
    <header class="app-header navbar">    
        <?php 
                $this->load->view('backend/common/topnav');
        ?>
    </header>

  <div class="app-body">
        <?php 
            $this->load->view('backend/common/leftnav');
        ?>
    </div>
    <!-- Main content -->
    <main class="main">

      <?php 
       $this->load->view('backend/common/smalltopnav');
      ?>
       <!-- /Start .conainer-fluid -->
      <div class="container-fluid">
          <?= isset($content)? $content : ""; ?>
        

      </div>
      <!-- /.conainer-fluid -->
      <?php 
    $this->load->view('backend/common/extramodals');
  ?>
    </main>

    <aside class="aside-menu">
      <?php 
        //$this->load->view('backend/common/asidemenu');
      ?>
    </aside>

  </div>
  
  
  <?php 
    $this->load->view('backend/common/footer');
  ?>


 <?php 
    $this->load->view('backend/common/extrafile');
  ?>
  
  <?php 
    $this->load->view('backend/common/modaljs');
  ?>
</body>
</html>
