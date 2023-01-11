<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restoran</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="asset/logo1.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <div id="wrapper">
    <div id="sidebar">
    <?php
        include "sidebar.php"
        ?>
    </div>
    <div id="content">
      <!-- Profile widget -->
      <div class="bg-white shadow rounded overflow-hidden">
        <div class="px-4" style="border-radius:0.25rem; margin: top 5px; background-color: #ac7f64;">
            <div class="media align-items-end profile-header">
                <form method="POST" action="proses-logo.php" enctype="multipart/form-data">
                  <div class="profile mt-3 mr-3">
                      <label for="logo"><img src="asset/logo1.png" alt="logo" class="img-cover-profile rounded mb-2 img-thumbnail" width="120px" height="120px"></label>
                  </div>
                </form>
                <div class="media-body mb-5 text-white">
                    <h4 class="mt-0 mb-0"><?php echo "" . $_SESSION['username'] . ""; ?></h4>
                    <p class="small mb-4">Administrator</p>
                </div>
            </div>
        </div>
        <div class="py-4 px-4 mt-2">
          <div class="tab-content py-3">
            <div id="PageProfile" class="tab-pane active">
              <form method="post">
                      <div class="row">
                          <div class="col-sm-6 col-md-6 mb-2">
                              <label for="namatoko">Nama Toko<span class="text-danger">*</span></label>
                              <input name="nama_toko" type="text" class="form-control" value="Kedai Kopi" id="namatoko" placeholder="nama toko" readonly required>
                          </div>
                          <div class="col-sm-6 col-md-6 mb-2">
                              <label for="username">Username<span class="text-danger">*</span></label>
                              <input name="username" type="text" class="form-control" value="<?php echo "" . $_SESSION['username'] . ""; ?>" id="username" placeholder="username" readonly required>
                          </div>
                          <div class="col-sm-6 col-md-6 mb-2">
                              <label for="telepon">Telepon<span class="text-danger">*</span></label>
                              <input name="telepon" type="number" class="form-control" value="082246496810" id="telepon" placeholder="0821xxx" readonly required>
                          </div>
                          <div class="col-sm-6 col-md-6 mb-2">
                              <label for="alamat">Alamat<span class="text-danger">*</span></label>
                              <input name="alamat" type="text" class="form-control" id="alamat" value="Jl. Imam Bonjol No. 103 Ds. AengBaja, Kec. Bluto, Kab. Sumenep, Jatim" readonly required>
                          </div>

                          <div class="col-sm-6 col-md-6 col-lg-6"></div>
                          </div>

                      </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- End profile widget -->
    </div>
  </div> 
</body>
</html>