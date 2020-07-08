<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <!-- MDB icon -->
  <link rel="icon" href="<?php echo base_url('assets/img/mdb-favicon.ico') ?>" type="image/x-icon">
  <!-- line awesome -->
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/mdb.min.css') ?>">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/addons/datatables.min.css') ?>">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
  <!-- jquery -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

	<style media="screen">
		*, *:before, *:after {
		box-sizing: border-box;
		}

		.c-button-reset {
		display: inline-block;
		font-family: inherit;
		font-size: 1em;
		outline: none;
		border: none;
		border-radius: 0;
		box-shadow: none;
		text-shadow: none;
		color: inherit;
		cursor: pointer;
		padding: 0;
		-webkit-tap-highlight-color: transparent;
		}

		.c-animated-button {
		position: relative;
		min-width: 40px;
		min-height: 40px;
		width: 2.5em;
		height: 2.5em;
		background-color: #FFF;

		&__text {
			display: inline-block;
			text-indent: -3125em;
		}

		&:before, &:after, &__text:before {
			content: "";
			display: inline-block;
			position: absolute;
			top: 50%;
			left: 0.375em;
			right: 0.375em;
			height: 0.250em;
		}

		&:before, &:after {
			transition: transform 300ms cubic-bezier(.75,-0.6,.14,1.59) 150ms;
			will-change: transform background-color;
		}

		&[data-active='true'] {
			&:before, &:after {
				transition-duration: 150ms;
				transition-timing-function: ease-out;
				transition-delay: 0s;
			}
		}

		&--plus-to-check, &--arrow-to-check {
			&:before, &:after {
				background-color: #2AB2C0;
			}

			&[data-active='true'] {
				&:before, &:after {
					background-color: #89B937;
				}
				&:before {
					transform: translate(calc(25% - .175em), -.175em) rotate(-45deg) scale(1, 1);
				}

				&:after {
					transform: translate(-25%, .175em) rotate(45deg) scale(.43, 1);
				}
			}
		}

		&--plus-to-check {
			&:before {
				transform: translate(0, 0) rotate(-90deg) scale(1, 1);
			}

			&:after {
				transform: translate(0, 0) rotate(180deg) scale(1, 1);
			}
		}

		&--arrow-to-check {
			&:before {
				transform: translate(0, 25%) rotate(-45deg) scale(.5, 1);
			}

			&:after {
				transform: translate(0, -150%) rotate(45deg) scale(.5, 1);
			}
		}

		&--hamburger {
			&:before {
				background-color: #F8A036;
				transform: translateY(-250%);
			}

			&:after {
				background-color: #2AB2C0;
				transform: translateY(150%);
				mix-blend-mode: multiply;
			}

			&[data-active='true'] {
				&:before, &:after {
					transition-duration: 150ms;
					transition-timing-function: ease-out;
					transition-delay: 0s;
				}

				&:before {
					transform: rotate(45deg) translate(0, 0);
				}

				&:after {
					transform: rotate(-45deg) translate(0, 0);
				}
			}
		}

		&--hamburger &__text:before {
			background-color: #FF3000;
			transform: translateY(-50%) scale(1);
			opacity: 1;
			transition: transform 150ms ease-in 300ms;
			will-change: transform opacity;
		}

		&--hamburger[data-active='true'] &__text:before {
			transform: translateY(-50%) scale(0);
			transition-timing-function: ease-out;
			transition-delay: 0s;
			opacity: 0;
		}
		}

	</style>
</head>
<div class="vh-100 vw-100" style="position: fixed; left: 0vw;z-index: -1; background: #e8eaf6;">
</div>
<body id="body">
	<?php if ($this->session->userdata('login')==1):?>
    <header id="myHeader" class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="col pr-0">
        <!-- <button class="navbar-toggler" type="button" id="sidebarBtn" onclick="openNav()">
          <i id='navToggle' class="indigo-text fa fa-2x fa-plus"></i>
        </button> -->
        <a src="<?php echo base_url('assets/img/perpus_bi.ico') ?>"></a>
        <label class="label"><?php echo strtoupper($title) ?> </label>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li>
  				<a id="dropdown" data-toggle="dropdown" href="#sidebarUser" aria-expanded="false" aria-controls="collapseExample" >
  						<i class="indigo-text fas fa-3x fa-user-circle"></i>
  				</a>
          <div class="dropdown-menu fixed mr-3" style="left: auto;right:0px">
  					<?php if ($this->session->userdata('level')==5): ?>
  						<a class="dropdown-item" href="<?php echo base_url('user/profile') ?>"><?php echo $this->session->userdata('nama') ?></a>
  					<?php endif; ?>
  					<a class="dropdown-item" href="<?php echo base_url('user/edit/'.$this->session->userdata('id')); ?>">Atur Akun</a>
  					<a class="dropdown-item" href="<?php echo base_url('logout') ?>">Log out</a>
  				</div>
        </li>
      </ul>
    </header>

		<!--Main Navigation-->
		<div class="sidebar" id="mySidebar">
			<div class="sidebar-wrapper z-depth-1 position-fixed c-happy-fisher" id="sidebarSupportedContent">
				<div class="w-100">
					<table class="sidebarTbl" style="cursor:pointer">
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
						<?php $i++;endforeach; ?>

					</table>
				</div>
			</div>
		</div>

		<div id="main" class="main-panel">
	<?php endif; ?>
