<?php include 'header.php'; ?>
<title>What is IHAP? [ IHAP ]</title>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <div class="demo-main mdl-layout__content">
      <div class="demo-ribbon">
<center><img src="<?php echo hIMAGES.'logo.png' ?>" width="250px;"></center></div>
      <?php socShare("article"); ?>
        <div class="demo-container mdl-grid">
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
            <b><h3>About IHAP</h3></b>
            <div>
              <div class="alignleft"><b>Posted In:</b> <?php echo $_SESSION['myAlias']; ?></div>
              <div class="alignright"><b>Tagged:</b> </div>
            </div><br><br>
            <div>
              <p>
                Developed as a school project by Olivya Wangari, with code contributions from Mauko Maunde, IHAP seeks to conect medical
                personel around the country ro each other and to their clients through a robust, intuitive and convenient portal.
              </p>
              <p>
                IHAP offers a responsive interface for processing and storing information on medical personel, equipment, services, resources
                as well patients in real time; along with the ability for different users to exchange information or request resources or services.
              </p>
            </div>
            <div>
              <div class="alignleft"><b>Posted By:</b> </div>
              <div class="alignright"><b>On:</b> </div>
            </div><br><br>
            <div>
              <h5>Add Comment</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php';