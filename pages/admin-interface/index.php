<?php
session_start();

if (!isset($_SESSION["Nome"]) || !($_SESSION["TipoUtente"] == "Amministratore parco")) {
    error_reporting(0);
    die ("Permesso di accesso alla pagina negato.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pagina iniziale di <?php echo $_SESSION["Nome"]; ?></title>
        <?php require_once '../../partials/head-section.php'; ?>
    </head>
    <body class="w3-light-grey">
        <script>
        function showAlerts(string) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#alertTable").html(this.responseText);
                }
            };
            xhttp.open("POST", "alert.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("param=" + string);
        }

        function showRilevazioni(string) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#rilevazioniTable").html(this.responseText);
                }
            };
            xhttp.open("POST", "rilevazioni.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("param=" + string);
        }

        function showUsers(string) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#utentiTable").html(this.responseText);
                }
            };
            xhttp.open("POST", "profili.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("param=" + string);
        }

        function searchUser (userID) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#dynamicUser").html(this.responseText);
                }
            };
            xhttp.open("POST", "searchUser.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("param=" + userID);
        }
        </script>
        <?php require_once '../../partials/top-container.php'; ?>
        <?php require_once '../../partials/sidebarmenu.php'; ?>
        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay">
        </div>
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">
            <?php require_once '../../partials/header.php'; ?>
            <div class="w3-row-padding w3-white">
                <br>
                <div class="w3-container" id="buttons">
                    <header><h5><strong>Azioni</strong></h5></header>
                    <button class="w3-button w3-red" style="width: 200px;" type="button" onclick="document.getElementById('modalAlert').style.display='block';" id="changeAlert">Modifica alert</button>
                    <?php require_once '../../partials/modal-alert-admin.php'; ?>
                    <br><br>
                    <button class="w3-button w3-blue" style="width: 200px;" type="button" onclick="document.getElementById('modalProfile').style.display='block';" id="changeProfile">Modifica profilo</button>
                    <?php require_once '../../partials/modal-edit-user.php'; ?>
                </div><hr>
                <div class="w3-container" id="alert">
                    <header><h5><strong>Alert su "<?php echo $_SESSION["Parco"]; ?>"</strong></h5></header>
                    <p>Filtra per ID, parco, tipo di alert o status: </p>
                    <input type="text" name="filtroAlert" onkeyup="showAlerts(this.value)" onfocus="showAlerts(this.value)" onblur="document.getElementById('alertTable').innerHTML='';"><br><br>
                    <div id="alertTable"></div>
                </div><hr>
                <div class="w3-container" id="rilevazioni">
                    <header><h5><strong>Rilevazioni su "<?php echo $_SESSION["Parco"]; ?>"</strong></h5></header>
                    <p>Filtra per ID, specie, stato di salute o guardiaparco: </p>
                    <input type="text" name="filtroRilevazioni" onkeyup="showRilevazioni(this.value)" onfocus="showRilevazioni(this.value)" onblur="document.getElementById('rilevazioniTable').innerHTML='';"><br><br>
                    <div id="rilevazioniTable"></div>
                </div><hr>
                <div class="w3-container" id="profili">
                    <header><h5><strong>Profili degli utenti assegnati a "<?php echo $_SESSION["Parco"]; ?>"</strong></h5></header>
                    <p>Filtra per ID, Nome, Cognome, E-mail o ruolo: </p>
                    <input type="text" name="filtroUtenti" onkeyup="showUsers(this.value)" onfocus="showUsers(this.value)" onblur="document.getElementById('utentiTable').innerHTML='';"><br><br>
                    <div id="utentiTable"></div>
                </div><hr>
                <div class="w3-container" id="profilo">
                    <header><h5><strong>Il mio profilo</strong></h5></header>
                    <?php require_once '../../partials/myprofile.php'; ?>
                </div><hr>
            </div>
            <?php require_once '../../partials/footer.php'; ?>
        </div>
        <script>
            // Get the Sidebar
            var mySidebar = document.getElementById("mySidebar");
            // Get the DIV with overlay effect
            var overlayBg = document.getElementById("myOverlay");
            // Toggle between showing and hiding the sidebar, and add overlay effect
            function w3_open() {
                if (mySidebar.style.display === 'block') {
                    mySidebar.style.display = 'none';
                    overlayBg.style.display = "none";
                }
                else {
                    mySidebar.style.display = 'block';
                    overlayBg.style.display = "block";
                }
            }

            // Close the sidebar with the close button
            function w3_close() {
                mySidebar.style.display = "none";
                overlayBg.style.display = "none";
            }

            function openEditAlertModal() {
                $('#idalert').val($('#idAlertEdit').val());
            }
        </script>
    </body>
</html>
