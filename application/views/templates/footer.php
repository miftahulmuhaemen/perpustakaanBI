<?php if ($this->session->userdata('login') == 1) : ?>
  </div>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js" integrity="sha256-IzlwLg1lCtqv22ltwu2NKaDwF+mKI8FymiGVfXO0XKY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.4/dist/jspdf.plugin.autotable.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/lightbox.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/addons/datatables.min.js') ?>"></script>

<script>
  const buttons = document.querySelectorAll(".js-toggle-state");

  for (const button of buttons) {
    button.addEventListener('click', function(event) {
      this.setAttribute('data-active', this.getAttribute('data-active') === 'true' ? false : true);
      event.preventDefault();
    });
  }
  var toggle = document.getElementById("navToggle");

  function openNav() {
    document.getElementById("sidebarBtn").setAttribute("onClick", "closeNav()");
    document.getElementById("dropdown").style.marginRight = "-270px";
    document.getElementById("sidebarBtn").style.marginLeft = "270px";
    document.getElementById("main").style.marginLeft = "270px";
    document.getElementById("sidebarSupportedContent").style.marginLeft = "0px";
    toggle.classList.remove("fa-plus");
    toggle.classList.add("fa-times");
  }

  function closeNav() {
    document.getElementById("sidebarBtn").setAttribute("onClick", "openNav()");
    document.getElementById("dropdown").style.marginRight = "0px";
    document.getElementById("sidebarBtn").style.marginLeft = "0px";
    document.getElementById("main").style.marginLeft = "0px";
    document.getElementById("sidebarSupportedContent").style.marginLeft = "-270px";
    toggle.classList.remove("fa-times");
    toggle.classList.add("fa-plus");
  }
</script>
</body>

</html>