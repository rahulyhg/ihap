<?php include './header.php'; ?>
<div class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-grid mdl-card">
    <div class="mdl-cell mdl-cell--1-col mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
    	<div class="mdl-tabs__tab-bar ">

		     <a href="#tab1-panel" class="mdl-tabs__tab is-active">
		     	<span class="hollow-circle"></span>
		  	    <i class="material-icons mdl-list__item-icon">message</i>
		     </a>
		     <a href="#tab2-panel" class="mdl-tabs__tab">
			    <span class="hollow-circle"></span>
			  	<i class="material-icons mdl-list__item-icon">question_answer</i>
		      </a>
		      <a href="#tab3-panel" class="mdl-tabs__tab">
		      	<span class="hollow-circle"></span>
		        <i class="material-icons mdl-list__item-icon">phone</i>
		      </a>
	      <a href="#tab3-panel" class="mdl-tabs__tab"><span class="hollow-circle"></span>
	      		<i class="material-icons mdl-list__item-icon"></i></a>
	      </a>
	      <a href="#tab3-panel" class="mdl-tabs__tab"><span class="hollow-circle"></span>
	      		<i class="material-icons mdl-list__item-icon"></i></a>
	      </a>
	      <a href="#tab3-panel" class="mdl-tabs__tab"><span class="hollow-circle"></span>
	      		<i class="material-icons mdl-list__item-icon"></i></a>
	      </a>
	      <a href="#tab3-panel" class="mdl-tabs__tab"><span class="hollow-circle"></span>
	      		<i class="material-icons mdl-list__item-icon"></i></a>
	      </a>
	      <a href="#tab3-panel" class="mdl-tabs__tab"><span class="hollow-circle"></span>
	      		<i class="material-icons mdl-list__item-icon">more_horiz</i></a>
	      </a>
     	</div>
   </div>
   <div class="mdl-cell mdl-cell--11-col mdl-color--<?php primaryColor( $_SESSION['myCode'] ); ?>">
      	<div class="mdl-tabs__panel is-active" id="tab1-panel">
      	Content 1
      	</div>
      	<div class="mdl-tabs__panel" id="tab2-panel">
	         Content 2
		</div>
		<div class="mdl-tabs__panel" id="tab3-panel">
	          Content 3
      	</div>
    </div>
  </div>
 </div>
<?php include './footer.php';
?>