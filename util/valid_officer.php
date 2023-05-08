<?php
if (!isset($_SESSION['officer'])) {
    header('Location: ../officer');
}
