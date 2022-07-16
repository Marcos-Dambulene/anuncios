      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo base_url('public/restrita/assets/js/app.min.js'); ?>"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?php echo base_url('public/restrita/assets/js/scripts.js'); ?>"></script>
  <!-- Custom JS File -->
  <script src="<?php echo base_url('public/restrita/assets/js/custom.js'); ?>"></script>
  <script src="<?php echo base_url('public/restrita/assets/js/util.js'); ?>"></script



    <?php if (isset($scripts)): ?>

      <?php foreach ($scripts as $script): ?>
        
        <script src="<?php echo base_url('public/restrita/' . $script); ?>"></script>
          

      <?php endforeach; ?>

    <?php endif; ?>



</body>



</html>