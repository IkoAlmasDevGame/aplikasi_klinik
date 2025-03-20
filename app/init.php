<?php
# under indonesian
# nama folder untuk website anda. 
# under english
# folder name for your website.
define("BASE_URL", "http://localhost/aplikasi_klinik/");
define("URL_BASE", "http://localhost/aplikasi_klinik/public/");
# App Folder : (ALL FILES) Configs, Controllers, Core, Helpers, and Models
# Folder Configs
require_once("configs/configs.php");
# Folder Controllers
require_once("controllers/Example.php");
require_once("controllers/Authentication.php");
require_once("controllers/Setting.php");
require_once("controllers/Dokter.php");
require_once("controllers/Pasien.php");
require_once("controllers/Pendaftaran.php");
require_once("controllers/RekamMedis.php");
require_once("controllers/UserCreate.php");
# Folder Core
require_once("core/Database.php");
# Folder Helpers
require_once("helpers/helpers.php");
# Folder Models
require_once("models/Pasien_model.php");
require_once("models/Example_model.php");
require_once("models/Setting_model.php");
require_once("models/Authentication_model.php");
require_once("models/Dokter_model.php");
require_once("models/Pendaftaran_model.php");
require_once("models/RekamMedis_model.php");
require_once("models/UserCreate_model.php");