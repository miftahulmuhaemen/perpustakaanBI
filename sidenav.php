<!-- SideNav slide-out button -->
<a href="#" data-activates="slide-out" class="btn btn-primary p-3 button-collapse"><i
    class="fas fa-bars"></i></a>

<!-- Sidebar navigation -->
<div id="slide-out" class="side-nav fixed wide sn-bg-1">
  <ul class="custom-scrollbar">
    <!-- Side navigation links -->
    <li>
      <ul class="collapsible collapsible-accordion">
        <table class="sidebarTbl" style="cursor:pointer">
          <li><a class="collapsible-header waves-effect arrow-r">
          <?php $i=0; foreach ($menu as $key): ?>
            <tr>
              <th class="sidebarIcon d-flex justify-content-center">
                <a class="align-self-center " href="<?php echo base_url($link[$i]) ?>" style="display:block;">
                  <i class="fas fa-2x <?php echo $Icon[$i] ?>"></i>
                </a>
              </td>
              <td class="sidebarMenu">
                <a class="pl-0 align-self-center " href="<?php echo base_url($link[$i]) ?>" style="display:block;">
                  <?php echo $key ?>
                </a>
              </td>
            </tr>
            </li>
          <?php $i++;endforeach; ?>
        </table>
      </ul>
    </li>
    <!--/. Side navigation links -->
  </ul>
  <div class="sidenav-bg rgba-blue-strong"></div>
</div>
<!--/. Sidebar navigation -->
